<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\State;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class StateController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';        
        $this->permission               = 'state';
        $this->route                    = 'state';
        
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all user using Eloquent ORM
        $results                      = State::where('status', 1)->orderBy('id', 'DESC')->paginate(100); 
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
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'code' => "bail|required|min:1|max:5",
        ]);

        $all['name']                    = ucwords(strtolower($all['name']));
        $all['code']                    = strtoupper(strtolower($all['code']));
        $all['created_by']              = Auth::guard('admin')->user()->id;
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        State::create($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = State::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = State::findOrFail($id);
        return view('admin.'.$this->route.'.edit', compact('results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'code' => "bail|required|min:1|max:5",
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['code']                    = strtoupper(strtolower($all['code']));
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = State::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' updated successfully.');
    }

    public function destroy(State $state)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        $state->delete();
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = State::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
