<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\DispatchUpdate;
use App\Models\Country;
use App\Models\Role;
use App\Models\Booking;
use App\Models\TimeSheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Hash;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'order';
        $this->route                    = 'order';
        $this->seven_day                = 7;
        $this->fifteen_day              = 15;
        $this->thirty_day               = 30;
        
    }

  

    public function showDashboard(Request $request)
    {
        // dd($request);
        
        // if(!auth()->user()->hasPermission('manage_dashboard'))
        // {
        //     abort(404, 'You are not Authorised...');
        // }
        if (!auth('admin')->check() || !auth('admin')->user()->hasPermission('manage_dashboard')) {
            abort(403, 'Unauthorized');
        }
        
        $imported_lead = 0;

        $adminCount= Admin::where('status', 1)->count();
        
        $booking=Booking::where(['assign_to'=>Auth::user()->id,'is_visited'=>'no'])->count();
        // dd(getRoleNamebyId(Auth::user()->role_id)->name_slug);
        if(getRoleNamebyId(Auth::user()->role_id)->name_slug==='super-admin' || getRoleNamebyId(Auth::user()->role_id)->name_slug==='admin'){
            $booking=Booking::where('is_visited','no')->count();
        }
        
        
        return view('admin.dashboard', compact(
            'adminCount', 
            'imported_lead', 
            'booking',
          
        ));
    }

    public function UsersPage(Request $request){
    //    dd('run');
    $data['role']=Role::get();
        return view('admin.user.index',$data);
    }

    public function Services(Request $request){
        
            return view('admin.user.index');
        }

        
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|exists:roles,id',
                'phone' => 'nullable|string|max:20',
                'company_name' => 'nullable|string|max:255',
                'is_active' => 'required|boolean',
            ]);
        
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'phone' => $request->phone,
                'company_name' => $request->company_name,
                'is_active' => $request->is_active,
            ]);
        
            return redirect()->back()->with('success', 'User created successfully!');
        }
        
        
//     public function toggleClock(Request $request)
//     {
//         $userId = Auth::id(); // Current user
//         $isActive = $request->is_active;

// dd($request->all());
//         if ($isActive == 1) {
//             // Clock In
//             $clock = new TimeSheet();
//             $clock->user_id = $userId;
//             $clock->start_time = Carbon::now();
//             $clock->is_active = 1;
//             $clock->created_by = $userId;
//             $clock->save();

//             return response()->json(['message' => 'Clocked In Successfully']);
//         } else {
//             // Clock Out - find the last active record
//             $clock = TimeSheet::where('user_id', $userId)
//                           ->where('is_active', 1)
//                           ->latest()
//                           ->first();

//             if ($clock) {
//                 $clock->end_time = Carbon::now();
//                 $clock->is_active = 0;
//                 $clock->updated_by = $userId;
//                 $clock->save();
//             }

//             return response()->json(['message' => 'Clocked Out Successfully']);
//         }
//     }

  

}
