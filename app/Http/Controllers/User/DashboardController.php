<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Booking;
use App\Models\Country;
use App\Models\State;
use App\Models\Role;
use App\Models\Admin;
use App\Models\City;
use App\Models\RoleDesignation;
use App\Models\Payment;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\StatementOfWork;
use App\Models\RecurringSubscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;


class DashboardController extends Controller
{
    public function index(){

        $userProfile = UserProfile::where('user_id',Auth::user()->id)->first(); 

            $requiredFields = [
                'company_name',
                // 'gst_number',
                // 'work_strength',
                'role_designation_id',
                'address_line1',
                // 'address_line2',
                // 'city',
                'state',
                // 'image',
                'country',
                'pincode',
                'industry_type',
            ];

            foreach ($requiredFields as $field) {
                if (empty($userProfile->$field)) {
                    return redirect('/user/profiles')->with('error', 'Please complete your profile first.');
                }
            }

        // dd(Auth::user()->name);
        $data['bookings']=Booking::with(['statementOfWork','statementOfWork.service', 'statementOfWork.subservice'])->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $data['complete_booking']=Booking::where(['user_id'=>Auth::user()->id,'status'=>'success'])->count();
        $data['pending_booking']=Booking::where(['user_id'=>Auth::user()->id,'status'=>'pending'])->count();
        $data['recentBookingCount'] = Booking::where('user_id', Auth::user()->id)
                            ->where('created_on', '>=', Carbon::now()->subWeek())
                            ->count();

        $data['recentcomplete_BookingCount'] = Booking::where(['user_id'=>Auth::user()->id,'status'=>'success'])
                            ->where('created_on', '>=', Carbon::now()->subWeek())
                            ->count();
        $data['newlyAddedCount'] = Booking::where(['user_id'=>Auth::user()->id,'status'=>'pending'])
                            ->where('created_on', '>=', Carbon::now()->subDays(2))
                            ->count();
        return view('user.dashboard',$data);
    }


    public function BookingList(Request $request){

        $userProfile = UserProfile::where('user_id',Auth::user()->id)->first(); 

            $requiredFields = [
               'company_name',
                // 'gst_number',
                // 'work_strength',
                'role_designation_id',
                'address_line1',
                // 'address_line2',
                // 'city',
                'state',
                // 'image',
                'country',
                'pincode',
                'industry_type',
            ];

            foreach ($requiredFields as $field) {
                if (empty($userProfile->$field)) {
                    return redirect('/user/profiles')->with('error', 'Please complete your profile first.');
                }
            }

            $query = Booking::where('user_id', Auth::id())->with('statementOfWork');

            // Apply filter
            if ($request->sort_by === 'new') {
                $query->where('created_on', '>=', Carbon::now()->subWeek());
            } elseif ($request->sort_by === 'old') {
                $query->where('created_on', '<', Carbon::now()->subWeek());
            }

            $data['title'] = "Booking List";
            $data['booking'] = $query->orderBy('id', 'desc')->paginate(10);
            

        return view('user.booking_list',$data);
    }
    
    
     public function SubscriptionBooking(){
        $data['title']='Subscription Booking';
        //   RecurringSubscription::RecurringSubscriptionBooking();
        $data['subscription']=RecurringSubscription::with(['booking','booking.statementOfWork'])->where(['user_id'=>Auth::user()->id])->paginate(10);
        // dd($data['subscription']);
        return view('user.subscription_booking',$data);
    }
    
    
    public function SubscriptionAction(Request $request)
    {
        $subscription = RecurringSubscription::find($request->id);
       
                $user=Admin::where('id',Auth::user()->id)->first();
                $manager=Admin::where('id',$request->assign)->first();
                $booking=Booking::where('id',$request->booking)->first();
         
        if($request->type=='cancel') {
            $subscription->status = 'cancel';
            $meg="Subscription cancelled successfully";
            $booking->booking_subscription_status='Cancelled';
            $message = "❌ *Your  subscription Has Been Cancelled*\n\nWe're sorry to see you go. If this was a mistake or you change your mind, you can reactivate anytime at  your dashboard\n\nThanks for being a part of Elyvato.";

        $MangerMessage = "❌ *Subscription Cancelled*\n\nUser *{$user->name}* ({$user->email}) has cancelled their  booking subscription on Elyvato.\n\nPlease update the records and follow up if needed.\nDashboard: https://elyvato.com/admin";

            
       sendEmail(
                    $user->email,
                    'ELYVATO | Your  Subscription has been Cacelled',
                    'emails.subscription_cancelled',
                    [
                        'time' => $subscription->subscription,
                        'booking_id'=>$booking->booking_id,
                        'date'=>Carbon::now(),
                        'user'=>$user,
                        'status'=>'Cancelled'
                    ]
            );
            
             sendEmail(
                    $manager->email,
                    'ELYVATO | Subscription Cacelled',
                    'emails.manager_update_customer_subscription',
                    [
                        'time' => $subscription->subscription,
                        'booking_id'=>$booking->booking_id,
                        'date'=>Carbon::now(),
                        'user'=>$user,
                        'status'=>'Cancelled'
                    ]
            );
            

        }else{
             $subscription->status = 'live';
             $booking->booking_subscription_status='live';
             $meg="Subscription live successfully";
             $message = "✅ *Your  Subscription is Now Active!*\n\nWelcome back! You now have full access to all premium features on *elyvato.com*. Let’s build something amazing together.\n\nThanks for choosing Elyvato!";
             
             $MangerMessage = "✅ *Subscription Activated*\n\nUser *{$user->name}* ({$user->email}) has activated their subscription on Elyvato.\n\nAll premium features are now live. Please assign/reassign tasks as needed.\nDashboard: https://elyvato.com/admin";
        
         sendEmail(
                    $user->email,
                    'ELYVATO |🎉 Youre Back! Elyvato Subscription Activated',
                    'emails.subscription_active',
                    ['time' => $subscription->subscription,
                    'booking_id'=>$booking->booking_id,
                    'date'=>Carbon::now(),
                    'user'=>$user,
                    'status'=>'Activate'
                    ]
            );
            
            
            sendEmail(
                    $manager->email,
                    'ELYVATO | Subscription Activated',
                    'emails.manager_update_customer_subscription',
                    [
                        'time' => $subscription->subscription,
                        'booking_id'=>$booking->booking_id,
                        'date'=>Carbon::now(),
                        'user'=>$user,
                        'status'=>'Activate'
                    ]
            );
            

        }
    
     
     if($subscription->save()){


        $booking->save();
        
         $mobile=$user->mobile;
         $managerMobile=$manager->mobile;
        
        sendWhatsAppMessage($mobile, $message);
        
        sendWhatsAppMessage($managerMobile, $MangerMessage);
        
         return response()->json(['success' => true,'message'=>$meg]);
        
     }
    
            
        return response()->json(['success' => false]);
    }


    



