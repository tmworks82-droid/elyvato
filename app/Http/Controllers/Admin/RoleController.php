<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Admin;
use App\Models\Dipartment;
use App\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

use function Ramsey\Uuid\v1;

class RoleController 
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
        if(!auth()->user()->hasPermission('manage_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all user using Eloquent ORM
        $results                      = Role::where('status', 1)->orderBy('id', 'DESC')->paginate(10); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;

        return view('admin.role.index', compact('results', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required'
        ]);
        
        $all['name']                    = ucfirst($all['name']);
        $all['name_slug']               = Str::slug($all['name']);
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        Role::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('role.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = Role::findOrFail($id);
        return view('admin.role.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = Role::findOrFail($id);
        return view('admin.role.edit', compact('results'));
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['name_slug']               = Str::slug($all['name']);
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = Role::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if(!auth()->user()->hasPermission('delete_users'))
        {
            abort(404, 'You are not Authorised...');
        }

        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = Role::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_active = ($results->is_active === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('role.index')->with('success', 'Live status updated successfully.');
    }
    
    // here store department 

    public function Department(Request $request,){
        if(!auth()->user()->hasPermission('manage_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
       
        // Retrieve all user using Eloquent ORM
        $results                      = Dipartment::orderBy('id', 'DESC')->paginate(10); 
        $currentPage                  = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;
        //  dd($results);

        return view('admin.department.index', compact('results', 'previousPage', 'nextPage'));
    }

    public function create_department()
    {
        $data['results']='';
        return view('admin.department.create',$data);
    }

    public function storeDepartment(Request $request)
    {
        
        // $all                            = $request->all();
        // dd($all);
        // Validate the request data
        $request->validate([
            'name' => 'required'
        ]);
        
        $all['name']                    = ucfirst($request->name);
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');
     
        if(!empty($request->id)){
            $msg='Updated successfully.';
            Dipartment::where('id',$request->id)->update($all);
        }else{
            $msg='Department created successfully.';
            Dipartment::create($all);
        }
        // Create a new post
       

        // Redirect to the index page with a success message
        return redirect()->route('department')->with('success', $msg);
    }

    public function edit_department($id)
    {
        $data['results'] = Dipartment::findOrFail($id);
        return view('admin.department.create',$data);
    }

    public function destroy_department($id)
    {
        $dipartment = Dipartment::findOrFail($id);
        $dipartment->delete();

        return redirect()->route('department')->with('success', 'Record deleted successfully!');
    }


}
