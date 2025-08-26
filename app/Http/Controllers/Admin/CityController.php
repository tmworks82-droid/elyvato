<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class CityController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';        
        $this->permission               = 'city';
        $this->route                    = 'city';
        
        
    }
    
    
    public function index(Request $request)
    {     
        // dd('manage_'.$this->permission);
        if(!auth()->user()->hasPermission('manage_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
       
        // Retrieve all user using Eloquent ORM
        $results                      = City::where('status', 1)->orderBy('id', 'DESC')->paginate(100); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;
      
        return view('admin.'.$this->route.'.index', compact('results', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        $state                     = State::where('is_live', 1)->get();
        return view('admin.'.$this->route.'.create', compact('state'));
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
            'state_id' => 'required',
            'name' => 'required',
            'code' => "bail|required|min:1|max:5",
        ]);

        $all['name']                    = ucwords(strtolower($all['name']));
        $all['code']                    = strtoupper(strtolower($all['code']));
        $all['created_by']              = Auth::guard('admin')->user()->id;
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        City::create($all);

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
        $results                        = City::findOrFail($id);
        $state                          = State::where('is_live', 1)->get();
        return view('admin.'.$this->route.'.edit', compact('results', 'state'));
        
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
            'state_id' => 'required',
            'name' => 'required',
            'code' => "bail|required|min:1|max:5",
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['code']                    = strtoupper(strtolower($all['code']));
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = City::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' updated successfully.');
    }

    public function destroy(City $city)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        $city->delete();
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = City::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    


    public function getCityByStateId(Request $request)
    {
        $id = $request->input('state_id');
        $cities = City::where('state_id', $id)->get();
    
        return response()->json($cities);
    }
    
    
    public function Country(Request $request){
       
        $countries = Country::latest()->get();
        return view('admin.country.index', compact('countries'));
    }
    
    public function CreateCountry(Request $request, $id = '')
    {
        $data['page_name'] = "Create Country";
        if ($id) {
            $data['page_name'] = "Edit Country";
            $data['country'] = Country::findOrFail($id);
        } else {
            $data['country'] = null;
        }
        return view('admin.country.create', $data);
    }



    public function storeCountry(Request $request)
    {
        $request->validate([
            'country_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image' => 'nullable|image',
            'currency' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'country_code' => 'required|string|max:10',
        ]);
        
        $country = new Country();

        if($request->id){
            $country = Country::where('id',$request->id)->first();
        }
        
        $country->country_name = $request->country_name;
        $country->currency = $request->currency;
        $country->title = $request->title;
        $country->country_code = $request->country_code;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($image->getClientOriginalName(), '_');
            $image->move(public_path('upload'), $filename);
            $country->image = $filename;
        }

        $country->save();
        return redirect()->route('country')->with('success', 'Country saved successfully!');
    }


    public function destroyCountry($id)
    {
        $country = Country::findOrFail($id);
        
        if ($country->image && file_exists(public_path('upload/' . $country->image))) {
            unlink(public_path('upload/' . $country->image));
        }

        $country->delete();

        return redirect()->route('country')->with('success', 'Country deleted successfully.');
    }

}