    public function BookingDetails($id){

        
        $userProfile = UserProfile::where('user_id',Auth::user()->id)->first(); 

            $requiredFields = [
                'company_name',
                // 'gst_number',
                // 'work_strength',
                'role_designation_id',
                'address_line1',
                // 'address_line2',
                // 'city',
                'state',
                // 'image',
                'country',
                'pincode',
                'industry_type',
            ];

            foreach ($requiredFields as $field) {
                if (empty($userProfile->$field)) {
                    return redirect('/user/profiles')->with('error', 'Please complete your profile first.');
                }
            }

         $bookingId = Crypt::decrypt($id);

        $data['title']="Elyvato | Booking Details";
        $data['booking']=Booking::where(['id'=>$bookingId,'user_id'=>Auth::user()->id])->with('statementOfWork','firstCall','project','project.milestones','project.milestones.tasks')->first();
        // @dd($data['booking']);
        return view('user.booking_details',$data);
        // return view('user.booking_details_old_latest',$data);
    }

     public function PaymentsList(){

        
        $userProfile = UserProfile::where('user_id',Auth::user()->id)->first(); 

            $requiredFields = [
                'company_name',
                // 'gst_number',
                // 'work_strength',
                'role_designation_id',
                'address_line1',
                // 'address_line2',
                // 'city',
                'state',
                // 'image',
                'country',
                'pincode',
                'industry_type',

                // username,email,phone,user_role,address1,state,pincode,industrytype

                
            ];

            foreach ($requiredFields as $field) {
                if (empty($userProfile->$field)) {
                    return redirect('/user/profiles')->with('error', 'Please complete your profile first.');
                }
            }

        $data['title']="Payment List";
        $data['payments']=Payment::where('created_by',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        // dd($data);
        return view('user.payment_list',$data);
    }

    public function UserProfile(){
        $data['title']="User Profile";
        $data['country']=Country::get();
        $data['state']=State::where('is_live',1)->get();
        $data['profile']=UserProfile::where('user_id',Auth::user()->id)->first();
       
        // dd($data['profile']);
        $data['roles']=Role::whereIn('id',[5,6,7])->get();
       $data['role_designation']=RoleDesignation::where('is_active',1)->get();
      

        $data['role']=Role::where('id',Auth::user()->role_id)->first();
        // dd(Auth::user()->role_id);
        return view('user.profile',$data);
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }


public function UpdateProfile(Request $request)
{
    //  dd(Auth::user()->id,$request->all());
        $rules = [
        'username' => 'required|unique:admins,username,' . Auth::user()->id,
        'email' => 'required|email|unique:admins,email,' . Auth::user()->id,
        'mobile' => 'required|numeric|digits:10',
        'role' => 'required|exists:roles,id',
        'company_name' => 'required|string|max:255',
        'address_line1' => 'required|string|max:255',
        'country' => 'required|exists:countries,id',
        'state' => 'required',
        'pincode' => 'required',
        'industry_type' => 'required|string|max:255',
        'role_designation' => 'required|exists:role_designations,id',
    ];

    
    $messages = [
        'required' => ':attribute is required.',
        'email' => 'The email must be a valid email address.',
        'numeric' => ':attribute must be a number.',
        'exists' => 'The selected :attribute is invalid.',
        'unique' => ':attribute is already taken, please choose another.',
        'digits' => ':attribute must be exactly :digits digits.',
        'string' => ':attribute must be a valid string.',
        'max' => ':attribute may not be greater than :max characters.',
    ];


    // dd($request->all());
    // Perform the validation
    $validator = Validator::make($request->all(), $rules, $messages);

   
    if ($validator->fails()) {
        return response()->json(['status' => false, 'message' => $validator->errors()], 422);
    }

   
    $user = Admin::where('id', Auth::user()->id)->first();
    $user->username = $request->username;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
    $user->role_id = $request->role;
    $user->save();

    // Update user profile
    $UserProfile = UserProfile::where('user_id', Auth::user()->id)->first();

    if (empty($UserProfile)) {
        $UserProfile = new UserProfile();
    }

    // File upload handling (if any)
    if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(base_path('../public_html/upload/profile'), $filename);
        $UserProfile->image = 'upload/profile/' . $filename;
    }

    // Save profile details
    $UserProfile->company_name = $request->company_name;
    $UserProfile->gst_number = $request->gst_number;
    $UserProfile->address_line1 = $request->address_line1;
    $UserProfile->address_line2 = $request->address_line2;
    $UserProfile->country = $request->country;
    $UserProfile->state = $request->state;
    $UserProfile->city = $request->city;
    $UserProfile->pincode = $request->pincode;
    $UserProfile->industry_type = $request->industry_type;
    $UserProfile->role_designation_id = $request->role_designation;
    $UserProfile->work_strength = $request->work_strength;
    $UserProfile->created_by = Auth::user()->id;

    if ($UserProfile->save()) {
        return response()->json(['status' => true, 'message' => 'Profile updated successfully']);
    }else{
    return response()->json(['status' => false, 'message' => 'Something went wrong!']);

    }

}

 
public function UpdateFreelancerProfile(Request $request)
{
    $rules = [
        'username' => 'required|unique:admins,username,' . Auth::user()->id,
        'email' => 'required|email|unique:admins,email,' . Auth::user()->id,
        'mobile' => 'required|numeric|digits:10',
        'role' => 'required|exists:roles,id',
        'company_name' => 'required|string|max:255',
        'address_line1' => 'required|string|max:255',
        'country' => 'required|exists:countries,id',
        'state' => 'required',
        'pincode' => 'required',

        // New validation rules
        'talent_definition' => 'nullable|string',
        'years_experience' => 'nullable|min:0',
        'highest_qualification' => 'nullable|string|max:255',
        'languages_spoken' => 'nullable|string|max:255',
        'certification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        'portfolio_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:4096',
        'rate_card_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
    ];

    $messages = [
        'required' => ':attribute is required.',
        'email' => 'The email must be a valid email address.',
        'numeric' => ':attribute must be a number.',
        'exists' => 'The selected :attribute is invalid.',
        'unique' => ':attribute is already taken, please choose another.',
        'digits' => ':attribute must be exactly :digits digits.',
        'string' => ':attribute must be a valid string.',
        'max' => ':attribute may not be greater than :max characters.',
        'file' => ':attribute must be a valid file.',
        'mimes' => ':attribute must be of type: :values.',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'message' => $validator->errors()], 422);
    }

    // dd($request->all());
    // Update Admin basic details
    $user = Admin::find(Auth::user()->id);
    $user->username = $request->username;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
    $user->role_id = $request->role;
    $user->save();

    // Update or create user profile
    $UserProfile = UserProfile::firstOrNew(['user_id' => Auth::user()->id]);


    // $uploadPath = base_path('../public_html/upload/profile');
    $uploadPath = base_path('../public/upload/profile');

    if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($uploadPath, $filename);
        $UserProfile->image = 'upload/profile/' . $filename;
    }

    if ($request->hasFile('certification_file')) {
        $file = $request->file('certification_file');
        $filename = time() . '_cert_' . $file->getClientOriginalName();
        $file->move($uploadPath, $filename);
        $UserProfile->certification_file = 'upload/profile/' . $filename;
    }

    if ($request->hasFile('portfolio_file')) {
        $file = $request->file('portfolio_file');
        $filename = time() . '_portfolio_' . $file->getClientOriginalName();
        $file->move($uploadPath, $filename);
        $UserProfile->portfolio_file = 'upload/profile/' . $filename;
    }

    if ($request->hasFile('rate_card_file')) {
        $file = $request->file('rate_card_file');
        $filename = time() . '_ratecard_' . $file->getClientOriginalName();
        $file->move($uploadPath, $filename);
        $UserProfile->rate_card_file = 'upload/profile/' . $filename;
    }

    // Save profile details
    $UserProfile->company_name = $request->company_name;
    $UserProfile->gst_number = $request->gst_number;
    $UserProfile->address_line1 = $request->address_line1;
    $UserProfile->address_line2 = $request->address_line2;
    $UserProfile->country = $request->country;
    $UserProfile->state = $request->state;
    $UserProfile->city = $request->city;
    $UserProfile->pincode = $request->pincode;
    $UserProfile->industry_type = $request->industry_type;
    $UserProfile->role_designation_id = $request->role_designation;
    $UserProfile->work_strength = $request->work_strength;
    $UserProfile->created_by = Auth::user()->id;

    // New fields
    $UserProfile->talent_definition = $request->talent_definition;
    $UserProfile->years_experience = $request->years_experience;
    $UserProfile->highest_qualification = $request->highest_qualification;
    $UserProfile->languages_spoken = $request->languages_spoken;

    if ($UserProfile->save()) {
        return response()->json(['status' => true, 'message' => 'Profile updated successfully']);
    } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong!']);
    }
}



    public function changePassword(Request $request)
    {
        $admin = Admin::where('id',Auth::user()->id)->first();
       
        
        $validator = Validator::make($request->all(), [
    'old_password' => ['required'],
    'new_password' => ['required', 'min:6', 'confirmed'],
]);

if ($validator->fails()) {
    return response()->json(['errors' => $validator->errors()], 422);
}

if (!Hash::check($request->old_password, $admin->password)) {
    return response()->json(['errors' => ['old_password' => ['Old password is incorrect']]], 422);
}

$admin->password = Hash::make($request->new_password);
$admin->save();

return response()->json(['message' => 'Password updated successfully.']);


    }
    
    
