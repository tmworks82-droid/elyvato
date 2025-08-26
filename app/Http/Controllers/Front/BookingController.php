<?php

namespace App\Http\Controllers\Front;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use validator;
use Auth;
use App\Models\Admin;
use App\Models\State;
use App\Models\City;
use App\Models\Role;
use App\Models\UserProfile;
use App\Models\Faq;
use App\Models\StatementOfWork;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Service;
use App\Models\SubService;
use App\Models\CustomeBooking;
use App\Models\RecurringSubscription;
use App\Models\Project;
use App\Models\Call;
use App\Models\TimeSheet;
use Carbon\Carbon;
use App\Models\HireTalent;

use Hash;

class BookingController extends Controller
{




    public function SowDetails_old($serviceSubserviceSlug, $sowSlug)
    {

        $data['title'] = $serviceSubserviceSlug.' / '. $sowSlug;

        // Try to find matching service by slug
        $service = Service::where('slug', $serviceSubserviceSlug)->first();

        // If not found, try to find a subservice by the same slug
        $subservice = !$service ? Subservice::where('slug', $serviceSubserviceSlug)->first() : null;

        // If neither found, abort
        if (!$service && !$subservice) {
            abort(404);
        }

        // Now fetch the SOW
        $sowQuery = StatementOfWork::where('slug', $sowSlug)
            ->where('is_active', 1)
            ->with('allFiles', 'service', 'subservice');

        if ($service) {
            $sowQuery->where('service_id', $service->id);
        }

        if ($subservice) {
            $sowQuery->where('subservice_id', $subservice->id);
        }

        $data['sows'] = $sowQuery->firstOrFail();

         $account_managers=Admin::where('role_id',3)->pluck('id');
        //  dd($account_managers);
         $bookings=Booking::whereIn('assign_to',$account_managers)->get();
        
        $data['bookedSlots'] = Call::where('scheduled_at', '>=', today())
            ->where('status', 'pending')
            ->get()
            ->map(fn($call) =>Carbon::parse($call->scheduled_at)->format('Y-m-d H:i:s'))
            ->values()
            ->toArray();
            
            // here for live check 
            $today = Carbon::today();

            $activeTimesheet = TimeSheet::whereDate('start_time', $today)
                ->where('is_active', 1)
                ->exists(); // just check if exists
            
            $data['liveStartTime'] = $activeTimesheet ? true : false;
            
            
            $data['name']=$service->name .'/'. $subservice->name;

            $data['servicename']=$service->name;
            $data['serviceSlug']=$service->slug;
            $data['subservice_name']=$subservice->name;
            $data['subserviceSlug']=$subservice->slug;
            // dd($service->name,$subservice->name);
            // dd($service->name,$subservice->name);

        return view('front.sow_details', $data);
    }


