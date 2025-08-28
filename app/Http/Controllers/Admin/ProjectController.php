<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Admin;
use App\Models\DispatchUpdate;
use App\Models\Country;
use App\Models\Role;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Project;
use App\Models\StatementOfWork;
use App\Models\GstRate;
use App\Models\Milestone;
use App\Models\UserProfile;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Task;
use App\Models\HireTalent;
use App\Models\Note;

use App\Models\Call;
use App\Models\CustomeBooking;
use App\Models\TaskHistory;
use App\Models\InitialPaymentSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Hash;


class ProjectController extends Controller
{

    public function ShowProject(Request $request)
    {

        $userId = Auth::user()->id;
         $userRole = getRoleNamebyId(Auth::user()->role_id)->name_slug;
                $query = Project::with([
                    'booking',
                    'accountManager',
                    'employee',
                    'booking.sow',
                    'booking.sow.service',
                    'booking.sow.subservice'
                ]);

        
        // Role-based check for admin or super-admin
        if ($userRole != 'super-admin' && $userRole != 'admin') {
            // Filter by assigned user if not admin or super-admin
            $query->whereHas('booking', function ($q) use ($userId) {
                $q->where('assign_to', $userId);
            });
        }

        if ($request->filled('service_id')) {
            $query->whereHas('booking.sow', function ($q) use ($request) {
                $q->where('service_id', $request->service_id);
            });
        }

        if ($request->filled('sub_service_id')) {
            $query->whereHas('booking.sow', function ($q) use ($request) {
                $q->where('subservice_id', $request->sub_service_id);
            });
        }

        if ($request->filled('account_manager')) {
            $query->where('account_manager_id', $request->account_manager);
        }

        if ($request->filled('employee')) {
            $query->where('employee_id', $request->employee);
        }

        if ($request->filled('status')) {
            $query->where('project_status', $request->status);
        }

        $data['title'] = "Projects";
        $data['projects'] = $query->orderBy('created_on', 'desc')->get();
        $data['services'] = Service::get();
        $data['sub_services'] = SubService::get();
        $data['milestone'] = Milestone::get();
        $data['users'] = Admin::get();
        $data['employeeUser'] = Admin::where('role_id', 4)->get();
        $data['account_manager'] = Admin::where('role_id', 3)->get();
        $data['bookings'] = Booking::orderBy('id','desc')->get();

        return view('admin.project.index', $data);
    }

public function CreateProject(Request $request){
     $request->validate([
        'booking'=>'required',
        'account_manager'=>'required',
        'employee'=>'required',
        'project_description'=>'required',
     ]);

     $booking=Booking::where('id',$request->booking)->first();

     $pro=new Project();
     $pro->booking_id=$booking->id;
     $pro->account_manager_id=$request->account_manager;
     $pro->employee_id=$request->employee;
     $pro->description=$request->project_description;
     $pro->created_by=Auth::user()->id;

     $pro->project_status=$request->project_status ?? 'not_started';

     if($pro->save()){
        return response()->json(['success'=>true,'message'=>'Project created successfully']);
        }else{
        return response()->json(['success'=>false,'message'=>'Faild to create project!']);
        }
}


