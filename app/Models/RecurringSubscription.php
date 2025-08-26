<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\StatementOfWork;

class RecurringSubscription extends Model
{
    use HasFactory;

     protected $fillable = [
        'sow_id',
        'booking_id',
        'subscription',
        'subscription_dates',
        'user_id',
        'status',
    ];

    // Cast JSON field to array automatically
    protected $casts = [
        'subscription_dates' => 'array',
    ];

    // (Optional) Relationships
    public function gig()
    {
        return $this->belongsTo(StatementOfWork::class);
    }

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
    
    
  
    
    public function booking()
    {
        return $this->hasOne(Booking::class, 'subscription_id');
    }


   


  public static function RecurringSubscriptionBooking(){
             $subscriptions=RecurringSubscription::where('status','live')->get();
             
             foreach($subscriptions as $subscription){
                 $booking_current=Booking::where(['subscription_id'=>$subscription->id,'user_id'=>$subscription->user_id])->first();
                 $Subscription_date=$subscription->subscription_dates;
                $date=end($Subscription_date);
                // dd($date);
                
                $dt  = Carbon::createFromFormat('d-m-Y H:i:s', $date, 'Asia/Kolkata');
                $now = Carbon::now('Asia/Kolkata');
                
                $days = $dt->startOfDay()->diffInDays($now->copy()->startOfDay());
                
                if ($days >= 30) {
                    $price=0;
                    $totalPrice=$booking_current->total_price;
                    $initialPaymentPercentage=0;
                    $UserId=$subscription->user_id;
                    $status='pending';
                    
                    $booking = Booking::create([
                        'sow_id' => $subscription->sow_id,
                        'initial_paid_amount' =>$price,
                        'initial_payment_percentage' => $initialPaymentPercentage,
                        'total_price' => $totalPrice,
                        'booking_type' => 'predefined_gig',
                        'status' => 'pending',
                        'payment_status' =>$status, 
                        'created_by' => $UserId,
                        'user_id' => $UserId,
                        'assign_to'=>$booking_current->assign_to,
                        'booking_subscription'=>'yes',
                        'booking_subscription_status'=>'live',
                        'subscription_id'=>$subscription->id,
                    ]);
                    
                    // update date time subscription add 
                    $subscription_update = RecurringSubscription::find($subscription->id);

                    // Decode existing JSON
                    $dates_update = $subscription_update->subscription_dates ?? [];
                    
                    // Determine next key
                    $nextKey = 'subscription_' . (count($dates_update) + 1);
                    
                    // Add new datetime
                    $dates_update[$nextKey] = now()->format('d-m-Y H:i:s');
                    
                    // Update record
                    RecurringSubscription::where('id', 1)->update([
                        'subscription_dates' => json_encode($dates_update)
                    ]);

                    
                    $sow=StatementOfwork::findOrFail($subscription->sow_id);
                    
                    $serviceName = ServiceNmae($sow->service_id)->name;
                    $monthLabel    = $now;
                    
                    $account_manager = Admin::find($booking_current->assign_to);
                    $manager_mobile=$account_manager->mobile;
                    
                  
                    
                    // message to account manager 
                    $managerMsg = "🆕 *New Subscription Booking Assigned*\n\n"
                    . "Client: *{$account_manager->name}*\n"
                    . "Service: *{$serviceName}*\n"
                    . "✅ Please review the brief, schedule touchpoints, and connect with the client.\n";
                    
                    sendWhatsAppMessage($manager_mobile, $managerMsg);
                    
                    
                    $clientUser = Admin::find($UserId);
                    $clientMobile=$clientUser->mobile;
                    
                    // client message 
                    $clientMsg = "📅 *New Month, New Milestone — Your Subscription Is Live*\n\n"
                       . "Hi *{$clientUser->username}*, your monthly booking for *{$serviceName}* has been created for *{$monthLabel}*.\n\n"
                       . "🧾 *Booking Amount Due:* ₹{$totalPrice}\n"
                       . "🤝 Your Account Manager: *{$account_manager->name}*\n"
                       . "Chat on WhatsApp: {$manager_mobile}\n\n"
                       . "🗂 Track progress in dashboad ";
                           sendWhatsAppMessage($clientMobile, $clientMsg);


                  
                }
                
               
               
             }
              
    }


}
