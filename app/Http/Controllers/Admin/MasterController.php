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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Hash;


class MasterController extends Controller
{
    // here is all masters pages

    public function Statement(){
        $data['page_title']="Statement of Work";
        // $data['statement']=StatementOfWork::get();
            $data['statements'] = StatementOfWork::with(['service', 'subservice', 'allFiles'])
                ->orderByDesc('created_on')
                ->get();

        return view('admin.statement.index',$data);
    }


    public function StatementCreate(Request $request,$id=''){
          $data['service']=Service::get();
          $data['subservice']=SubService::get();

          if (!empty($id)) {
            $data['statement'] = StatementOfWork::with('allFiles')->findOrFail($id);
        } else {
            $data['statement'] = null;
        }
        return view('admin.statement.create',$data);
    }


    public function saveStatementOfWork(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'subservice_id' => 'required|exists:subservices,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'price' => 'nullable|numeric|min:0',
            'estimated_time' => 'nullable|string|max:255',
            'is_active' => 'required|in:1,0',
            'subscription'=>'required',
            'seo_title'=>'nullable|string|max:255',
            'meta_description'=>'nullable|string',
        ]);


       
        // Check if we're updating or creating

        if($request->id){
            $statement = StatementOfWork::find($request->id);
            
            $msg="Statement of Work updated successfully.";
        }else{
            $statement=new StatementOfWork();
            $msg="Statement of Work saved successfully.";
        }

        // Set fields
        $statement->service_id = $request->service_id;
        $statement->subservice_id = $request->subservice_id;
        $statement->title = $request->title;
        $statement->description = $request->description;
        $statement->featured = $request->featured;
        $statement->min_price = $request->min_price;
        $statement->max_price = $request->max_price;
        $statement->offer_price = $request->offer_price;
        $statement->estimated_time = $request->estimated_time;
        $statement->is_active = $request->is_active;
        $statement->is_subscription = $request->subscription;
        $statement->seo_title = $request->seo_title;
        $statement->meta_description = $request->meta_description;
        
        if($request->subscription=='no'){
            $statement->subscription_time =null;
        }else{
            $statement->subscription_time=$request->subscription_time;
        }
        //   dd($statement,Auth::user()->id);

        // Set created_by and updated_by
        if (!$statement->exists) {
            $statement->created_by = Auth::user()->id; // For insert
        }
        $statement->updated_by = Auth::user()->id; // Always update this

        $statement->save();

        // here store files
          

        $sowId = $statement->id;

        $fileType = $request->file_type;

        if(!empty($sowId)){
            // dd($request->hasFile('image_path'));
            if ($fileType === 'image' && $request->hasFile('image_path')) {
                // dd( $request->hasFile('image_path'));
                foreach ($request->file('image_path') as $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    // $image->move(public_path('upload'), $filename);
                    $image->move(base_path('../public_html/upload'), $filename);

                    AllFiles::create([
                        'sow_id' => $sowId,
                        'image_path' => 'upload/' . $filename,
                        'audio_path' => null,
                        'video' => null,
                        'file_type'=>$fileType,
                    ]);
                }
            }

                if ($fileType === 'pdf' && $request->hasFile('pdf_file')) {
                    foreach ($request->file('pdf_file') as $pdf) {
                        $filename = time() . '_' . $pdf->getClientOriginalName();
                        $pdf->move(base_path('../public_html/upload'), $filename);

                        AllFiles::create([
                            'sow_id' => $sowId,
                            'image_path' => null,
                            'audio_path' => null,
                            'video' => null,
                            'pdf_path' => 'upload/' . $filename, // Add column if needed
                            'file_type' => $fileType,
                        ]);
                    }
                }

            if ($fileType === 'audio' && $request->hasFile('audio_path')) {
                foreach ($request->file('audio_path') as $audio) {
                    $filename = time() . '_' . $audio->getClientOriginalName();
                    // $audio->move(public_path('upload'), $filename);
                    $image->move(base_path('../public_html/upload'), $filename);

                    AllFiles::create([
                        'sow_id' => $sowId,
                        'image_path' => null,
                        'audio_path' => 'upload/' . $filename,
                        'video' => null,
                        'file_type'=>$fileType,
                    ]);
                }
            }

            if ($fileType === 'video') {
                foreach ($request->input('video', []) as $videoLink) {
                    if (!empty($videoLink)) {
                        AllFiles::create([
                            'sow_id' => $sowId,
                            'image_path' => null,
                            'audio_path' => null,
                            'video' => $videoLink,
                        'file_type'=>$fileType,

                        ]);
                    }
                }
            }
        }

        return redirect()->route('statement')->with('success', $msg);

    }


    public function destroyStatement($id)
    {
        $subservice = StatementOfWork::findOrFail($id);

        $subservice->delete();

        return redirect()->back()->with('success', 'Subservice deleted successfully.');
    }

    public function deleteFile(Request $request)
    {
        $file = AllFiles::find($request->id);

        if ($file) {
            // Delete actual file if image/audio/pdf
            if ($file->file_type == 'image' && $file->image_path && file_exists(base_path('../public_html/' . $file->image_path))) {
                unlink(base_path('../public_html/' . $file->image_path));
            }

            if ($file->file_type == 'audio' && $file->audio_path && file_exists(base_path('../public_html/' . $file->audio_path))) {
                unlink(base_path('../public_html/' . $file->audio_path));
            }

            if ($file->file_type == 'pdf' && $file->pdf_path && file_exists(base_path('../public_html/' . $file->pdf_path))) {
                unlink(base_path('../public_html/' . $file->pdf_path));
            }

            $file->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }



    public function getSubservices(Request $request)
    {
    $serviceId = $request->service_id;
    $subservices = Subservice::where('service_id', $serviceId)->get();

    return response()->json($subservices);
    }


    public function InitialPaymentSetting(Request $request){
        $data['settings']=InitialPaymentSetting::get();

        return view('admin.initial_payment_setting.index',$data);
    }

    public function CreateInitialPaymentSetting(Request $request,$id = null){

        if (!empty($id)) {
            $data['setting'] = InitialPaymentSetting::findOrFail($id);
        } else {
            $data['setting'] = null;
        }
        //  dd($data);

        return view('admin.initial_payment_setting.create',$data);
    }

    public function storeOrUpdate(Request $request, $id = null)
        {
            $request->validate([
                'min_percentage' => 'required|numeric|min:0',
                'max_percentage' => 'required|numeric|min:0',
                'is_active' => 'required|in:1,0',
            ]);

            $data = $request->only('min_percentage', 'max_percentage', 'is_active');
            $data['updated_by'] = auth()->id();

            if ($id) {
                $setting = InitialPaymentSetting::findOrFail($id);
                $setting->update($data);
                $msg = 'Initial Payment Setting updated successfully!';
            } else {
                $data['created_by'] = auth()->id();
                InitialPaymentSetting::create($data);
                $msg = 'Initial Payment Setting created successfully!';
            }

            return redirect()->route('initial-payment-setting')->with('success', $msg);
        }

        public function destroyInitialPayment($id)
        {
            $initi = InitialPaymentSetting::findOrFail($id);

            $initi->delete();

            return redirect()->back()->with('success', 'Initial service  deleted successfully.');
        }


    public function GstRate(Request $request){
        $data['gstRates'] = GstRate::orderBy('created_on', 'desc')->get();
        return view('admin.gst.index',$data);
    }

    public function CreateGstRate(Request $request, $id=null){
        if (!empty($id)) {
            $data['gst'] = GstRate::findOrFail($id);
        } else {
            $data['gst'] = null;
        }
        return view('admin.gst.create',$data);
    }


    public function storeGst(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|numeric|min:0|max:100',
            'description' => 'required|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        if($request->id){
            $gst=GstRate::where('id',$request->id)->first();
            $msg="GST rate updated successfully!";
        }else{
            $gst=new GstRate();
            $msg="GST rate added successfully!";
        }

            $gst->rate =$validated['rate'];
            $gst->description = $validated['description'];
            $gst->is_active = $validated['is_active'];
            $gst->created_on = now();
            $gst->created_by = Auth::id();
            $gst->updated_at = now();
            $gst->updated_by = Auth::id();
            $save=$gst->save();

        return redirect()->route('gst.rate')->with('success', $msg);
    }

    public function DestroyGst($id)
    {
        $initi = GstRate::findOrFail($id);
        $initi->delete();

        return redirect()->back()->with('success', 'Gst rate deleted successfully.');
    }


    public function UserProfile(Request $request){
        // $data['user']=Admin::get();
        $data['profiles']=UserProfile::get();
        return view('admin.user_profile.index',$data);
    }

    public function CreateUserProfile(Request $request, $id=''){
        $data['user']=Admin::get();
        // dd($id);
        if (!empty($id)) {
            $data['profiles'] = UserProfile::findOrFail($id);
        } else {
            $data['profiles'] = null;
        }
        return view('admin.user_profile.create',$data);
    }

    public function storeUserProfile(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'company_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:50',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
            'industry_type' => 'nullable|string|max:100',
            'is_active' => 'required|in:1,0',
        ]);

        if($request->id){
            $profile=UserProfile::where('id',$request->id)->first();
            $msg="User profile updated successfully!";
        }else{
            $profile=new UserProfile();
            $msg="User profile created successfully!";
        }
        // dd($request->all());

        $profile->user_id = $validated['user_id'];
        $profile->company_name = $validated['company_name'];
        $profile->gst_number = $validated['gst_number'] ?? null;
        $profile->address_line1 = $validated['address_line1'] ?? null;
        $profile->address_line2 = $validated['address_line2'] ?? null;
        $profile->city = $validated['city'] ?? null;
        $profile->state = $validated['state'] ?? null;
        $profile->country = $validated['country'] ?? null;
        $profile->pincode = $validated['pincode'] ?? null;
        $profile->industry_type = $validated['industry_type'] ?? null;
        $profile->is_active = $validated['is_active'];
        $profile->updated_by = Auth::id();
        $profile->updated_at = now();
        // dd(Auth::id());
        $profile->save();

        return redirect()->route('user.profile')->with('success',$msg);
    }

    public function DestroyUserProfile($id)
    {
        $initi = UserProfile::findOrFail($id);

        $initi->delete();

        return redirect()->back()->with('success', 'User profile deleted successfully.');
    }


    public function ShowPayments(){
        $data['title']="Payments";
        $data['payments'] = Payment::with(['booking', 'creator', 'updater'])->get();
        return view('admin.payment.index',$data);
    }

    // here add currecny
    public function Currency(){
        $data['title']="Currency";
        $data['currencies']=Currency::get();
        // dd($data);
        // $data['payments'] = Payment::with(['booking', 'creator', 'updater'])->get();
        return view('admin.currency.index',$data);
    }


    public function CurrencyStore(Request $request)
    {
        $request->validate([
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            'currency_name' => 'required',
        ]);

        // dd($request->all());
          if(!empty($request->id)){
            $currency=Currency::where('id',$request->id)->first();
            $msg='Currency updated successfully.';
          }else{
            $currency=new Currency();
            $msg='Currency added successfully.';
          }
            $currency->currency_code=$request->currency_code;
            $currency->currency_symbol=$request->currency_symbol;
            $currency->currency_name=$request->currency_name;

          $currency->save();

        return redirect()->route('currency')->with('success',$msg );
    }


    public function Destroycurrency($id)
    {
        $initi = Currency::findOrFail($id);

        $initi->delete();

        return redirect()->back()->with('success', 'Currency deleted successfully.');
    }



    public function storeFiles(Request $request)
    {
        $request->validate([
            'sow_id' => 'required',
            'file_type' => 'required',
        ]);

        $sowId = $request->sow_id;
        $fileType = $request->file_type;

        if ($fileType === 'image' && $request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('upload'), $filename);

                AllFiles::create([
                    'sow_id' => $sowId,
                    'image_path' => 'upload/' . $filename,
                    'audio_path' => null,
                    'video' => null,
                ]);
            }
        }

        if ($fileType === 'audio' && $request->hasFile('audio_path')) {
            foreach ($request->file('audio_path') as $audio) {
                $filename = time() . '_' . $audio->getClientOriginalName();
                $audio->move(public_path('upload'), $filename);

                AllFiles::create([
                    'sow_id' => $sowId,
                    'image_path' => null,
                    'audio_path' => 'upload/' . $filename,
                    'video' => null,
                ]);
            }
        }

        if ($fileType === 'video') {
            foreach ($request->input('video', []) as $videoLink) {
                if (!empty($videoLink)) {
                    AllFiles::create([
                        'sow_id' => $sowId,
                        'image_path' => null,
                        'audio_path' => null,
                        'video' => $videoLink,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Files uploaded successfully.',
        ]);
    }


    // blog create 

    public function Blog()
    {
        $data['title'] = "Blog";
       
        $data['blogs'] = Blog::latest()->paginate(10); 

        return view('admin.blog.index', $data);
    }

     public function BlogCreate()
    {
        $data['title'] = "Create Blog";
        $data['blog'] = ''; 
        
    
        return view('admin.blog.create', $data);
    }

    

    public function BlogEdit(Request $request, $id){
        $blog = Blog::findOrFail($id);
        // $blog->category = json_decode($blog->category ?? '[]', true); // decode JSON string to array
        $blog->category = is_string($blog->category) ? json_decode($blog->category, true) : $blog->category;

        
        return view("admin.blog.create", compact("blog"));

    }


public function BlogStore(Request $request)
{
    $isUpdate = $request->has('id') && !empty($request->id);

    $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
        'featured_image' => 'nullable|image|max:2048',
        'category' => 'nullable|array',
        'is_active'=>'required',
        'seo_title' =>' nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
    ];

    $request->validate($rules);

    // Create new or find existing blog
    $blog = $isUpdate ? Blog::findOrFail($request->id) : new Blog();

    // Assign fields manually
    $blog->title = $request->title;
     $blog->is_active = $request->is_active;
    $blog->content = $request->content;
    $blog->seo_title = $request->seo_title;
    $blog->meta_description = $request->meta_description;
    // $blog->category = $request->has('category') ? json_encode($request->category) : null;
    $blog->category =$request->category ?? [];
    
     $blog->created_by = Auth::user()->id;

    // Handle image upload
    if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $destination = base_path('../public_html/uploads/blogs');
        $image->move($destination, $filename);
        $blog->featured_image = 'uploads/blogs/' . $filename;
    } elseif ($isUpdate) {
        // Retain old image if no new one
        $blog->featured_image = $blog->featured_image;
    }

    // Save blog
    $blog->save();

    return redirect()->route('post.blog')->with('success', $isUpdate ? 'Blog updated successfully.' : 'Blog created successfully.');
}




