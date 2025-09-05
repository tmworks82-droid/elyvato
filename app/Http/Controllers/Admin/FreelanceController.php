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
        $data['freelancer'] = Admin::with('profile')->where('id', $id)->first();

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

        //   compare here ratings
        // $ratingTalent=TalentRating::get(); 
        // foreach($ratingTalent as $rating){

        //     if($final_score >= $rating->from && $final_score <= $rating->to){
        //         $hireFreelancer->rating =$rating->title;
        //         break;
        //     }
        // }
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

            return response()->json(['success' => true, 'message' => 'Freelance hired  successfully.']);

        }else{

            return response()->json(['success' => false, 'message' => 'Failed to Hire Freelancer. Please try again.']);
        
        }
    }
}