    public function ShowBooking()
    {
        $data['title'] = "Bookings";
        $userId = Auth::user()->id;
        $userRole = getRoleNamebyId(Auth::user()->role_id)->name_slug; 
    
        // Role-based check for Admin or Super Admin
        if ($userRole == 'super-admin' || $userRole == 'admin') {
           
            $data['predefinedBookings'] = Booking::with(['user', 'statementOfWork'])
                ->where('booking_type', 'predefined_gig')
                ->orderBy('created_on', 'desc')
                ->get();
    
            $data['customBookings'] = Booking::with(['user', 'statementOfWork'])
                ->where('booking_type', 'custom_gig')
                ->orderBy('created_on', 'desc')
                ->get();

                $data['instantHire'] = Booking::with(['user', 'statementOfWork','hireTalent'])
                ->where('booking_type', 'instant_hire')
                ->orderBy('created_on', 'desc')
                ->get();

        } else {
            // Normal users — show only their assigned bookings
            $data['predefinedBookings'] = Booking::with(['user', 'statementOfWork'])
                ->where('booking_type', 'predefined_gig')
                ->where('assign_to', $userId)
                ->orderBy('created_on', 'desc')
                ->get();
    
            $data['customBookings'] = Booking::with(['user', 'statementOfWork'])
                ->where('booking_type', 'custom_gig')
                ->where('assign_to', $userId)
                ->orderBy('created_on', 'desc')
                ->get();
                
            $data['instantHire'] = Booking::with(['user', 'statementOfWork','hireTalent'])
                ->where('booking_type', 'instant_hire')
                ->where('assign_to', $userId)
                ->orderBy('created_on', 'desc')
                ->get();
        }
    
        // Users with role_id 3 (e.g., Account Managers)
        $data['users'] = Admin::where('role_id', 3)->get();
    
        return view('admin.booking.index', $data);
    }

 public function ProjectDetails($project_id){

        // dd($project_id);

        $data['title']="Projects Bookings";
        $data['project'] = Project::with([
            'booking.statementOfWork.service',
            'booking.statementOfWork.subservice',
            'booking.payments',
            'booking.user',
            'booking.notes',
            'accountManager',
            'employee',

        ])->findOrFail($project_id);

        $data['account_manager']=Admin::where('role_id',3)->get();
        $data['employee']=Admin::where('role_id',4)->get();
        $data['milestone']=Milestone::with('task')->where('project_id',$project_id)->get();
        // dd($data['project']);

        $data['services'] = Service::all();
        $data['sub_services'] = SubService::all();
        $data['users'] = Admin::with('role')->where('role_id',4)->get();

         $query=Task::with('milestones')->where(['is_deleted'=>0,'created_by'=>Auth::user()->id]);
        // show all task for admin

        if(getRoleNamebyId(Auth::user()->role_id)->name_slug=='super-admin'){
            // $query->where('')
            $query->where('is_deleted',0);
        }

        // show task only created by account manager

        if(getRoleNamebyId(Auth::user()->role_id)->name_slug=='account_manager'){
            $query->where(['created_by'=>Auth::user()->id]);
        }

        // here get user employee get own task
        if(getRoleNamebyId(Auth::user()->role_id)->name_slug=='employee'){
            $query->where(['created_by'=>Auth::user()->id]);
        }
        $data['tasks'] =$query->get();

        // dd($data);

        return view('admin.project.project_details',$data);
    }


    public function BookingCalls($id){
        $data['title']="Booking Calls";
        // dd($data);
        $data['call_bookings'] =Call::with('booking','booking.project')->where('booking_id',$id)->orderBy('id','desc')->get();
        $data['custom_booking']=CustomeBooking::where('booking_id',$id)->first();
         
         if (empty($data['call_bookings'])) {
            return redirect()->back()->with('error', 'No manager is assign in this booking.');
        }
        return view('admin.booking.booking_call',$data);
    }


    public function MannualAssignToBooking(Request $request){
        //  $request->booking_id
        
        $booking=Booking::where('id',$request->booking_id)->first();
        $booking->assign_to=$request->assign_to;
        if($booking->save()){
            $check=Project::where('booking_id',$request->booking_id)->first();
            if(empty($check)){
                 Project::create([
                    'booking_id' => $request->booking_id,
                    'account_manager_id' => $request->assign_to,
                    'project_status' => 'not_started',
                    'created_by' => Auth::user()->id,
                ]);
            }
           
            return response()->json(['success'=>true,'message'=>'Booking Assign Successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Faild to assign !']);
        }
    }