public function BlogDestroy($id)
{
    $blog = Blog::findOrFail($id);

    // Delete the image file if it exists
    if ($blog->featured_image) {
        $imagePath = base_path('../public_html/' . $blog->featured_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $blog->delete();

    return redirect()->back()->with('success', 'Blog deleted successfully.');
}


public function CaseStudy(){
    $data['caseStudies']=CaseStudy::latest()->paginate(10);
    
    return view('admin.caseStudy.index',$data);
}

public function CreateCase(){
    $data['CaseStudy']=CaseStudy::where('id',0)->first();
    return view('admin.caseStudy.create',$data);
}

   public function CaseEdit(Request $request, $id){
        $CaseStudy = CaseStudy::findOrFail($id);
        

        
        return view("admin.caseStudy.create", compact("CaseStudy"));

    }

public function CaseStudyStore(Request $request)
{
    $isUpdate = $request->has('id') && !empty($request->id);

    $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required',
        'featured_image' => 'nullable|image|max:2048',
        'project_type' => 'required',
    ];
    // dd($request->all());

    $request->validate($rules);

    $data = $request->only([
        'title',
        'slug',
        'is_featured',
        'project_type',
       
    ]);


    // Handle new image
    if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $destination = base_path('../public_html/uploads/blogs');
        $image->move($destination, $filename);
        $data['featured_image'] = 'uploads/blogs/' . $filename;
    }

    // Update
    if ($isUpdate) {
        $blog = CaseStudy::findOrFail($request->id);

        // If no new image uploaded, keep the old one
        if (!$request->hasFile('featured_image')) {
            $data['featured_image'] = $blog->featured_image;
        }

        $blog->update($data);

        return redirect()->route('case.study')->with('success', 'Blog updated successfully.');
    }

    // Create
    CaseStudy::create($data);

    return redirect()->route('case.study')->with('success', 'Blog created successfully.');
}


