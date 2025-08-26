<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class CustomeBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'subservice_id',
        'sow_id',
        'booking_id',
        'cost_amount',
        'call_booking_price',
        'user_id',
        'brief_description'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

}
