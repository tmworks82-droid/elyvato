<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Admin;
use App\Models\Role;
use App\Models\UserProfile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;

class AdminUserController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all user using Eloquent ORM
        $results                      = Admin::with('profile')->where('status', 1)->orderBy('id', 'DESC')->paginate(10); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.admin_user.index', compact('results', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        $roles = Role::all();
        // $departments = Dipartment::all();
        return view('admin.admin_user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all    = $request->all();
        // dd($all);
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'role_id' => 'required',
             'bio' => ['nullable', function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 30) {
                        $fail('The bio must not exceed 30 words.');
                    }
                }],
            'priority' => [
                function ($attribute, $value, $fail) use ($request) {
                    if (getRoleNamebyId($request->role_id)->name_slug == 'account_manager' && empty($value)) {
                        $fail('Priority is required when role account manager.');
                    }
                }
            ],
        ]);
        $uname                          = explode("@",$all['email']);
        $all1['name']                    = ucfirst($all['name']);
        $all1['email']                   = strtolower($all['email']);
        $all1['mobile']                   = $request->mobile;
        $all1['priority']                   = $request->priority;
        $all1['role_id']                   = $all['role_id'];
        $all1['username']                = $uname[0];
        $all1['password']                = Hash::make($all['password']);
        $all1['created_at']              = date('Y-m-d H:i:s');
        $all1['updated_at']              = date('Y-m-d H:i:s');


        // Create a new post
        $admin=Admin::create($all1);

        // here create user profile 

        $profile=new UserProfile();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . $image->getClientOriginalName();

            $destinationPath = base_path('../public_html/uploads/blogs');

            $image->move($destinationPath, $filename);

            $profile->image= 'uploads/blogs/' . $filename;
        }

        $profile->user_id = $admin->id;
        $profile->company_name = $request->company_name;
        $profile->gst_number = $request->gst_number ?? null;
        $profile->address_line1 = $request->address_line1 ?? null;
        $profile->address_line2 = $request->address_line2 ?? null;
        $profile->city = $request->city ?? null;
        $profile->state = $request->state ?? null;
        $profile->bio = $request->bio ?? null;
        $profile->country = $admin->country ?? null;
        $profile->pincode = $request->pincode ?? null;
        $profile->industry_type = $request->industry_type ?? null;
        $profile->is_active = $request->is_active;
        $profile->updated_by = Auth::id();
        $profile->updated_at = now();
        
        $profile->save();

        // Redirect to the index page with a success message
        return redirect()->route('admin_user.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = Admin::with('profile')->where('user_id',$id)->first();
        return view('admin.admin_user.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = Admin::findOrFail($id);
        $roles                          = Role::all();
        // $departments = Dipartment::all();
        // dd($results,$departments);
        return view('admin.admin_user.edit', compact('results', 'roles'));
    }
    


    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('edit_users')) {
            abort(404, 'You are not Authorised...');
        }

        $all = $request->all();

        // Find the user by ID
        $results = Admin::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'username' => 'required',
            'email' => [
                'required',
                Rule::unique('admins')->ignore($results->id), // Ignore the current user's email
            ],

             'bio' => ['nullable', function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 30) {
                        $fail('The bio must not exceed 30 words.');
                    }
                }],
                
            'priority' => [
                function ($attribute, $value, $fail) use ($request) {
                    if (getRoleNamebyId($request->role_id)->name_slug == 'account_manager' && empty($value)) {
                        $fail('Priority is required when role account manager.');
                    }
                }
            ],
            
        ]);

        if (isset($all['password'])) {
            $all['password'] = Hash::make($all['password']);
        } else {
            unset($all['password']);
        }

        $all['name'] = ucfirst($all['name']);
        $all1['priority']= $request->priority;
        $all['mobile'] =$request->mobile;
        $all1['role_id']= $all['role_id'];

        // $all['department_id']= $all['department_id'];
        $all['updated_at'] = date('Y-m-d H:i:s');
        // dd($all);
        // Update the user record
        $results->update($all);

        $profile=UserProfile::where('user_id',$results->id)->first();
        // dd($profile,$request->image);

        if(empty($profile)){
            $profile=new UserProfile();
             $profile->user_id = $results->id;

        }
        
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . $image->getClientOriginalName();

            $destinationPath = base_path('../public_html/uploads/blogs');

            $image->move($destinationPath, $filename);

            $profile->image= 'uploads/blogs/' . $filename;
        }

        $profile->company_name = $request->company_name;
        $profile->bio = $request->bio ?? null;
        $profile->gst_number = $request->gst_number ?? null;
        $profile->address_line1 = $request->address_line1 ?? null;
        $profile->address_line2 = $request->address_line2 ?? null;
        $profile->city = $request->city ?? null;    
        $profile->state = $request->state ?? null;
        $profile->country = $profile->country ?? null;
        $profile->pincode = $request->pincode ?? null;
        $profile->industry_type = $request->industry_type ?? null;
        $profile->is_active = $request->is_active;
        $profile->updated_by = Auth::id();
        $profile->updated_at = now();
        
        $profile->save();

        // Redirect to the index page with a success message
        return redirect()->route('admin_user.index')->with('success', 'User updated successfully.');
    }


    public function destroy(Admin $user)
    {
        if(!auth()->user()->hasPermission('delete_users'))
        {
            abort(404, 'You are not Authorised...');
        }

        $user->delete();
        return redirect()->route('admin_user.index')->with('success', 'User deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = Admin::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_active = ($results->is_active === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('admin_user.index')->with('success', 'Live status updated successfully.');
    }
    

    public function UpdateUserProfile(){
        $data['profiles']=UserProfile::where('user_id',Auth::user()->id)->first();
        $data['city']=City::get();
        $data['state']=State::get();
        $data['country']=Country::get();
        return view('admin.admin_user.profile',$data);
    }


    
public function EditProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'mobile' => 'nullable|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'password' => 'nullable|min:6',
        // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'company_name' => 'nullable|string',
        // 'gst_number' => 'nullable|string',
        // 'address_line1' => 'nullable|string',
        // 'address_line2' => 'nullable|string',
        // 'city' => 'nullable|string',
        // 'state' => 'nullable|string',
        // 'country' => 'nullable|string',
        // 'pincode' => 'nullable|string',
        // 'industry_type' => 'nullable|string',
    ]);

    $user = Admin::where('id',Auth::user()->id)->first();

    // dd($user,$request->all());
    // Update user table
    $user->name = $request->name;
    $user->email = $request->email;
    $user->Mobile = $request->mobile;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }


    $user->save();

    // Update or create profile table
    
     $profile=UserProfile::where('user_id',Auth::user()->id)->first();
        // dd($profile,$request->all());


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Create a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();

            // Destination path: moves to ../public_html/uploads/blogs
            $destinationPath = base_path('../public_html/uploads/blogs');

            // Move file
            $image->move($destinationPath, $filename);

            // Save relative path in DB
            $profile->image= 'uploads/blogs/' . $filename;
        }

        $profile->company_name = $request->company_name;
        $profile->gst_number = $request->gst_number ?? null;
        $profile->address_line1 = $request->address_line1 ?? null;
        $profile->address_line2 = $request->address_line2 ?? null;
        $profile->city = $request->city ?? null;
        $profile->state = $request->state ?? null;
        $profile->country = $profile->country ?? null;
        $profile->pincode = $request->pincode ?? null;
        $profile->industry_type = $request->industry_type ?? null;
        $profile->is_active = $request->is_active;
        $profile->updated_by = Auth::id();
        $profile->updated_at = now();
        
        $profile->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

    
}