// here task list functionn 

 public function TaskList(Request $request)
    {
        $data['title'] = "Task List";
        $data['services'] = Service::all();
        $data['sub_services'] = SubService::all();
        $data['users'] = Admin::with('role')->where('role_id', 4)->get();

        // Query now directly fetches non-deleted tasks assigned to the logged-in user.
        $query = Task::with('milestone')
                     ->where([
                         'is_deleted' => 0,
                         'assigned_to' => auth()->id() // Fetches tasks for the current user
                     ]);

        $data['tasks'] = $query->paginate(10);
        
        return view('user.task_list', $data);
    }


    public function TasksDetails(Request $request)
    {

        $task = Task::where('id',$request->id)->first();

        $user=GetUser($task->assigned_to);
        // $task_history=TaskHistory::with('createdBy')->where(['task_id'=>$request->id,'is_commit'=>'yes','created_by'=>Auth::user()->id])->get();
        $task_history=TaskHistory::with('createdBy')->where(['task_id'=>$request->id,'is_commit'=>'yes'])->get();

        $name='( '.GetUser($task->created_by)->name.' )';

        // dd($name);
        $status=$task->status;

        return response()->json([
            'title' => $user->name.' '.$user->email,
            'status'=>$status,
            'description' => $task->description,
            'due_date' => $task->due_date ? date('Y-m-d', strtotime($task->due_date)) : '',
            'assignee' => $user->name ?? '',
            'created_by' => $name,
            'task_history'=>$task_history,
        ]);

    }



public function updateBankDetails(Request $request)
    {
        $rules = [
            'account_holder_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'ifsc_code' => [
                'required',
                'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
                'size:11'
            ],
            'account_number' => 'required|numeric|digits_between:9,18',
        ];

        $messages = [
            'required' => ':attribute is required.',
            'regex' => 'The :attribute format is invalid.',
            'digits_between' => ':attribute must be between :min and :max digits.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 422);
        }

        $UserProfile = UserProfile::firstOrNew(['user_id' => Auth::user()->id]);

        $UserProfile->account_holder_name = $request->account_holder_name;
        $UserProfile->bank_name = $request->bank_name;
        $UserProfile->ifsc_code = strtoupper($request->ifsc_code);
        $UserProfile->account_number = $request->account_number;
        $UserProfile->updated_by = Auth::user()->id;

        if ($UserProfile->save()) {
            return response()->json(['status' => true, 'message' => 'Bank details updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong!']);
        }
    }

}