    public function SowDetails($serviceSlug, $subOrSowSlug, $maybeSowSlug = null)
    {

        // Check if 3 parameters exist → service/subservice/sow
        if ($maybeSowSlug) {
            $service = Service::where('slug', $serviceSlug)->firstOrFail();
            $subservice = Subservice::where('slug', $subOrSowSlug)->firstOrFail();

            $sow = StatementOfWork::where('slug', $maybeSowSlug)
                ->where('service_id', $service->id)
                ->where('subservice_id', $subservice->id)
                ->where('is_active', 1)
                ->with('allFiles', 'service', 'subservice')
                ->firstOrFail();
        } else {
            // 2-level route: service/sow
            $service = Service::where('slug', $serviceSlug)->firstOrFail();

            $sow = StatementOfWork::where('slug', $subOrSowSlug)
                ->where('service_id', $service->id)
                ->whereNull('subservice_id') // optional check
                ->where('is_active', 1)
                ->with('allFiles', 'service', 'subservice')
                ->firstOrFail();
        }

        $data['sows'] = $sow;
        $data['title'] =$sow->title;

     
// Step 1: Get all account manager IDs
$accountManagers = Admin::where('role_id', 3)->pluck('id');

// Step 2: Get bookings assigned to these managers
$bookings = Booking::whereIn('assign_to', $accountManagers)->get();
$bookingIdToManager = $bookings->pluck('assign_to', 'id'); // [booking_id => assign_to]

// Step 3: Get all future pending calls for those bookings
$calls = Call::whereIn('booking_id', $bookingIdToManager->keys())
    ->where('status', 'pending')
    ->where('scheduled_at', '>=', today())
    ->get();

// Step 4: Add account manager info to each call
$calls->map(function ($call) use ($bookingIdToManager) {
    $call->account_manager = $bookingIdToManager[$call->booking_id] ?? null;
    return $call;
});

// Step 5: Group calls by scheduled_at time
$groupedByTime = $calls->groupBy(function ($call) {
    return Carbon::parse($call->scheduled_at)->format('Y-m-d H:i:s');
});

// Step 6: Keep only times where ALL account managers are booked
$bookedSlots = $groupedByTime->filter(function ($callsAtTime) use ($accountManagers) {
    $bookedManagerIds = $callsAtTime->pluck('account_manager')->unique();
    return $bookedManagerIds->count() === $accountManagers->count();
})->keys()->toArray();

// Step 7: Return the final result
$data['bookedSlots'] = $bookedSlots;

            // dd($data['bookedSlots']);
            
             // here for live check 
            $today = Carbon::today();

            $activeTimesheet = TimeSheet::whereDate('start_time', $today)
                ->where('is_active', 1)
                ->exists(); // just check if exists
            
            $data['liveStartTime'] = $activeTimesheet ? true : false;

            $data['servicename']=$service->name;
            $data['serviceSlug']=$serviceSlug;
            $data['subservice_name']=$subservice->name;
            $data['subserviceSlug']=$subOrSowSlug;
        $data['faqs']=Faq::where('page_name','gig-details')->get();


            // dd($service->name,$subservice->name);
            // dd($data['liveStartTime']);

        return view('front.sow_details', $data);
    }




    public function Booking(){
        $data['title']="Booking";
        return view('front.booking',$data);
    }


    public function CustomeRequirement($slug){
        $data['title']="Pot custom Gig";
        $sow=StatementOfWork::where("slug", $slug)->first();
        $data['sow_id']=$sow->id;
        $data['bookedSlots'] =  Call::where('scheduled_at', '>=', today())
                                ->where('status', 'pending')
                                ->get()
                                ->map(fn($call) =>Carbon::parse($call->scheduled_at)->format('Y-m-d H:i:s'))
                                ->values()
                                ->toArray();
                                
        // here for live check 
            $today = Carbon::today();

            $activeTimesheet = TimeSheet::whereDate('start_time', $today)
                ->where('is_active', 1)
                ->exists(); // just check if exists
            
            $data['liveStartTime'] = $activeTimesheet ? true : false;
            
        // dd($data);
        return view('front.custome_gig',$data);
    }


