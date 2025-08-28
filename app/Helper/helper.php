<?php
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Dipartment;
use App\Services\UserService;
use App\Models\Admin;
use App\Models\Task;
use App\Models\Role;
use App\Models\TaskHistory;
use App\Models\Service;
use App\Models\SubService;
use App\Models\RoleDesignation;
use App\Models\Call;
use App\Models\Project;
use App\Models\UserProfile;
use App\Models\Booking;
use App\Models\StatementOfWork;
use \Carbon\Carbon;
use App\Models\Rating;
use App\Models\TimeSheet;
use App\Models\HireTalent;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;



function fetchAllUserData() {
    return UserService::fetchAllAdminUser();
}

  function generateUniqueUsername($email)
    {
        // take part before @
        $base = strstr($email, '@', true);

        $username = $base;
        $counter = 1;

        // keep looping until we find a free one
        while (Admin::where('username', $username)->exists()) {
            $username = $base . '_' . $counter;
            $counter++;
        }

        return $username;
    }
    

function getYoutubeIdFromEmbed($embedCode) {
    preg_match('/embed\/([^"?&]+)/', $embedCode, $matches);
    return $matches[1] ?? null;
}

function BookingNotification(){
   
        $booking=Booking::where(['assign_to'=>Auth::user()->id,'is_visited'=>'no'])->count();
        
        // GetRoleName(Auth::user()->role_id)
        if(getRoleNamebyId(Auth::user()->role_id)->name_slug=='super-admin' || getRoleNamebyId(Auth::user()->role_id)->name_slug=='admin'){
            $booking=Booking::where('is_visited','no')->count();
        }
    
    
    return $booking;
}

function fetchAdminUserNameById($id) {
    return UserService::fetchAdminUserNameById($id);
}


function getAllRoles()
{
	return \App\Models\Role::all();
}

function getAllPermissions()
{
	return \App\Models\Permission::all();
}


function getRoleNamebyId($id)
{
	return \App\Models\Role::where('id', $id)->first();
}

function getPermissionNamebyId($id)
{
	return \App\Models\Permission::where('id', $id)->first();
}




function getCampaignNamebyId($id)
{
	return \App\Models\Campaign::where('id', $id)->first();
}

function getServiceNamebyId($id)
{
	return \App\Models\Service::where('id', $id)->first();
}


function getAllState()
{
	return \App\Models\State::all();
}


function getStateNamebyId($id)
{
	return \App\Models\State::where('id', $id)->first();
}



function getAllCity()
{
	return \App\Models\City::all();
}


function getCityNamebyId($id)
{
	return \App\Models\City::where('id', $id)->first();
}



function displayDotDot($str){
	$string = mb_strimwidth($str, 0, 65, "...");
	return $string;
}