public function CaseDestroy($id)
{
    $blog = CaseStudy::findOrFail($id);

    // Delete the image file if it exists
    if ($blog->featured_image) {
        $imagePath = base_path('../public_html/' . $blog->featured_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $blog->delete();

    return redirect()->back()->with('success', 'Case deleted successfully.');
}


   public function toggleClock(Request $request)
{
    $userId   = Auth::user()->id;
    $isActive = $request->is_active;
    $today    = Carbon::today();
// dd($request->all());
    if ($isActive == 1) {
        // Check if already clocked in today
        $existing = TimeSheet::where('user_id', $userId)
            ->whereDate('start_time', $today)
            ->first();

        if ($existing) {
             $existing->end_time   = Carbon::now();
            $existing->is_active  = 1;
            $existing->updated_by = $userId;
            $existing->save();
        }else{
             // Clock In
        $clock = new TimeSheet();
        $clock->user_id    = $userId;
        $clock->start_time = Carbon::now();
        $clock->is_active  = 1;
        $clock->created_by = $userId;
        $clock->save();
        }

        return response()->json(['message' => 'Clocked In Successfully']);
    } 
    else {
        // Clock Out: find today's active record
        $clock = TimeSheet::where('user_id', $userId)
            ->whereDate('start_time', $today)
            ->where('is_active', 1)
            ->latest()
            ->first();

        if ($clock) {
            $clock->end_time   = Carbon::now();
            $clock->is_active  = 0;
            $clock->updated_by = $userId;
            $clock->save();

            return response()->json(['message' => 'Clocked Out Successfully']);
        }

        return response()->json(['message' => 'No active clock-in found for today'], 404);
    }
}


// here hire talent 
public function HireTalent(){
    $data['hiretalent']=HireTalent::latest()->paginate(10);
    
    return view('admin.hiretalent.index',$data);
}

public function CreateHireTalent(){
    $data['hiretalent']=HireTalent::where('id',0)->first();
    return view('admin.hiretalent.create',$data);
}

   public function HireTalentEdit(Request $request, $id){
        $hiretalent = HireTalent::findOrFail($id);
        

        return view("admin.hiretalent.create", compact("hiretalent"));

    }

public function HireTalentStore(Request $request)
{
    $isUpdate = $request->has('id') && !empty($request->id);

    $rules = [
        'name' => 'required|string|max:255',
      
        'image' => 'image|max:2048',
        'icon' => 'image|max:2048',
        'is_active' => 'required',
        'is_available'=>'required',
    ];
    // dd($request->all());

    $request->validate($rules);

    $data = $request->only([
        'name',
        'is_active',
        'content',
        'is_available',
    ]);


    // Handle new image
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $destination = base_path('../public_html/front/assets/images/instant');
        $image->move($destination, $filename);
        $data['image'] = 'front/assets/images/instant/' . $filename;
    }
    
    if ($request->hasFile('icon')) {
        $image = $request->file('icon');
        $filename = time() . '_' . $image->getClientOriginalName();
        $destination = base_path('../public_html/front/assets/images/instant/icons');
        $image->move($destination, $filename);
        $data['icon'] = 'front/assets/images/instant/icons/' . $filename;
    }

    // Update
    if ($isUpdate) {
        $blog = HireTalent::findOrFail($request->id);

        // If no new image uploaded, keep the old one
        if (!$request->hasFile('image')) {
            $data['image'] = $blog->image;
        }
        
        if (!$request->hasFile('icon')) {
            $data['icon'] = $blog->icon;
        }

        $blog->update($data);

        return redirect()->route('admin.hire.talent')->with('success', 'Hire Talent updated successfully.');
    }

    // Create
    HireTalent::create($data);

    return redirect()->route('admin.hire.talent')->with('success', 'Hire talent created successfully.');
}


    public function HireTalentDestroy($id)
    {
        $talent = HireTalent::findOrFail($id);
    
        // Delete icon if exists
        if ($talent->icon) {
            $iconPath = base_path('../public_html/' . $talent->icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            }
        }
    
        // Delete image if exists
        if ($talent->image) {
            $imagePath = base_path('../public_html/' . $talent->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        $talent->delete();
    
        return redirect()->back()->with('success', 'Talent deleted successfully.');
    }
    

}