    public function createRazorpayOrder(Request $request)
    {
    

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // dd(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt' => 'RCPT_' . time(),
            'amount' => $request->price * 100, // Amount in paise
            'currency' => 'INR'
        ]);

        return response()->json([
            'order_id' => $order->id,
            'razorpay_key' => config('services.razorpay.key'),
            'amount' => $order->amount,
            'currency' => $order->currency
        ]);
    }


  public function storeCustomBooking(Request $request)
    {
        // dd($request->all());

        if(empty(Auth::user())){
            return redirect()->route('user_login_form');
        }
        // dd($request->all());

        $request->validate([
            'service' => 'required|integer|exists:services,id',
            'subservice' => 'required|integer|exists:subservices,id',
            'cost_amount' => 'required|numeric|min:10',
            'brief_description' => 'nullable|string|max:1000',
            'selected_date'=>'required',
            'time_slot'=>'required',
        ]);

        // dd($request->all());

         $generated_signature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')
        );

        if ($generated_signature !== $request->razorpay_signature) {
            Log::error(' Razorpay signature mismatch', [
                'expected' => $generated_signature,
                'received' => $request->razorpay_signature
            ]);

            $status="cancelled";

            return response()->json([
                'success' => false,
                'message' => 'Payment signature verification failed.'
            ], 400);
        }else{
            $status="success";
        }
        $UserId= auth()->check() ? auth()->id() : $request->user_id;
        
         $service = Service::findOrFail($request->service);
         $subService = SubService::findOrFail($request->subservice);
        //  $sow = StatementOfwork::findOrFail($request->sow_id);

        // $initialPrice = $request->price;  // This is the paid price (e.g., 29)
        // $totalPrice = $sow->max_price;   // This is the total price (e.g., 500)

        // // Calculate the initial payment percentage
        // $initialPaymentPercentage = ($initialPrice / $totalPrice) * 100;

        // // Optionally, round the result to 2 decimal places for cleaner output
        // $initialPaymentPercentage = round($initialPaymentPercentage, 2);


       $booking= Booking::create([
            'sow_id' => $request->sow_id,
            'initial_paid_amount' => $request->call_boking_price,
            'total_price'=>$request->cost_amount,
            'booking_type' => 'custom_gig',
            'status'=>'pending',
            'payment_status' =>$status, //  Mark as paid
            'created_by'=>$UserId,
            'user_id' => $UserId,
        ]);


        $scheduledAt = date('Y-m-d H:i:s', strtotime($request->selected_date . ' ' . $request->time_slot));

        // Call::create([
        //     'booking_id'=>$booking->id,
        //     'scheduled_at'=>$scheduledAt,
        //     'created_by'=>Auth::user()->id,
        //     'status'=>'pending',
        // ]);

        CustomeBooking::create([
            'service_id'=>$request->service,
            'subservice_id'=>$request->subservice,
            'booking_id'=>$booking->id,
            'sow_id'=>$request->sow_id,
            'cost_amount'=>$request->cost_amount,
            'call_booking_price'=>$request->call_boking_price,
            'user_id'=>$UserId,
            'brief_description'=>$request->brief_description
        ]);

                // here asign booking to account manager 
        assignBookingToAccountManager($booking->id, $scheduledAt,$UserId);
        

        Payment::create([
            'booking_id'=>$booking->id,
            'amount'=>$request->call_boking_price,
            'payment_type'=>'initial',
            'payment_date'=>now(),
            'status'=>$status,
            'transaction_id' => json_encode([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ]),
            'created_by'=>$UserId,
        ]);


        $user = Admin::find($UserId);
        $to = $user->email;

        sendEmail(
            $to,
            'ELYVATO | Your Discovery Call is Booked!',
            'emails.custom_booking',
            [
                'user' => $user,
                'service_name' => $service->name,
                'sub_service_name' => $subService->name,
                'booking' => $booking
            ]
        );

        $message = "📅 *Your Strategy Call Is Locked In!*\n\n📞 Your discovery call is locked. Time to share your vision — we’re here to build solutions around it.";
        $mobile=$user->mobile;
        sendWhatsAppMessage($mobile, $message);


        $bookingtemplateData = [
            'name' => 'discovery_call_booking',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $scheduledAt
                        ]
                    ]
                ]
            ]
        ];

        sendWhatsAppTemplate($mobile, $bookingtemplateData);
       $bookingID=encrypt($booking->id);

        return response()->json([
            'success' => true,
            'booking_id'=>$bookingID,
            'message' => '📅 Your discovery call is locked in. Can’t wait to connect!',
        ]);
    }
   

    public function ProceedToBooking(Request $request)
    {
        //  Step 1: Validate Razorpay Fields
        $request->validate([
            'sow_id' => 'required',
            'time' => 'required',
            'day' => 'required',
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string'
        ]);


        $UserId= auth()->check() ? auth()->id() : $request->user_id;
        // dd($request->all());
        //  Step 2: Verify Signature
        $generated_signature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')
        );

        if ($generated_signature !== $request->razorpay_signature) {
            Log::error(' Razorpay signature mismatch', [
                'expected' => $generated_signature,
                'received' => $request->razorpay_signature
            ]);

            $status="cancelled";

            return response()->json([
                'success' => false,
                'message' => 'Payment signature verification failed.'
            ], 400);
        }else{
            $status="success";
        }

        // dd($request->all());
        //  Step 3: Proceed with Booking Creation
        $sow = StatementOfwork::findOrFail($request->sow_id);
   
        $initialPrice = $request->price;  // This is the paid price (e.g., 29)
        $totalPrice = $sow->max_price;   // This is the total price (e.g., 500)

        // Calculate the initial payment percentage
        $initialPaymentPercentage = ($initialPrice / $totalPrice) * 100;

        // Optionally, round the result to 2 decimal places for cleaner output
        $initialPaymentPercentage = round($initialPaymentPercentage, 2);
        
        $yes='no';
       $subscriptionId=null;
       //   $status=null;
      $status_booking_subscription=null;
        
        if($sow->is_subscription=='yes'){
            $yes='yes';
            
            $recurring_subscription=RecurringSubscription::create([
                'sow_id' => $sow->id,
                'subscription' => $sow->subscription_time, 
                'subscription_dates'=>[
                                        'subscription_one' => now()->format('d-m-Y H:i:s')
                                    ],
                'user_id' => auth()->user()->id,
                'status' => 'live',
            ]);  
            $subscriptionId= $recurring_subscription->id;
            $status_booking_subscription='live';
        }

        $booking = Booking::create([
            'sow_id' => $request->sow_id,
            'initial_paid_amount' =>  $request->price,
            'initial_payment_percentage' => $initialPaymentPercentage,
            'total_price' => $totalPrice,
            'booking_type' => 'predefined_gig',
            'status' => 'pending',
            'payment_status' =>$status, //  Mark as paid
            'created_by' => $UserId,
            'user_id' => $UserId,
            'booking_subscription'=>$yes,
            'booking_subscription_status'=>$status_booking_subscription,
            'subscription_id'=>$subscriptionId,
        ]);
        
        // dd($subscriptionId,$booking->id);

        if($yes=='yes'){
    
            RecurringSubscription::where('id', $subscriptionId)->update(['booking_id' => $booking->id]);

        }

        $scheduledAt = date('Y-m-d H:i:s', strtotime($request->day . ' ' . $request->time));

        // here asign booking to account manager 
       $check= assignBookingToAccountManager($booking->id, $scheduledAt,$UserId);
        // dd($check);
        

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $request->price,
            'payment_type' => 'initial',
            'status' => $status,
            'payment_date' => now(),
            'transaction_id' => json_encode([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ]),
            
            'created_by' => $UserId,
        ]);
        

        $user = Admin::find($UserId);
        $to = $user->email;
        $service_name = ServiceNmae($sow->service_id)->name;

        sendEmail(
            $to,
            'ELYVATO | Your Discovery Call is Booked! - ',
            'emails.booking',
            [
                'user' => $user,
                'service_name' => $service_name,
                'booking' => $booking
            ]
        );

        $message = "📅 *Your Strategy Call Is Locked In!*\n\n📞 Your discovery call is locked. Time to share your vision — we’re here to build solutions around it.";
        $mobile=$user->mobile;
        sendWhatsAppMessage($mobile, $message);


        $bookingtemplateData = [
            'name' => 'discovery_call_booking',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $scheduledAt
                        ]
                    ]
                ]
            ]
        ];

        sendWhatsAppTemplate($mobile, $bookingtemplateData);
      $bookingID=encrypt($booking->id);

        return response()->json([
            'success' => true,
            'booking_id'=>$bookingID,
            'message' => '📅 Your discovery call is locked in. Can’t wait to connect!',
        ]);
    }


