<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Admin;
use App\Models\DispatchUpdate;
use App\Models\Country;
use App\Models\Role;
use App\Models\Service;
use App\Models\SubService;
use App\Models\StatementOfWork;
use App\Models\RecurringSubscription;
use App\Models\GstRate;
use App\Models\UserProfile;
use App\Models\Project;
use App\Models\Payment;
use App\Models\Currency;
use App\Models\AllFiles;
use App\Models\Blog;
use App\Models\TimeSheet;
use App\Models\CaseStudy;
use App\Models\HireTalent;
use App\Models\InitialPaymentSetting;
use App\Models\Rating;
use App\Models\TalentRating;
use App\Models\BankDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Hash;


class FreelanceController extends Controller
{
    public function index()
    {
        $title = "Freelancers List";
        $data['title'] = $title;
        $data['freelancers'] = Admin::where('role_id', 4)->orderBy('id', 'DESC')->get();
        return view('admin.freelance.index', $data);
    }
    
    public function TalentRating($id)
    {
        $title = "Talent Rating";
        $data['title'] = $title;
        $data['freelancer'] = Admin::with(['profile','bankDetails','profile.talent'])->where('id', $id)->first();

        return view('admin.freelance.talent_rating', $data);
    }


    public function FreelanceTalentRating(Request $request)
    {
        $request->validate([
            'creative' => 'required|min:1|max:10',
            'understanding' => 'required|min:1|max:10',
            'tech_knowledge' => 'required|min:1|max:10',
            'final_score' => 'required|min:1|max:10',
        ]);

        // dd($request->all());

        $userProfile = UserProfile::where('user_id', $request->user_id)->first();
        if (!$userProfile) {
            $userProfile = new UserProfile();
            $userProfile->user_id = $request->user_id;
        }

        $userProfile->creative = $request->creative;
        $userProfile->understanding = $request->understanding;
        $userProfile->tech_knowledge = $request->tech_knowledge;
        $userProfile->final_score = $request->final_score;
        
        if($userProfile->save()){
            return response()->json(['success' => true, 'message' => 'Talent evaluation saved successfully.']);

        }else{
            return response()->json(['success' => false, 'message' => 'Failed to save talent evaluation. Please try again.']);
        }

        return redirect()->back()->with('success', 'Something went wrong. Please try again.');
    }


    public function HireFreelancer(Request $request){

        $hireFreelancer = Admin::find($request->freelancer_id);

        $userProfile = UserProfile::where('user_id', $request->freelancer_id)->first();
        $final_score = $userProfile ? $userProfile->final_score : null;
        
    
        $ratingTitle=null;

         $matchingRating = TalentRating::where('from', '<=', $final_score)
                                  ->where('to', '>=', $final_score)
                                  ->first();

        if ($matchingRating) {
            $ratingTitle = $matchingRating->title;
        }
    
        if (!$hireFreelancer) {
            return response()->json(['success' => false, 'message' => 'Freelancer record not found.']);
        }

        $hireFreelancer->is_hired ='yes';
        $hireFreelancer->is_active =1;
        $hireFreelancer->rating = $ratingTitle;
        $hireFreelancer->updated_at = Carbon::now();

        if ($hireFreelancer->save()) {

           $chekc= sendEmail(
                $hireFreelancer->email,
                'ELYVATO | You have been onboard as a Freelancer',
                'emails.hired_freelancer',
                [
                    'freelancer' => $hireFreelancer,
                ]
            );
// dd($chekc);
            $mobile=$hireFreelancer->mobile;

            $hiredFreelancer = [
                'name' => 'hired_freelancer',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $hireFreelancer->name],       // {{1}}
                            
                        ]
                    ]
                ]
            ];

            sendWhatsAppTemplate($mobile, $hiredFreelancer);


            return response()->json(['success' => true, 'message' => 'Freelance hired  successfully.']);

        }else{

            return response()->json(['success' => false, 'message' => 'Failed to Hire Freelancer. Please try again.']);
        
        }
    }

    public function updateBankStatus(Request $request)
    {

        $msg='';
        $status='';
        $message='';

        $request->validate([
            'id' => 'required|exists:bank_details,id',
            'status' => 'required|in:approved,disapproved'
        ]);

        $bankDetail = BankDetails::findOrFail($request->id);
        $user=Admin::where('id',$bankDetail->user_id)->first();
        $mobile=$user->mobile;
        // $mobile='+919956398635';
        
        if($request->status=='approved'){
            $bankDetail->status ='verified';
            $msg="Verified successfully";
            
            $status='Verified';
            $message="Your payout account is now active. Future payments will be processed seamlessly.";

        }

        if($request->status=='disapproved'){
            $bankDetail->status ='rejected';
            $msg="Rejected successfully";

            $status='Rejected';
            $message="Please re-upload valid documents in your Elyvato dashboard to proceed.";

        }

        
        if($bankDetail->save()){

            $check = sendEmail(
                $user->email,
                // 'yatodi5154@camjoint.com',
                'ELYVATO | Bank Details Verification',
                'emails.bankverification',
                [
                    'freelancer' => $user,
                    'status' => $status, 
                    'remarks' => $message ?? null
                ]
            );

//    dd($check);

            $bankDetailsVerification = [
                'name' => 'bank_details_verification',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $user->name],       // {{1}}
                            ['type' => 'text', 'text' => $status],    // {{2}}
                            ['type' => 'text', 'text' => $message],    // {{3}}
                        ]
                    ]
                ]
            ];

            $resp=sendWhatsAppTemplate($mobile, $bankDetailsVerification);
            // dd($resp);
            return response()->json(['success'=>true,'message' =>$msg]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Faild Something went wrong!',
        ]);
    }


}
