<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SubService;
use App\Models\StatementOfWork;
use App\Models\ContactUs;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Call;
use App\Models\CaseStudy;
use App\Models\Payment;
use App\Models\HireTalent;
use Auth;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function index(){
        $data['title']="Home";


        $welcometemplateData = [
            'name' => 'registration',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => 'Aayushi' // replace with dynamic value
                        ]
                    ]
                ]
            ]
        ];

        
        // $mobile=$user->mobile;
        $mobile='+919956398635';
         $response=sendWhatsAppTemplate($mobile, $welcometemplateData);


        $sowSubset = StatementOfWork::where('featured','yes')
            // ->inRandomOrder()
            ->take(8)
            ->get();


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

      
        $data['sows'] = $sowSubset;
        $data['bookedSlots'] = $bookedSlots;
        return view('front.index',$data);
    }


    public function Blog(){
        $data['title']="Blog";
        $data['blogs'] = Blog::latest()->paginate(8);
        
        return view('front.blog.index',$data);
    }

    public function Invoice(){
        $data['title']="Invoice";
        $data['payment'] = Payment::with(['booking','creator','creator.profile','booking.statementOfWork'])->where('id',1)->first();
        //  dd($data['payment']);

        return view('front.invoice',$data);
    }



    public function BlogPage($slug)
        {
            // Try to find blog first
            $blog = Blog::where('slug', $slug)->first();
        
            if ($blog) {
                // Blog found → show blog page
                $previous = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
                $next = Blog::where('id', '>', $blog->id)->orderBy('id')->first();
        
                $data['title'] = $blog->seo_title ?? 'Blog';
                $data['blog'] = $blog;
                $data['blogs'] = Blog::orderBy('id', 'desc')->take(4)->get();
                $data['previous'] = $previous;
                $data['next'] = $next;
                $data['blogSlug'] = $slug;
        
                return view('front.blog.single_page_blog', $data);
            }
        
            // If not a blog, try to find category
            $category = Service::where('slug', $slug)->first();
            // dd($category);
            if ($category) {
            // Query blogs where the category string contains the selected category ID
            $data['blogs'] = Blog::where('category', 'LIKE', '%"' . $category->id . '"%') // Use LIKE to find category in the string
                ->paginate(6); // Paginate results
        
            $data['title'] = ''; // Optional: Set a title if needed
            $data['category'] = $category; // Pass the selected category
        // dd('r');
            return view('front.blog.blog_category', $data); // Return the view with the data
        }
        
            // Neither blog nor category found → throw 404 manually
            abort(404);
        }


    public function BlogCategory($categorySlug,$blogSlug)
    {
        // dd('run');
        // $blog = Blog::where('slug', $blogSlug)->firstOrFail();
        $category = Service::where('slug', $categorySlug)->firstOrFail();


        // Get blogs that contain this category ID in their JSON category field
        $data['blogs']  = Blog::whereJsonContains('category', (string) $category->id)
                //  ->where('id', '!=', $blog->id) // optional: exclude current blog
                 ->paginate(6);

        $data['title']='';
        $data['category']=$category;
        // dd($data,$category);
       
        return view('front.blog.blog_category', $data);
    }


    public function searchBlog(Request $request)
    {
        $query = $request->get('q');
        
        $blogs = Blog::where('title', 'LIKE', '%' . $query . '%')
            ->select('title', 'slug')
            ->limit(10)
            ->get();

        return response()->json($blogs);
    }


    public function About(){
        $data['title']="About";
        $data['faqs']=Faq::where('page_name','about')->get();
        return view('front.about',$data);
    }


    public function TermsService(){
        $data['title']="Terms of Services";
        return view('front.terms-of-services',$data);
    }


     public function PrivacyPolicy(){
        $data['title']="Privacy & Policy";
        return view('front.privacy',$data);
    }


    public function ContactCustomer(){
        $data['title']="Contact";
        $data['faqs']=Faq::where('page_name','contact-us')->get();

        return view('front.contact-customer',$data);
    }


    public function ServiceList(Request $request){
        $data['title']="Services";
        // $data['services']=Service::where('is_active',1)->paginate(12);

        
        $query = Service::where('is_active', 1);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data['services'] = $query->paginate(12);

        return view('front.service',$data);
    }


    public function InstantHireList(Request $request){
        $data['title']="Elyvato | Instant Hire";
        // $data['services']=Service::where('is_active',1)->paginate(12);

        
        $query = HireTalent::where('is_active', 1);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data['instanthire'] = $query->paginate(12);
// dd('hire list');
        return view('front.instant_hire_list',$data);
    }
    
    

    public function ServiceSowList(Request $request, $slug)
    {

        $servi = Service::where("slug", $slug)->firstOrFail();
        $data['serviceSlug'] = $servi->slug;
        $data['subServiceSlug'] = '';


        // Start query
        $query = StatementOfWork::where([
            'service_id' => $servi->id,
            'is_active' => 1
        ])->with('allFiles');

        // Apply Delivery Time Filter
        if ($request->has('delivery_time')) {
            $deliveryDays = intval($request->delivery_time); 
            $query->where('estimated_time', '<=', $deliveryDays);
        }
        
        // Budget Max Filter based on max_price column
                if ($request->has('budget_max')) {
                    $query->where('max_price', '<=', (int) $request->budget_max);
                }

        $data['sowList'] = $query->paginate(12);
        $data['selectedDeliveryTime'] = $request->delivery_time; 
        $data['title'] = $servi->name;
        $data['name'] = $servi->name;
        $data['servicename'] = $servi->name;
        $data['service_data'] = $servi;
                // dd($data['sowList']);
        return view('front.sow_list', $data);
    }



   
    public function SubServiceSowLists($serviceSlug, $subserviceSlug, Request $request)
    {
        $data['title'] =$serviceSlug.' / ' .$subserviceSlug;   
        $data['serviceSlug'] = $serviceSlug;
        $data['subServiceSlug'] = $subserviceSlug;

        // dd($request->all());
        // Find the parent service (category)
        $service = Service::where("slug", $serviceSlug)->firstOrFail();

        // Find the subservice under that service
        $subservice = SubService::where("slug", $subserviceSlug)
                                ->where("service_id", $service->id)
                                ->firstOrFail();

        // Start the query
        $query = StatementOfWork::where([
            'subservice_id' => $subservice->id,
            'is_active' => 1
        ]);

        // Apply delivery time filter if present
        if ($request->has('delivery_time')) {
            $maxDays = (int) $request->delivery_time;
            $query->where('estimated_time', '<=', $maxDays); // Make sure this column exists in your DB
        }

            // Budget Max Filter based on max_price column
                if ($request->has('budget_max')) {
                    $query->where('max_price', '<=', (int) $request->budget_max);
                }
        $data['servicename'] = $service->name;
        $data['name'] = $service->name .'-'. $subservice->name;
        $data['sub_servicename'] =  $subservice->name;
        

        // Fetch SOWs with pagination
        $data['sowList'] = $query->with('allFiles')->paginate(12);
        $data['service_data'] = $service ?? $subservice;
        return view('front.sow_list', $data);
    }

   
    

