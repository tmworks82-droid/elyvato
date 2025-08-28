<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\SubService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class ServiceController
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'service';
        $this->route                    = 'service';

    }


    public function index(Request $request)
    {

        // Retrieve all user using Eloquent ORM
        $results                      = Service::where('status', 1)->orderBy('id', 'DESC')->paginate(100);
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;

        return view('admin.'.$this->route.'.index', compact('results', 'previousPage', 'nextPage'));

    }


    public function create()
    {
        return view('admin.'.$this->route.'.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $all  = $request->all();
        // dd($all);
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'seo_title' =>' nullable|string|max:255',
        'meta_description' => 'nullable|string',
            // 'image' => 'required|image|mimes:jpg,jpeg,png|dimensions:width=400,height=400|max:2048',
        ]);

        // dd($request->all());

        $created_by=Auth::guard('admin')->user()->id;


        $imagePath = '';

        if ($request->hasFile('image')) {
            // Upload the regular image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Destination folder (public_html path on Hostinger)
            $destination = base_path('../public_html/uploads');
            
            // Move the image directly to the folder
            $image->move($destination, $imageName);

            // Save the relative path to the variable
            $imagePath = 'uploads/' . $imageName;  // Store the relative path for database
        }


// $imagePath now holds the relative path of the newly uploaded image


        

        // dd($request->all(),$imagePath);

        $data['name']                     = ucwords(strtolower($all['name']));
        $data['service_icon']            = $imagePath;
        $data['is_active']                = $all['is_active'];
        $data['description']              = $all['description'];
        $data['meta_description']              = $all['meta_description'];
        $data['seo_title']              = $all['seo_title'];
        $data['status']                   = 1;
        $data['icon']                   = $request->icon;
        $data['created_by']               = $created_by;
        $data['created_at']               = date('Y-m-d H:i:s');
        $data['updated_at']               = date('Y-m-d H:i:s');

        // dd($data);
        // Create a new post
        $save=Service::create($data);
        if($save){
                return redirect()->route($this->route.'.index')->with('success', $this->permission.' created successfully.');
        }

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' Faild ,to create service.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        // Find the post by its ID and pass it to the view
        $results  = Service::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results = Service::findOrFail($id);

        return view('admin.'.$this->route.'.edit', compact('results'));
    }


    public function update(Request $request, $id)
    {

        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        $all  = $request->all();

        // Validate the request data

        $request->validate([
            'name' => 'required',
            'icon'=>'required',
            'seo_title' =>' nullable|string|max:255',
        'meta_description' => 'nullable|string',
        ]);

        // dd($all);

        // $imagePath='';
        $imagePath = '';

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            
            $destination = base_path('../public_html/uploads');
            
           
            $image->move($destination, $imageName);

           
            $imagePath = 'uploads/' . $imageName;  // Store the relative path for database
            $all1['service_icon']                    = $imagePath;
        }

        $all1['name']                    = ucfirst($all['name']);
        $all1['se0_title']                    = ucfirst($all['se0_title']);
        $all1['meta_description']                    = ucfirst($all['meta_description']);
        $all1['description']                    = ucfirst($all['description']);
        $all1['icon']                    = $all['icon'];
        
        $all1['updated_at']              = date('Y-m-d H:i:s');
        $all1['is_active']               = $all['is_active'];

        // dd($all1);

        $results  = Service::findOrFail($id);
        $results->update($all1);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' updated successfully.');
    }

    public function destroy(Service $service)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        $service->delete();
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = Service::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }

    public function subServices(Request $request){

            // Retrieve all user using Eloquent ORM
            $results = SubService::with('service')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(100);

            $currentPage  = request()->query('page', 1);
            $previousPage = ($currentPage > 1) ? $currentPage - 1 : null;
            $nextPage= ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;

        return view('admin.subServices.index',compact('results', 'previousPage', 'nextPage'));
    }

    public function CreatesubServices(Request $request,$id=''){
         // If ID exists, fetch the subservice for editing
    if (!empty($id)) {
        $data['subservice'] = SubService::findOrFail($id);
    } else {
        $data['subservice'] = null;
    }

    $data['service'] = Service::all();
        return view('admin.subServices.create',$data);
    }


    public function storeSubServices(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            // 'status' => 'nullable|boolean',
            'seo_title' =>' nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $status = $request->has('status') ? 1 : 0;
        $userId = Auth::guard('admin')->user()->id;

        if (!empty($request->id)) {
            // Update

            $data = SubService::findOrFail($request->id);

             $imagePath = '';

            if ($request->hasFile('image')) {
                // Upload the regular image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                
                // Destination folder (public_html path on Hostinger)
                $destination = base_path('../public_html/uploads');
                
                // Move the image directly to the folder
                $image->move($destination, $imageName);

                // Save the relative path to the variable
                $imagePath = 'uploads/' . $imageName;  // Store the relative path for database
                $data->subservice_icon= $imagePath;
            }


            $data->service_id= $request->service_id;
            $data->name= $request->name;
            $data->description= $request->description;
            $data->seo_title= $request->seo_title;
            $data->meta_description= $request->meta_description;
           
            $data->is_active= $request->is_active;
            $data->updated_by= $userId;
           $data->save();

            return redirect('/subServices')->with('success', 'Subservice updated successfully!');
        } else {
            $data=new SubService();

            $imagePath = '';

            if ($request->hasFile('image')) {
                // Upload the regular image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                
                // Destination folder (public_html path on Hostinger)
                $destination = base_path('../public_html/uploads');
                
                // Move the image directly to the folder
                $image->move($destination, $imageName);

                // Save the relative path to the variable
                $imagePath = 'uploads/' . $imageName;  // Store the relative path for database
                $data->subservice_icon= $imagePath;
            }

            // Create

           $data->service_id= $request->service_id;
           $data->name= $request->name;
           $data->description=$request->description;
           $data->seo_title= $request->seo_title;
            $data->meta_description= $request->meta_description;
        //    $data->subservice_icon = $request->subservice_icon;
            $data->is_active=$request->is_active;
            $data->created_by= $userId;
            $data->updated_by = $userId;

            $data->save();

            return redirect('/subServices')->with('success', 'Subservice created successfully!');
        }
    }


    public function destroySubservice($id)
    {
        $subservice = SubService::findOrFail($id);
        $subservice->delete();
        return redirect()->back()->with('success', 'Subservice deleted successfully!');
    }

}