     public function UpdateProjectDetails(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'description' => 'required',
        ]);

        // dd($request->all());
       
        $pro=Project::where('id',$request->project_id)->first();
        // if(empty($pro)){
        //     $pro=Booking::where('id',$request->project_id)->first();
        // }
        

        $pro->description= $request->description;
        $pro->updated_at=now();
        $pro->updated_by=Auth::user()->id;
        $pro->save();

        return response()->json(['success' => true, 'message' => 'Details updated successfully.']);
    }


    public function AddProjectDetails(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'description' => 'required',
        ]);

        // dd($request->all()); 

        $note=new Note();

        $note->note=$request->description;
        $note->booking_id=$request->booking_id;
        $note->updated_at=now();
        $note->created_by=Auth::user()->id;
        $note->save();
        if($note->save()){
            return response()->json(['success' => true, 'message' => 'Project details saved successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Faild to add details!']);
    }


    public function updateStatus(Request $request)
    {
        
        $project = Project::find($request->id);

        if (!empty($project)) {
            $project->project_status = $request->status;
            if($request->status=='active'){
                // dd($request->all());
                
                $project->started_at=now();

                $booking=Booking::where('id',$project->booking_id)->first();
                
                if(!empty($booking->sow_id)){
                    $sow=StatementOfWork::where('id',$booking->sow_id)->first();
                    $service=Service::where('id',$sow->service_id)->first();
                    $service_name=$service->title;
                }

                if($booking->booking_type=='instant_hire'){
                    $hire=HireTalent::where('id',$booking->hire_talent_id)->first();
                    $service_name=$hire->name;
                }

                // Send email to user when project starts
                $user = Admin::find($booking->user_id);

                sendEmail(
                    $user->email,
                    'ELYVATO | Team Onboarded. Content Launch Begins',
                    'emails.project_started',
                    [
                        'user' => $user,
                        'service' => $service_name,
                        'project'=>$project
                    ]
                );
            }elseif($request->status=='completed'){
                $project->completed_at=now();
            }
            
            $project->project_status = $request->status;
            $project->save();
            return response()->json(['success' => true,]);
        }
        return response()->json(['success' => false], 404);
    }


    // Store milestone
    public function storeMilestone(Request $request)
    {
        $status=false;
        // Validate form data
        $request->validate([
            'project_id'=>'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after_or_equal:today',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed',
        ]);


        $project = Project::with(['booking'])->where('id',$request->project_id)->first();

        $check=Milestone::where('project_id',$request->project_id)->where('status','!=','completed')->orderBy('id','desc')->first();
        // dd($request->all(),$check);
        if(!empty($check)){
            // if($check->status=='pending' ||  $check->status=='request_payment'){
                $msg="This project milestone still pending complete first then add new milestone";
                $code=201;
                $milestone='';
                $status=false;
            // }
        }else{

            $Total_amount=Payment::where('booking_id',$project->booking->id)->sum('amount');
            $sow=StatementOfWork::where('id',$project->booking->sow_id)->first();

            if($Total_amount < $project->booking->total_price ){

                if($request->amount <= $project->booking->total_price){

                    // Save milestone
                    $milestone = new Milestone();
                    $milestone->project_id = $request->project_id;
                    $milestone->title = $request->title;
                    $milestone->description = $request->description;
                    $milestone->due_date = $request->due_date;
                    $milestone->amount = $request->amount;
                    $milestone->status = $request->status;

                    $milestone->created_on = now();
                    $milestone->created_by = Auth::id();
                    $milestone->updated_by = Auth::id();

                    $milestone->save();
                    $msg="Milestone created successfully!";
                    $code=200;
                    $status=true;

                }else{
                    $msg="Milestone amount is greater than project price!";
                    $code=201;
                    $status=false;
                }
            }else{
                    $msg="This project booking amount has been completed you can't add new milestone request";
                    $code=201;
                    $status=false;
            }
        }

        // Return success response
        return response()->json([
            'message' =>$msg,
            'status'=>$status,
            // 'milestone' => $milestone
        ], $code);
    }

    public function CreateTask(Request $request)
    {
        $request->validate([
            'milestone_id' => 'required|integer|exists:milestones,id',
            'assign_to' => 'required|integer|exists:admins,id',
            'title' => 'required|string|max:255',
            'due_date' => 'required',
            'description' => 'required|string',
            'status' => 'required',
        ]);

       

        $task = new Task();
        $task->due_date = $request->due_date;
        $task->milestone_id = $request->milestone_id;
        $task->assigned_to = $request->assign_to;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
  
        $task->created_by = Auth::user()->id;

        $save=$task->save();


        if($save){
            $comment="Task created successfully";

            $user = Admin::find($task->assigned_to);

            sendEmail(
                $user->email,
                'New Task Assigned - ' . config('app.name'),
                'emails.task_assigned',
                [
                    'user' => $user,
                    'task' => $task
                ]
            );

            GenerateTaskHistory($task->id,$comment);

            return redirect()->back()->with('success', 'Task created successfully!');
        }

    }

   

    public function TaskList(){
        $data['title']="Task List";
        $data['services'] = Service::all();
        $data['sub_services'] = SubService::all();
        $data['users'] = Admin::with('role')->where('role_id',4)->get();

         $query=Task::with('milestone')->where('is_deleted',0);
        // show all task for admin

        if(Role(Auth::user()->role_id)->name=='admin'){
            // $query->where('')
            $query->where(['is_deleted'=>0]);

        }
        // show task only created by account manager

        if(Role(Auth::user()->role_id)->name=='account_manager'){
            $query->where(['created_by'=>Auth::user()->id, 'is_deleted'=>0]);
        }

        // here get user own task
        if(Role(Auth::user()->role_id)->name=='employee'){
            $query->where(['assigned_to'=>Auth::user()->id,'is_deleted'=>0]);
        }
        $data['tasks'] =$query->get();

        // dd($data);

        return view('admin.task.task_list',$data);
    }



    public function assignAccountMAnager(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'assign_to_accont_manager' => 'required',
        ]);

        // dd($request->all());

        $pro=Project::where('id',$request->project_id)->first();

        $pro->account_manager_id= $request->assign_to_accont_manager;
        $pro->updated_at=now();
        $pro->save();

        return response()->json(['success' => true, 'message' => 'Account Manager assigned successfully.']);
    }


    public function assignEmployee(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'assign_employee' => 'required',
        ]);

        // dd($request->all());

        $pro=Project::where('id',$request->project_id)->first();

        $pro->employee_id=$request->assign_employee;
        $pro->updated_at=now();
        // $pro->save();
        if($pro->save()){

            $booking=Booking::where('id',$pro->booking_id)->first();

            if(!empty($booking->sow_id)){
                    $sow=StatementOfWork::where('id',$booking->sow_id)->first();
                    $service=Service::where('id',$sow->service_id)->first();
                    $service_name=$service->title;
                }

                if($booking->booking_type=='instant_hire'){
                    $hire=HireTalent::where('id',$booking->hire_talent_id)->first();
                    $service_name=$hire->name;
                }


            
            $user = Admin::find($booking->user_id);
            $assigned_to = Admin::find($pro->employee_id);

            sendEmail(
                $user->email,
                'Elyvato | Your Project Has Been Assigned to  team',
                'emails.project_assigned',   // pending change 
                [
                    'user' => $user,
                    'service' => $service_name,
                    'booking' => $booking,
                    'project' => $pro,
                    'assigned_to' => $assigned_to
                ]
            );

            $message = "🚀 *Your Team’s Gearing Up!*\n\n🚨 Team’s deployed, project’s in motion! Expect updates,momentum, and milestone wins coming your way.\n\n *Assign Project to:*\n\n*Name:* $assigned_to->name\n\n Email: $assigned_to->email ";
        $mobile=$user->mobile;
        // $mobile='+919956398635';
        // dd($mobile);
        $re=sendWhatsAppMessage($mobile, $message);
        // dd($re);
        }


        return response()->json(['success' => true, 'message' => 'Employee assigned successfully.']);
    }


    // show task details

    public function TaskDetails(Request $request)
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

    // marked as complete

    public function MarkedCompleted(Request $request){
        // dd($request->all());

        if(!empty($request->id)){
        $task = Task::findOrFail($request->id);
        
         $task->status='approved';
        $task->updated_by = Auth::user()->id;

         if($task->save()){
            $comment="Task Marked as completed successfully";

            GenerateTaskHistory($task->id,$comment);

            return response()->json(['status'=>true,'message'=>"Marked as approved"]);
         }else{
            return response()->json(['status'=>false,'message'=>"Faild !"]);
         }
        }
    }


    public function ReminderMail(Request $request){
        // dd($request->all());

        if(!empty($request->id)){
        $task = Task::with('milestone')->findOrFail($request->id);
        
        $project=Project::with('booking')->where('id',$task->milestone->project_id)->first();
        // dd($project);
         $task->updated_by = Auth::user()->id;
        $user=GetUser($project->booking->user_id);

         if($task->save()){

            // dd($user->email);
           $che= sendEmail(
                $user->email,
                'ELYVATO | Psst... Something Needs Your Attention.',
                'emails.reminder',   // pending change 
                [
                    'user' => $user,
                ]
            );
            // dd($che,$user->email);

            $message = "⏳ *A Quick Nudge — You're Up!*\n\n⏰ Just nudging you! There’s a step waiting for your action to keep things moving.";
            $mobile=$user->mobile;
            sendWhatsAppMessage($mobile, $message);

            $comment="Reminder mail send successfully";

            GenerateTaskHistory($task->id,$comment);

            return response()->json(['status'=>true,'message'=>$comment]);
         }else{
            return response()->json(['status'=>false,'message'=>"Faild !"]);
         }
        }
    }


    public function storeCommit(Request $request){
        $request->validate([
            'task_id' => 'required|integer',
            'comment' => 'nullable|string',
        ]);

        if(!empty($request->task_id)){

           $task=Task::where('id', $request->task_id)->first();

            $history = TaskHistory::create([
                'task_id'     => $task->id,
                'task_status'  => $task->status,
                'comment'     => $request->comment,
                'created_by'  => auth()->id(),
                'updated_by'  => auth()->id(),
                'updated_on'  => now(),
                'is_delete'   => 0,
                'is_commit'   => 'yes',
            ]);
            return response()->json(['status' => true, 'message'=>"Commit Successfully",'data' => $history]);
        }
        return response()->json(['status' => false, 'message'=>"Task now found",'data' => '']);
    }


    public function DeleteTask(Request $request)
    {
        $taskId = $request->task_id;
        // dd($request->all());

        $history = Task::with('milestone')->where('id', $taskId)->first();
        

        if ($history) {
            if($request->type=='delete'){
                 $history->is_deleted = 1;
                 $msg='Task Deleted Successfully';
            }

            if($request->type=='review'){
                 $project=Project::where('id',$history->milestone->project_id)->first();
                $user=GetUser($project->created_by);

                $history->status ='review';
                 $msg='Task Reviewd Notification Send Successfully';

                 sendEmail(
                    $user->email,
                    "ELYVATO | New Drop Alert — Your Content’s Ready!",
                    'emails.review_request',
                    ['user' => $user->name]
                );

                 $message = "📬 *Your Delivery Has Landed!*\n\n📦 Your delivery’s ready! Head to your dashboard to review, approve, or send it back for tweaks.";
        $mobile=$user->mobile;
        sendWhatsAppMessage($mobile, $message);

            }

            $history->save();

            GenerateTaskHistory($taskId,$msg);

            return response()->json(['status'=>true,'message'=>$msg ]);
        }

        return response()->json(['status'=>false,'message' => 'Comment not found'], 404);
    }


    public function requestMilestone(Request $request)
    {
        // dd($request->all());
        $milestone = Milestone::findOrFail($request->id);
        $milestone->status = 'request_payment';

        if($milestone->save()){

           
            $project = Project::find($milestone->project_id);
            $booking = Booking::find($project->booking_id);


            if(!empty($booking->sow_id)){
                    $sow=StatementOfWork::where('id',$booking->sow_id)->first();
                    $service=Service::where('id',$sow->service_id)->first();
                    $service_name=$service->title;
                }

                if($booking->booking_type=='instant_hire'){
                    $hire=HireTalent::where('id',$booking->hire_talent_id)->first();
                    $service_name=$hire->name;
                }

            

            $user = Admin::find($booking->user_id);

            sendEmail(
                $user->email,
                'ELYVATO | Project Kicked Off. Milestones Mapped. Let’s Roll',
                'emails.milestone_payment_request',
                [
                    'user' => $user,
                    'milestone' => $milestone,
                    'project' => $project,
                    'service'=>$service_name,
                ]
            );
         $check_milestone = Milestone::where('project_id',$project->id)->count();
          
         if($check_milestone==1){

            $message = "📝 *We’ve Kicked Things Off!*\n\n📋 Your project’s live, milestones mapped, and advance locked in. We’re all set to roll up our sleeves.";
            $mobile=$user->mobile;
            
            // $mobile='+919956398635';
            
            sendWhatsAppMessage($mobile, $message);

            $firstMilestontemplateData = [
                'name' => 'project_acknowledgement',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $service_name],  
                            ['type' => 'text', 'text' => $milestone->title],  
                            ['type' => 'text', 'text' => '₹' .number_format($milestone->amount ?? 0, 2)]
                        ]
                    ]
                ]
            ];

            sendWhatsAppTemplate($mobile, $firstMilestontemplateData);


         }

         if($check_milestone >=1){
            $message = "🎯 *Another Milestone, Checked!*\n\n🧩 We’ve crossed a key milestone — keep an eye on your dashboard for what’s next.";
            $mobile=$user->mobile;
            // $mobile='+919956398635';
            $response=sendWhatsAppMessage($mobile, $message);
            // dd($response);
         }

             

        return response()->json(['status'=>true,'message' => 'Milestone payment requeste send successfully.']);
        }
        return response()->json(['status'=>false,'message' => 'Faild to update.']);
    }


    public function updateCallSchedule(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'call_id' => 'required|exists:calls,id',
            'call_link' => 'required|string',
            'note' => 'nullable|string',
        ]);

        try {
            

            $call = Call::findOrFail($request->call_id);
            $call->call_link = $request->call_link;
            $call->status = 'scheduled';
            $call->notes = $request->note;
            $call->updated_by = Auth::check() ? Auth::id() : null;
            $call->save();


            // here send a email 
            $booking=Booking::where('id',$call->booking_id)->first();
            // dd($booking,$call->booking_id);   
            $user = Admin::find($booking->user_id); // or wherever user_id is stored

            sendEmail(
                $user->email,
                'ELYVATO | Your Content Wingman Has Arrived! ',
                'emails.call_scheduled',
                [
                    'user' => $user,
                    'call_link' => $call->call_link,
                    'notes' => $call->notes,
                    'date_time'=>$call->scheduled_at,
                ]
            );

            $message = "🤝 *Meet Your Guide to Great Content!*\n\n🤝 Call’s booked, and your dedicated Account Manager is ready to lead the way. Let’s build something awesome.";

            $mobile=$user->mobile;
            sendWhatsAppMessage($mobile, $message);

            $accountManagertemplateData = [
                    'name' => 'discovery_call_account_manager_deployement',
                    'language' => ['code' => 'en']
                ];

            sendWhatsAppMessage($mobile, $accountManagertemplateData);


            return response()->json([
                'success' => true,
                'message' => 'Call scheduled successfully.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Call Schedule Update Error: ' . $e->getMessage());
            // dd($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'.\Log::error('Call Schedule Update Error: ' . $e->getMessage()),
            ], 500);
        }
    }
    
    
   public function ReScheduleCall(Request $request)
{
    $request->validate([
        'booking_id' => 'required|integer',
        'date'       => 'required|date',
        'time'       => 'required',
        'call_link'  => 'required|string',
        'note'       => 'nullable|string',
    ]);

// dd($request->all());
    try {
        $booking = Booking::findOrFail($request->booking_id);

        // Combine date + time safely
        $scheduledAt = \Carbon\Carbon::parse("{$request->date} {$request->time}");
        $currentCall=Call::where('id',$request->call_id)->update(['status'=>'cancelled']);

        $call = new Call();
        $call->call_link   = $request->call_link;
        $call->booking_id  = $booking->id;
        $call->scheduled_at= $scheduledAt;
        $call->status      = 'scheduled';
        $call->notes       = $request->note;
        $call->updated_by  = Auth::id();
        $call->created_by  = Auth::id();

        if ($call->save()) {

            // 👇 ensure you're fetching the right model
            $user = Admin::find($booking->user_id); 
            if (!$user) {
                throw new \Exception("Admin not found for user_id {$booking->user_id}");
            }

            // Send email
            sendEmail(
                $user->email,
                'ELYVATO | Your Call Has Been Rescheduled!',
                'emails.call_scheduled',
                [
                    'user'      => $user,
                    'call_link' => $call->call_link,
                    'notes'     => $call->notes,
                    'date_time' => $call->scheduled_at,
                ]
            );

            // WhatsApp message
            $message = "🔄 *Reschedule Confirmed!*\n\n📅 Your Account Manager will meet you at the updated time. Let’s keep the momentum going!";
            sendWhatsAppMessage($user->mobile, $message);

      

            return response()->json([
                'success' => true,
                'message' => 'Call rescheduled successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to reschedule call!',
        ]);

    } catch (\Exception $e) {
        \Log::error('Call Schedule Update Error: ' . $e->getMessage());
       dd( $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.'
        ], 500);
    }
}


    public function markCompleted(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'call_id' => 'required|exists:calls,id',
        ]);

        try {
            $call = Call::findOrFail($request->call_id);

            if($request->type=='completed'){
                $call->status = 'completed';
                $msg="Booking Mark As Complete";
            }

            if($request->type=='cancelled'){
                $call->status = 'cancelled';
                $msg="Booking Mark As Cacelled";
            }

            $call->updated_by = Auth::check() ? Auth::id() : null;
            $call->save();

            if($request->bookingType=='custome_booking' && $request->type=='completed'){
                $account_manager = Admin::where('role_id', 3)->first();

                Project::create([
                    'booking_id' => $call->booking_id,
                    'account_manager_id' => $account_manager->id,
                    'project_status' => 'not_started',
                    'created_by' => auth()->id(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => $msg,
            ]);
        } catch (\Exception $e) {
            \Log::error('Mark as Completed Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ], 500);
        }
    }
    
    
    public function updateBookingVisited(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'linkId' => 'required|exists:bookings,id', // Ensure the booking exists in the database
        ]);
        
        // dd($request->all());
    
    if($request->type=='booking'){
        $data = Booking::findOrFail($request->linkId);
    }
    if($request->type=='project'){
        $data = Project::findOrFail($request->linkId);
    }
        // Find the booking by ID
        
    
        // Update the 'is_visited' field to 'yes'
        $data->is_visited = 'yes';
        $data->save();
    
        // Return a success response
        return response()->json(['success' => true]);
    }



}
