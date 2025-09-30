<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Booking;
use App\Models\Country;
use App\Models\State;
use App\Models\Role;
use App\Models\Admin;
use App\Models\UserAvailability;
use App\Models\BankDetails;
use App\Models\City;
use App\Models\RoleDesignation;
use App\Models\Payment;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\StatementOfWork;
use App\Models\RecurringSubscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;



class ProfileController extends Controller
{
    public function uploadCertification(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_cert_' . $file->getClientOriginalName();
            // $uploadPath = base_path('../public/upload/profile/new/');
             $uploadPath = public_path('upload/profile/new/'); // ✅ correct path
            $file->move($uploadPath, $filename);

            return response()->json(['filepath' => 'upload/profile/new/' . $filename]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function uploadPortfolio(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_portfolio_' . $file->getClientOriginalName();
            // $uploadPath = base_path('../public/upload/profile/new/');
             $uploadPath = public_path('upload/profile/new/'); // ✅ correct path
            $file->move($uploadPath, $filename);

            return response()->json(['filepath' => 'upload/profile/new/' . $filename]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function uploadRatecard(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_ratecard_' . $file->getClientOriginalName();
            // $uploadPath = base_path('../public/upload/profile/new/');
             $uploadPath = public_path('upload/profile/new/'); // ✅ correct path
            $file->move($uploadPath, $filename);

            return response()->json(['filepath' => 'upload/profile/new/' . $filename]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function uploadPassportFront(Request $request)
{
    return $this->handleGovFileUpload($request, '_passport_front_');
}

public function uploadPassportBack(Request $request)
{
    return $this->handleGovFileUpload($request, '_passport_back_');
}

public function uploadDrivingLicense(Request $request)
{
    return $this->handleGovFileUpload($request, '_dl_');
}

public function uploadAadhaarFront(Request $request)
{
    return $this->handleGovFileUpload($request, '_aadhaar_front_');
}

public function uploadAadhaarBack(Request $request)
{
    return $this->handleGovFileUpload($request, '_aadhaar_back_');
}

public function uploadPan(Request $request)
{
    return $this->handleGovFileUpload($request, '_pan_');
}


private function handleGovFileUpload(Request $request, $suffix)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . $suffix . $file->getClientOriginalName();
        $uploadPath = public_path('upload/profile/new/');
        $file->move($uploadPath, $filename);

        return response()->json(['filepath' => 'upload/profile/new/' . $filename]);
    }
    return response()->json(['error' => 'No file uploaded'], 400);
}


public function PaymentSetting()
{
    $data['bank_detail'] = BankDetails::where('user_id',Auth::user()->id)->first();
    return view('user.payment-setting', $data);
}

public function uploadCancelledCheck(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '_cancelled_check_' . $file->getClientOriginalName();
        $uploadPath = public_path('upload/profile/new/');
        $file->move($uploadPath, $filename);

        return response()->json([
            'status' => true,
            'filepath' => 'upload/profile/new/' . $filename
        ]);
    }

    return response()->json(['status' => false, 'message' => 'No file uploaded'], 400);
}





 public function UpdateBankDetails(Request $request)
    {

        $request->validate([
            'account_no' => 'required|string|max:50',
            'ifsc_code' => 'required|string|max:20',
            'bank_name' => 'required|string|max:100',
            'cancelled_check_image' => 'required',
        ]);

        $check=BankDetails::where('user_id',Auth::id())->first();
        $bankDetail = new BankDetails();
        if(!empty($check)){
          $bankDetail = BankDetails::find($check->id);
        }

        $bankDetail->user_id = Auth::id();
        $bankDetail->account_no = $request->account_no;
        $bankDetail->ifsc_code = $request->ifsc_code;
        $bankDetail->bank_name = $request->bank_name;

        $bankDetail->status = 'pending';
        
        if ($request->filled('cancelled_check_image')) {
            $bankDetail->cancelled_check_image = $request->cancelled_check_image;
        }

        if ($request->filled('gov_id_type')) {
            $bankDetail->gov_id_type = $request->gov_id_type;
        }
        if ($request->filled('passport_front')) {
            $bankDetail->passport_front = $request->passport_front;
        }
        if ($request->filled('passport_back')) {
            $bankDetail->passport_back = $request->passport_back;
        }
        if ($request->filled('driving_license')) {
            $bankDetail->driving_license = $request->driving_license;
        }
        if ($request->filled('aadhaar_front')) {
            $bankDetail->aadhaar_front = $request->aadhaar_front;
        }
        if ($request->filled('aadhaar_back')) {
            $bankDetail->aadhaar_back = $request->aadhaar_back;
        }
        if ($request->filled('pan')) {
            $bankDetail->pan = $request->pan;
        }

        $bankDetail->save();

        return response()->json([
            'success' => true,
            'message' => 'Bank details saved successfully!',
        ]);
        
    }


    public function SaveAvailability(Request $request)
    {
        $days = $request->input('schedule', []);

        // 1. Delete all old availability records for this user
        UserAvailability::where('user_id', Auth::id())->delete();

        // 2. Insert fresh ones
        foreach ($days as $day => $schedule) {
            UserAvailability::create([
                'user_id'    => Auth::id(),
                'day'        => $day,
                'start_time' => $schedule['start_time'] ?? null,
                'end_time'   => $schedule['end_time'] ?? null,
                'is_closed'  => isset($schedule['is_closed']) ? 1 : 0,
                'status'     => 'open',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Schedule saved successfully!',
        ]);
    }


}
