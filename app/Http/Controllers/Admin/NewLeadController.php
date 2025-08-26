<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\Service;
use App\Models\LeadPriority;
use App\Models\Campaign;
use App\Models\State;
use App\Models\City;
use App\Models\Admin;
use App\Models\Tag;
use App\Models\LeadHistory;
use App\Models\LeadStatus;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class NewLeadController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';        
        $this->permission               = 'new_lead';
        $this->route                    = 'new_lead';
        
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $status_id = $request->input('status_id');
        $product_id = $request->input('product_id');
        $priority_id = $request->input('priority_id');


        $date_range = $request->input('date_range');

        $leadStatus                   = LeadStatus::where('is_live', 1)->get();

        $product                      = Service::where('is_live', 1)->get();

        $leadPriority                 = LeadPriority::where('is_live', 1)->get();

        $results                      = LeadHistory::with('lead','leadStatus', 'lead.campaign', 'lead.leadPriority', 'lead.service');

        if(!empty($request->date_range)) {
            // Split the date range by ' - '
            list($from, $to) = explode(' - ', $request->input('date_range'));
        
            // Convert the dates into 'YYYY-MM-DD' format
            $from_date = \DateTime::createFromFormat('m/d/Y', $from)->format('Y-m-d');
            $to_date = \DateTime::createFromFormat('m/d/Y', $to)->format('Y-m-d');

            $results->whereBetween('created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
        }

        // Filter by searchQuery from leads table (related via the 'lead' relationship)
        if ($searchQuery) {
            $results->whereHas('lead', function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('mobile', 'like', '%' . $searchQuery . '%');
            });
        }


        // Filter by product_id from leads table (related via the 'lead' relationship)
        if (!empty($product_id)) {
            $results->whereHas('lead', function ($query) use ($product_id) {
                $query->where('service_id', $product_id);
            });
        }

        // Filter by lead_priority from leads table (related via the 'lead' relationship)
        if (!empty($priority_id)) {
            $results->whereHas('lead', function ($query) use ($priority_id) {
                $query->where('lead_priority_id', $priority_id);
            });
        }

        // Filter by status_id
        if (!empty($status_id)) {
            $results->where('lead_status_id', $status_id);
        }

        if(Auth::guard('admin')->user()->id != '1')
        {
            $results->where('assign_to', Auth::guard('admin')->user()->id);
            $results->whereNotIn('lead_status_id', [7]);
                    // ->where('lead_type', 0);
            $results->whereNull('updated_at');
        }

        $results->where('is_new', 1);

        $results = $results->orderBy('id', 'DESC')->paginate(50);

        

        // Retrieve all state using Eloquent ORM
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;

        return view('admin.'.$this->route.'.index', compact('results', 'previousPage', 'nextPage', 'searchQuery', 'status_id', 'leadStatus', 'leadPriority', 'product', 'product_id', 'date_range', 'priority_id'));
    
    }


    public function show($id)
    {

        if(!auth()->user()->hasPermission('show_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        // Find the post by its ID and pass it to the view
        $results = LeadHistory::where('lead_id', $id)->orderBy('id', 'DESC')->get();
        $lead = Lead::with('campaign', 'service', 'state', 'city')->where('id', $id)->first();

        return view('admin.'.$this->route.'.show', compact('results', 'lead'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $service                      = Service::where('is_live', 1)->get();
        $leadPriority                 = LeadPriority::where('is_live', 1)->get();
        $campaign                     = Campaign::where('is_live', 1)->get();
        $state                        = State::where('is_live', 1)->get();
        $tags                         = Tag::where('is_live', 1)->get();
        // Find the post by its ID and pass it to the view for editing
        $results                        = Lead::findOrFail($id);
        
        $city                         = City::where('is_live', 1)->get();

        $users                        = Admin::where('is_active', 1)->where('role_id', 7)->get();
        
        return view('admin.'.$this->route.'.edit', compact('results', 'service', 'leadPriority', 'campaign', 'state', 'city', 'users', 'tags'));
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
            'mobile' => 'required|numeric|regex:/^[6-9]\d{9}$/',
            'campaign_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'service_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'lead_priority_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'state_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'city_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'assign_to' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
        ], [
            'campaign_id.required' => 'Please select the campaign.',
            'service_id.required' => 'Please select the service.',
            'lead_priority_id.required' => 'Please select the lead priority.',
            'state_id.required' => 'Please select the state.',
            'city_id.required' => 'Please select the city.',
            'assign_to.required' => 'Please select the user.',
            
        ]);

        $all['name']                    = ucwords(strtolower($all['name']));
        $all['updated_by']              = Auth::guard('admin')->user()->id;
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = Lead::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', $this->permission.' updated successfully.');
    }

    public function editFollowup(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }


        
        $results                      = Lead::with('campaign', 'service', 'leadPriority', 'leadHistory.leadStatus')->findOrFail($id);

        $leadPriority                 = LeadPriority::where('is_live', 1)->get();
        $leadStatus                   = LeadStatus::where('is_live', 1)->get();
        // echo "<pre>";
        // print_r($results->toArray());
        // echo "</pre>";
        // die();

        return view('admin.'.$this->route.'.editfollowup', compact('results', 'leadPriority', 'leadStatus'));
    }

    public function updateFollowup(Request $request)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }



        $all                            = $request->all();


        // Validate the request data
        $request->validate([
            'comments' => 'required',
            'lead_priority_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'lead_status_id' => 'bail|required|numeric|regex:/^\d{1,15}?$/',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            
            
        ], [
            'lead_priority_id.required' => 'Please select the lead priority.',
            'lead_status_id.required' => 'Please select the lead status.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date format.',
            'date.after_or_equal' => 'The date must be today or a future date.',
            'time.required' => 'The time field is required.',            
        ]);
        
        
        $this->updateNewToOldLeadHistory($all['lead_id']);

        $all['assign_to']               = Auth::guard('admin')->user()->id;
        $all['created_by']              = Auth::guard('admin')->user()->id;

        $all['followup_date_time']      = $all['date'].' '.$all['time'];
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // LeadHistory
        LeadHistory::create($all);
        
        Lead::where('id',$all['lead_id'])
                    ->update(['lead_status_id' => $all['lead_status_id']]);

        
        $results                        = Lead::findOrFail($all['lead_id']);
        $results->lead_priority_id      = $all['lead_priority_id'];
        $results->save();

        // Redirect to the index page with a success message
        // return redirect()->route($this->route.'.show',[$all['lead_id']])->with('success', $this->permission.' created successfully.');

        return redirect()->route($this->route . '.show', [$all['lead_id']])->with('success', $this->permission . ' created successfully.');

        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        // die();

        // return view('admin.'.$this->route.'.editfollowup', compact('results', 'leadPriority', 'leadStatus'));
    }






    public function updateNewToOldLeadHistory($lead_id)
    {
        // $results                        = LeadHistory::where('lead_id',$lead_id);
        // $results->lead_priority_id      = $all['lead_priority_id'];
        // $results->save();


        LeadHistory::where('lead_id',$lead_id)
                    ->update(['is_new' => 0]);
    }
    

    
    
    
}