function GetRoleName($id){
	$user=Admin::where('id',$id)->first();
    return getRoleNamebyId($user->role->id)->name;

}
function GetUser($id){

	$user=Admin::where('id',$id)->first();
	return $user;
}

  /**
     * Paginate a Laravel collection manually.
     */
	function paginateCollection($items, $page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $paginatedItems = $items->slice($offset, $perPage)->values();

        return new LengthAwarePaginator(
            $paginatedItems,
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

	function GenerateTaskHistory($taskId,$comment){

        if (!isset($taskId)) {
            throw new \Exception("task_id are required.");
        }
           $task=Task::where('id',$taskId)->first();

			$history = [
				'task_id'=> $taskId,
				'task_status'  => $task->status,
				'comment'     => $comment,
				'created_by'  => $task->created_by ?? auth()->id(),
				'updated_by'  => $task->updated_by ?? auth()->id(),
				'updated_on'  =>now(),
				'is_delete'   =>  0,
			];

        return TaskHistory::create($history);

	}

    function logEventHistory($eventType, $eventHistory, $formData = [], $userId = null)
    {
		// dd($eventType, $eventHistory, $formData, $userId);

        return \App\Models\LogHistory::create([
            'url' => request()->fullUrl(),
            'event_type' => $eventType,
            'event_history' => $eventHistory,
            'json_data' => json_encode($formData),
            'action_performed_by' => $userId ?? auth()->id(),
        ]);
    }


function Service(){
    return Service::with('subservices')->where('is_active',1)->get();
    // return Service::all();
}

function Hiretalent(){
    return HireTalent::where('is_active',1)->get();
    // return Service::all();
}

function ServiceNmae($id){
    return Service::where('id',$id)->first();
    // return Service::all();
}

function SubServiceNmae($id){
    return SubService::where('id',$id)->first();

}

function SubService(){
    return SubService::where('is_active',1)->get();
    // return Service::all();
}


  function trimWords($text)
    {
        $words = 10;
         $end = '...';
        return \Illuminate\Support\Str::words($text, $words, $end);
    }


    function formatDateReadable($date)
    {
        // return Carbon::parse($date)->format('F d, Y');
        return Carbon::parse($date)->format('F d, Y h:i A');
    }

    //  send email function

    function sendEmail($to, $subject, $view, $data = [], $fromEmail = null, $fromName = null)
    {
        try {
            Mail::send($view, $data, function ($message) use ($to, $subject, $fromEmail, $fromName) {
                $message->to($to)->subject($subject);
                $fromEmail = $fromEmail ?? config('mail.from.address');
                $fromName = $fromName ?? config('mail.from.name');
                $message->from($fromEmail, $fromName);
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            // dd($e->getMessage());
            return $e->getMessage();
        }
    }


    function Role($id){
       return Role::where('id', $id)->first();
    }

    function Designation($id){
       return RoleDesignation::where('id', $id)->first();
    }

    function GetProfile($id){
       $pro= UserProfile::where('user_id',$id)->first();
      
    //   return $pro->image;
     return $pro ? $pro->image : null;
    }

    function UserProfile($id){
       $pro= UserProfile::where('user_id',$id)->first();
      
    //   return $pro->image;
     return $pro;
    }

   


//     // here Handles all three cases:
//     // 1.Priority clients - try Manager 9 first.
//     // 2.Non-priority - try other free managers.
//     // 3.If all others busy - fallback to Manager 9 if he is free.
//     // based on TimeSheet availibility then asing 

//      function assignBookingToAccountManager_oldd($bookingId, $bookingSlot, $UserId)
//         {
//             $customer_profile = UserProfile::where('user_id', $UserId)->first();
//             $designation = '';
//             if (!empty($customer_profile->role_designation_id)) {
//                 $designation = Designation($customer_profile->role_designation_id)->title;
//             }

//             $priorityManagerId = 9;
//             $highPriorityDesignations = ['Founder / Owner', 'Chief Marketing Officer (CMO)', 'Growth Head'];

//             $accountManagers = Admin::where('role_id', 3)->pluck('id')->toArray();
//             $otherManagers = array_filter($accountManagers, fn($id) => $id != $priorityManagerId);

            
//             $isPriorityClient = in_array($designation, $highPriorityDesignations);

            
//             if ($isPriorityClient) {
//                 if (!hasCallConflict($priorityManagerId, $bookingSlot)) {
//                     return assignBooking($bookingId, $bookingSlot, $UserId, $priorityManagerId);
//                 }
//             }

            
//             foreach ($otherManagers as $managerId) {
//                 if (!hasCallConflict($managerId, $bookingSlot)) {
//                     return assignBooking($bookingId, $bookingSlot, $UserId, $managerId);
//                 }
//             }

            
//             if (!$isPriorityClient && !hasCallConflict($priorityManagerId, $bookingSlot)) {
//                 return assignBooking($bookingId, $bookingSlot, $UserId, $priorityManagerId);
//             }

//             return null;
//         }


// function assignBookingToAccountManager($bookingId, $bookingSlot, $UserId)
// {
//     $customer_profile = UserProfile::where('user_id', $UserId)->first();
//     $designation = '';
//     if (!empty($customer_profile->role_designation_id)) {
//         $designation = Designation($customer_profile->role_designation_id)->title;
//     }

//     $priorityManagerId = 9;
//     $highPriorityDesignations = ['Founder / Owner', 'Chief Marketing Officer (CMO)', 'Growth Head'];

//     $accountManagers = Admin::where('role_id', 3)->pluck('id')->toArray();
//     $otherManagers = array_filter($accountManagers, fn($id) => $id != $priorityManagerId);

//     $isPriorityClient = in_array($designation, $highPriorityDesignations);

//     // ✅ Function to check if manager is active today
//     $isManagerActive = function($managerId) {
//         $today = Carbon::today();
//         $clock = TimeSheet::where('user_id', $managerId)
//             ->whereDate('start_time', $today)
//             ->where('is_active', 1)
//             ->latest()
//             ->first();
//         return (bool) $clock;
//     };

//     // 1️⃣ Priority client → Try priority manager first if active & free
//     if ($isPriorityClient && $isManagerActive($priorityManagerId)) {
//         if (!hasCallConflict($priorityManagerId, $bookingSlot)) {
//             return assignBooking($bookingId, $bookingSlot, $UserId, $priorityManagerId);
//         }
//     }

//     // 2️⃣ Try other managers who are active today
//     foreach ($otherManagers as $managerId) {
//         if ($isManagerActive($managerId) && !hasCallConflict($managerId, $bookingSlot)) {
//             return assignBooking($bookingId, $bookingSlot, $UserId, $managerId);
//         }
//     }

//     // 3️⃣ Non-priority client fallback → Try priority manager if active & free
//     if (!$isPriorityClient && $isManagerActive($priorityManagerId) && !hasCallConflict($priorityManagerId, $bookingSlot)) {
//         return assignBooking($bookingId, $bookingSlot, $UserId, $priorityManagerId);
//     }

//     return null;
// }



// function hasCallConflict($managerId, $bookingSlot)
// {
//     $managerBookings = Project::where(['account_manager_id' => $managerId, 'project_status' => 'not_started'])
//         ->pluck('booking_id');

//     return Call::whereIn('booking_id', $managerBookings)
//         ->where('scheduled_at', $bookingSlot)
//         ->where('status', 'pending')
//         ->exists();
// }


// function assignBooking($bookingId, $bookingSlot, $UserId, $managerId)
// {
//     Call::create([
//         'booking_id' => $bookingId,
//         'scheduled_at' => $bookingSlot,
//         'created_by' => $UserId,
//         'status' => 'pending',
//     ]);

//     Booking::where('id', $bookingId)->update(['assign_to' => $managerId]);

//     Project::create([
//         'booking_id' => $bookingId,
//         'account_manager_id' => $managerId,
//         'project_status' => 'not_started',
//         'created_by' => $UserId,
//     ]);
      
//         $user=Admin::where('id',$managerId)->first();

//         // here mail to account maanger notify 
//             sendEmail(
//             $user->email,
//             'New Booking Call Assigned you- ' . config('app.name'),
//             'emails.booking_call_assigned',
//             [
//                 'user' => $user,
//                 'booking_time'=>$bookingSlot,
//             ]
//         );

//     return true;
// }

// end my old booking logic here 

/**
 * Assign booking to account manager
 * Logic:
 * 1. Priority clients → High → Medium → Low manager (least busy first).
 * 2. Non-priority → other active free managers.
 * 3. If still nothing → fallback High → Medium → Low (least busy).
 * 4. If nobody free/active → fallback creates only Call (Project assigned later).
 */
function assignBookingToAccountManager($bookingId, $bookingSlot, $UserId)
{
    $customer_profile = UserProfile::where('user_id', $UserId)->first();
    $designation = '';
    if (!empty($customer_profile->role_designation_id)) {
        $designation = Designation($customer_profile->role_designation_id)->title;
    }

    $highPriorityDesignations = ['Founder / Owner', 'Chief Marketing Officer (CMO)', 'Growth Head'];
    $accountManagers = Admin::where('role_id', 3)->pluck('id')->toArray();
    $isPriorityClient = in_array($designation, $highPriorityDesignations);

    // Priority client → Try High → Medium → Low managers (least busy first)
    if ($isPriorityClient) {
        foreach (['High', 'Medium', 'Low'] as $level) {
            $managerId = getLeastBusyManagerByPriority($level, $bookingSlot);
            if ($managerId) {
                return assignBooking($bookingId, $bookingSlot, $UserId, $managerId);
            }
        }
    }

    // ry other managers who are active today
    foreach ($accountManagers as $managerId) {
        if (isManagerActive($managerId) && !hasCallConflict($managerId, $bookingSlot)) {
            return assignBooking($bookingId, $bookingSlot, $UserId, $managerId);
        }
    }

    // Non-priority client fallback → also try High → Medium → Low
    if (!$isPriorityClient) {
        foreach (['High', 'Medium', 'Low'] as $level) {
            $managerId = getLeastBusyManagerByPriority($level, $bookingSlot);
            if ($managerId) {
                return assignBooking($bookingId, $bookingSlot, $UserId, $managerId);
            }
        }
    }

    // Final safeguard → if no one is active/free, create only Call (not Project yet)
    Call::create([
        'booking_id'   => $bookingId,
        'scheduled_at' => $bookingSlot,
        'created_by'   => $UserId,
        'status'       => 'pending',
    ]);

    Booking::where('id', $bookingId)->update(['assign_to' => null]);

    return null;
}

/**
 * Check if manager is active today
 */
function isManagerActive($managerId)
{
    $today = Carbon::today();
    return TimeSheet::where('user_id', $managerId)
        ->whereDate('start_time', $today)
        ->where('is_active', 1)
        ->exists();
}

/**
 * Pick least busy manager from a given priority level.
 * Criteria: active today + no call conflict + minimum "not_started" projects.
 */
function getLeastBusyManagerByPriority($priorityLevel, $bookingSlot)
{
    $managers = Admin::where('role_id', 3)
        ->where('priority', $priorityLevel)
        ->pluck('id');

    $leastBusy = null;
    $minProjects = PHP_INT_MAX;

    foreach ($managers as $managerId) {
        if (isManagerActive($managerId) && !hasCallConflict($managerId, $bookingSlot)) {
            $projectCount = Project::where('account_manager_id', $managerId)
                ->where('project_status', 'not_started')
                ->count();

            if ($projectCount < $minProjects) {
                $minProjects = $projectCount;
                $leastBusy   = $managerId;
            }
        }
    }

    return $leastBusy;
}

/**
 * Check if manager already has a call at same slot
 */
function hasCallConflict($managerId, $bookingSlot)
{
    $managerBookings = Project::where([
            'account_manager_id' => $managerId,
            'project_status'     => 'not_started'
        ])
        ->pluck('booking_id');

    return Call::whereIn('booking_id', $managerBookings)
        ->where('scheduled_at', $bookingSlot)
        ->where('status', 'pending')
        ->exists();
}

/**
 * Assign booking to manager: create Call, Project, update Booking, send email
 */
function assignBooking($bookingId, $bookingSlot, $UserId, $managerId)
{
    Call::create([
        'booking_id'   => $bookingId,
        'scheduled_at' => $bookingSlot,
        'created_by'   => $UserId,
        'status'       => 'pending',
    ]);

    Booking::where('id', $bookingId)->update(['assign_to' => $managerId]);

    Project::create([
        'booking_id'         => $bookingId,
        'account_manager_id' => $managerId,
        'project_status'     => 'not_started',
        'created_by'         => $UserId,
    ]);
      
    $user = Admin::where('id', $managerId)->first();

    // Send notification email
    sendEmail(
        $user->email,
        'New Booking Call Assigned to you - ' . config('app.name'),
        'emails.booking_call_assigned',
        [
            'user'         => $user,
            'booking_time' => $bookingSlot,
        ]
    );

    return true;
}


 function getUserRating($userId, $default = 4.5)
    {
        $avg = Rating::where('user_id', $userId)->avg('rating');
        $avg = $avg ? round($avg, 1) : $default;

        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $avg ? '★' : '☆';
        }

        return ['stars' => $stars, 'text' => "($avg / 5)"];
    }


    function sendWhatsAppMessage($phone, $message)
    {
        try {
            $client = new Client();

            $baseUrl = config('services.whatsapp.base_url');
            $token   = config('services.whatsapp.token'); // stored in config or .env

            $body = json_encode([
                'phone'   => $phone,
                'message' => $message,
            ]);

            $request = new Request('POST', "$baseUrl/api/send", [
                'Content-Type'  => 'application/json',
                'Authorization' => "Bearer $token", // <-- Add this line
            ], $body);

            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }



    function sendWhatsAppTemplate($phone, $templateData)
    {
        try {
            $client = new \GuzzleHttp\Client();

            $baseUrl = config('services.whatsapp.base_url');
            $token   = config('services.whatsapp.token');

            $body = json_encode([
                'phone' => $phone,
                'template' => $templateData
            ]);

            $response = $client->post("$baseUrl/api/send/template", [
                'headers' => [
                    'Authorization' => "Bearer $token",
                    'Content-Type'  => 'application/json',
                ],
                'body' => $body
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
    
    function CheckTime(){
        $today    = Carbon::today();
         $clock = TimeSheet::where('user_id', Auth::user()->id)
            ->whereDate('start_time', $today)
            ->latest()
            ->first();
        return $clock;
    }
