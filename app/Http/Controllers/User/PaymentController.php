<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Booking;
use App\Models\Country;
use App\Models\State;
use App\Models\Role;
use App\Models\Admin;
use App\Models\City;
use App\Models\Payment;
use App\Models\Milestone;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\StatementOfWork;
use App\Models\RecurringSubscription;
use Auth;


class PaymentController extends Controller
{


    public function payMilestone(Request $request)
    {

        // dd($request->all());
        $request->validate([
            // 'sow_id' => 'required|integer',
            'price' => 'required|numeric',
            'booking_id' => 'required|numeric',
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        // Verify Razorpay Signature
        $generated_signature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')

        );

        if ($generated_signature !== $request->razorpay_signature) {
            $status="cancelled";

            Log::error(' Razorpay signature mismatch', [
                'expected' => $generated_signature,
                'received' => $request->razorpay_signature
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gateway verification failed!',
            ], 400);
        }else{
            $status="success";

        }

        // Optionally: Fetch Milestone info
        $milestone = Milestone::where('id', $request->mileston_id)
            ->where('amount', $request->price)
            ->where('is_active', 1)
            ->first();
            
           $proejct= Project::where('id',$milestone->project_id)->first();


        if(!$milestone) {
            return response()->json([
                'success' => false,
                'message' => 'Milestone not found or already paid.',
            ], 404);
        }

        // Save Payment Record
        Payment::create([
            'booking_id' => $proejct->booking_id ?? null,
            'amount' => $request->price,
            'payment_type' => 'milestone',
            'status' => $status,
            'payment_date' => now(),
            'transaction_id' => json_encode( [
            
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
            
            ]),

            'created_by' => Auth::id(),
        ]);



        //  Update milestone status
        $milestone->update(['is_active' => 1, 'updated_by'=>Auth::id(),'status' => 'completed']);

        // update in booking table
         $booking = Booking::findOrFail($request->booking_id);
        $booking->initial_paid_amount += $request->price;

        if ($booking->initial_paid_amount >= $booking->total_price) {
            $booking->status = 'paid';
            $booking->payment_status = 'success';  
        }else{
            $booking->status = 'in_progress';

        }

        $booking->save();


        // send a payment success mail
        $user = Admin::find(auth()->id());
        $to = $user->email;
        $paid=$request->price;

        sendEmail(
            $to,
            'ELYVATO |  Got It! Your Payment’s In and Working',
            'emails.payment_success',
            ['paid' => $paid]
        );

        $message = "💰 *Payment Done. Let’s Get Building.*\n\n💸 We’ve got your payment — and your project’s officially moving forward. Let the magic begin.";
        $mobile=$user->mobile;

        sendWhatsAppMessage($mobile, $message);

        return response()->json([
            'success' => true,
            'message' => '💰 Milestone payment received successfully. You’re all set!',
        ]);
    }


    public function requestInvoice(Request $request)
    {
        $msg='Something went wrong !';
        $bookingId = $request->booking_id;
        $booking=Booking::where('id',$bookingId)->first();
        $user=Admin::where('id',$booking->assign_to)->first();
        $invoice=Invoice::where(['user_id'=>$request->id, 'booking_id'=>$bookingId])->first();

       if(!empty($invoice)){

            $invoice->user_id=Auth::user()->id;
            $invoice->booking_id=$bookingId;
            $invoice->status='pending';

       }else{

            $invoice=new Invoice();
            $invoice->user_id=Auth::user()->id;
            $invoice->booking_id=$bookingId;
            $invoice->status='pending';

       }

        if($invoice->save()){
            $msg='📄 Invoice request received. We’ll process it shortly and keep you posted.';

            // dd($user);
            sendEmail(
                $user->email,
                "New Invoice Request Received",
                'emails.invoice_request',
                ['user' => $user->name,'user_name'=>Auth::user()->username] 
            );
        }

        return response()->json([
            'status' => true,
            'message' => $msg,
        ]);

    }
    
 
    
    

}