//   store instant hire 

 public function ProceedToInstantHire_old(Request $request)
    {
        //  Step 1: Validate Razorpay Fields
        $request->validate([
            'time' => 'required',
            'day' => 'required',
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string'
        ]);
        
        // dd($request->all());


        $UserId= auth()->check() ? auth()->id() : $request->user_id;
        // dd($request->all());
        //  Step 2: Verify Signature
        $generated_signature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')
        );

        if ($generated_signature !== $request->razorpay_signature) {
            Log::error(' Razorpay signature mismatch', [
                'expected' => $generated_signature,
                'received' => $request->razorpay_signature
            ]);

            $status="cancelled";

            return response()->json([
                'success' => false,
                'message' => 'Payment signature verification failed.'
            ], 400);
        }else{
            $status="success";
        }

        // dd($request->all());
        //  Step 3: Proceed with Booking Creation
       
   
        $initialPrice = $request->price;  // This is the paid price (e.g., 29)
        $totalPrice = 0;   // This is the total price (e.g., 500)

     

        // Optionally, round the result to 2 decimal places for cleaner output
        $initialPaymentPercentage = 0;
        
        $yes='no';
       $subscriptionId=null;
       //   $status=null;


        $booking = Booking::create([
           
            'initial_paid_amount' =>  $request->price,
            'initial_payment_percentage' => $initialPaymentPercentage,
            'total_price' => $totalPrice,
            'booking_type' => 'instant_hire',
            'status' => 'pending',
            'payment_status' =>$status, //  Mark as paid
            'created_by' => $UserId,
            'user_id' => $UserId,
            'booking_subscription'=>$yes,
            'booking_subscription_status'=>'live',
            'subscription_id'=>$subscriptionId,
        ]);
        
        
        

        $scheduledAt = date('Y-m-d H:i:s', strtotime($request->day . ' ' . $request->time));


        // here asign booking to account manager 
        assignBookingToAccountManager($booking->id, $scheduledAt,$UserId);

        

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $request->price,
            'payment_type' => 'initial',
            'status' => $status,
            'payment_date' => now(),
            'transaction_id' => json_encode([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ]),
            
            'created_by' => $UserId,
        ]);
        



        $user = Admin::find($UserId);
        $to = $user->email;

        sendEmail(
            $to,
            'ELYVATO | Your Instant Hire Call is schedule! - ',
            'emails.instant_hire',
            [
                'user' => $user,
                'booking' => $booking
            ]
        );

        $message = "📅 *Your Instant hire Call Is Locked In!*\n\n📞 Your Instant Hire call is locked. Time to share your vision — we’re here to build solutions around it.";
        $mobile=$user->mobile;
        // $mobile='+919956398635';
        sendWhatsAppMessage($mobile, $message);


        $bookingtemplateData = [
            'name' => 'discovery_call_booking',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $scheduledAt
                        ]
                    ]
                ]
            ]
        ];

        sendWhatsAppTemplate($mobile, $bookingtemplateData);




        return response()->json([
            'success' => true,
            'message' => '📅 Your Instant hire call is locked in. Can’t wait to connect!',
        ]);
    }
    



