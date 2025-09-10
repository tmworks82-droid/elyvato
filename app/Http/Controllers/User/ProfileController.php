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
        // dd($request->all());

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


        $bankDetail->save();

        return response()->json([
            'success' => true,
            'message' => 'Bank details saved successfully!',
        ]);
    }

}