// here save contact us 
    public function store(Request $request)
{
    // S Validate fields including reCAPTCHA
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'service' => 'nullable|string',
        'message' => 'nullable|string',
        'g-recaptcha-response' => 'required', 
    ]);

    //  Verify reCAPTCHA with Google
    $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => '6LdE8IwrAAAAABF8EuVjtgVV-N9Pygy_yiX1DdIA', 
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
    ]);

    if (!$recaptchaResponse->json('success')) {
        return response()->json([
            'status' => false,
            'message' => 'Captcha verification failed. Please try again.',
        ], 422);
    }

    
    $contact = ContactUs::create($validated);

 
    $check = sendEmail(
        'tmworks82@gmail.com',
        'New Contact Us Query from ' . $contact->name,
        'emails.contact_us',
        ['contact' => $contact],
        $contact->email,
        $contact->name
    );

    return response()->json([
        'status' => true,
        'message' => 'Thank you for connecting!
We’ve received your query. Our experts will get back to you shortly with smart solutions tailored to your goals.

.'
    ]);
}


public function searchServices(Request $request)
{
    $query = $request->get('query');

    $html = '';

    // Search Services
    $services = Service::where('name', 'like', '%' . $query . '%')->take(5)->get();

    if ($services->count() > 0) {
       
        foreach ($services as $service) {
            

             $html .='<li class="px-2"><a class="dropdown-item rounded mb-2" style="text-wrap: pretty;" href="/' . $service->slug . '">' . $service->name . '</a></li>';
        }
    }

    // Search SubServices
    $subservices = SubService::where('name', 'like', '%' . $query . '%')->take(5)->get();

    if ($subservices->count() > 0) {
        
        
        foreach ($subservices as $sub) {
            $html .='<li class="px-2"><a class="dropdown-item rounded mb-2" style="text-wrap: pretty;" href="/' . $sub->service->slug . '/' . $sub->slug . '">' . $sub->name . '</a></li>';
        }
    }

    // Search Statement of Work
    $sows = StatementOfWork::where('title', 'like', '%' . $query . '%')->take(5)->get();

    if ($sows->count() > 0) {
        
        foreach ($sows as $sow) {

            $html .='<li class="px-2"><a class="dropdown-item rounded mb-2" style="text-wrap: pretty;" href="/' . $sow->subService->service->slug. '/'. $sow->subService->slug . '/' . $sow->slug . '" target="_blank">' . $sow->title . '</a></li>';
        }
    }

    if ($html == '') {
        $html = '<div class="text-muted">No results found.</div>';
    }

    return response()->json(['html' => $html]);
}


public function getDefaultServices()
{

    $services = Service::get(); 
    $html = '';

    foreach ($services as $service) {
        $html .= '<li class="px-2"><a class="dropdown-item rounded mb-2" style="text-wrap: pretty;" href="/' . $service->slug . '">' . $service->name . '</a></li>';
    }

    
    if ($html == '') {
        $html = '<div class="text-muted">No services available.</div>';
    }

    return response()->json(['html' => $html]);
}

 

    public function CaseStudy(){
        $data['caseStudy']=CaseStudy::latest()->paginate(12);
        return view('front.case_studies',$data);
    }
    
     public function toggleClock(Request $request)
    {
        $userId = Auth::id(); // Current user
        $isActive = $request->is_active;

        // dd($request->all(),Auth::user()->id);
        if ($isActive == 1) {
            // Clock In
            $clock = new TimeSheet();
            $clock->user_id = $userId;
            $clock->start_time = Carbon::now();
            $clock->is_active = 1;
            $clock->created_by = $userId;
            $clock->save();

            return response()->json(['message' => 'Clocked In Successfully']);
        } else {
            // Clock Out - find the last active record
            $clock = TimeSheet::where('user_id', $userId)
                          ->where('is_active', 1)
                          ->latest()
                          ->first();

            if ($clock) {
                $clock->end_time = Carbon::now();
                $clock->is_active = 0;
                $clock->updated_by = $userId;
                $clock->save();
            }

            return response()->json(['message' => 'Clocked Out Successfully']);
        }
    }
    
    public function CommingSoon(){
    $title="Elyvato|Your Next Hire is Moments Away";
        return view('front.comming_soon',compact('title'));
    }


}