// start instant hire here .....................................................................//

 public function InstantHire(Request $request, $slug = null)
    {
        $data['title'] = "Elyvato | Instant Hire Booking";
    
       $query='';
    
        // If slug is present, filter
        if (!empty($slug)) {
            $query = HireTalent::where(['is_active'=>1,'slug'=>$slug])->first();
        }
    
        $data['instanthire'] = $query;
    
    $data['bookedSlots'] = Call::where('scheduled_at', '>=', today())
            ->where('status', 'pending')
            ->get()
            ->map(fn($call) =>Carbon::parse($call->scheduled_at)->format('Y-m-d H:i:s'))
            ->values()
            ->toArray();
            
            // here for live check 
            $today = Carbon::today();

            $activeTimesheet = TimeSheet::whereDate('start_time', $today)
                ->where('is_active', 1)
                ->exists(); // just check if exists
            
            $data['liveStartTime'] = $activeTimesheet ? true : false;
            // dd('hire booking');
        return view('front.instant_hire_booking', $data);
    }

    
    
//   store instant hire 

 public function ProceedToInstantHire(Request $request)
    {
        //  Step 1: Validate Razorpay Fields
        
        $request->validate([
            // 'time' => 'required',
            // 'day' => 'required',
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string'
        ]);
        


        $UserId= auth()->check() ? auth()->id() : $request->user_id;
        // dd($request->all());
        //  Step 2: Verify Signature
        $generated_signature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')
        );

        if ($generated_signature !== $request->razorpay_signature) {
            Log::error(' Razorpay signature mismatch', [
                'expected' => $generated_signature,
                'received' => $request->razorpay_signature
            ]);

            $status="cancelled";

            return response()->json([
                'success' => false,
                'message' => 'Payment signature verification failed.'
            ], 400);
        }else{
            $status="success";
        }

        // dd($request->all());
        //  Step 3: Proceed with Booking Creation
       
   
        $initialPrice = $request->call_boking_price;  // This is the paid price (e.g., 29)
        $totalPrice = $request->cost_amount;   // This is the total price (e.g., 500)

     

        // Optionally, round the result to 2 decimal places for cleaner output
        $initialPaymentPercentage = 0;
        
        $yes='no';
       $subscriptionId=null;
     //   $status=null;


        $booking = Booking::create([
           
            'initial_paid_amount' =>  $request->call_boking_price,
            'initial_payment_percentage' => $initialPaymentPercentage,
            'total_price' => $totalPrice,   
            'booking_type' => 'instant_hire',
            'hire_talent_id'=>$request->hire_talent,
            'status' => 'pending',
            'payment_status' =>$status, //  Mark as paid
            'created_by' => $UserId,
            'user_id' => $UserId,
            'booking_subscription'=>$yes,
            'booking_subscription_status'=>'live',
            'subscription_id'=>$subscriptionId,
        ]);
        
        
        

        $scheduledAt = date('Y-m-d H:i:s', strtotime($request->selected_date . ' ' . $request->time_slot));


        // here asign booking to account manager 
        assignBookingToAccountManager($booking->id, $scheduledAt,$UserId);

        

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $request->call_boking_price,
            'payment_type' => 'initial',
            'status' => $status,
            'payment_date' => now(),
            'transaction_id' => json_encode([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ]),
            
            'created_by' => $UserId,
        ]);
        



        $user = Admin::find($UserId);
        $to = $user->email;

        sendEmail(
            $to,
            'ELYVATO | Your Instant Hire Call is schedule! - ',
            'emails.instant_hire',
            [
                'user' => $user,
                'booking' => $booking
            ]
        );

        $message = "📅 *Your Instant hire Call Is Locked In!*\n\n📞 Your Instant Hire call is locked. Time to share your vision — we’re here to build solutions around it.";
        $mobile=$user->mobile;
        // $mobile='+919956398635';
        sendWhatsAppMessage($mobile, $message);


        $bookingtemplateData = [
            'name' => 'discovery_call_booking',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $scheduledAt
                        ]
                    ]
                ]
            ]
        ];

        sendWhatsAppTemplate($mobile, $bookingtemplateData);
        $bookingID=encrypt($booking->id);



        return response()->json([
            'success' => true,
            'booking_id'=>$bookingID,
            'message' => '📅 Your Instant hire call is locked in. Can’t wait to connect!',
        ]);
    }
    

}
