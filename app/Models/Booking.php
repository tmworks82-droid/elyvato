<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StatementOfWork;
use App\Models\CustomeBooking;
use App\Models\HireTalent;


class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'sow_id',
        'status',
        'initial_payment_percentage',
        'total_price',
        'initial_paid_amount',
        'is_active',
        'booking_type',
        'assign_to',
        'payment_status',
        'booking_subscription',
        'booking_subscription_status',
        'subscription_id',
        'created_on',
        'created_by',
        'updated_by',
        'booking_id',
        'is_visited',
        'hire_talent_id',
    ];

    public $timestamps = false;

      protected static function booted()
        {
            static::creating(function ($booking) {
                $lastBooking = Booking::latest('id')->first();
                $lastBookingId = $lastBooking ? (int) substr($lastBooking->booking_id, 1) : 0;
                $booking->booking_id = 'E' . str_pad($lastBookingId + 1, 6, '0', STR_PAD_LEFT);
            });
        }
    
    // Relationships

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    public function statementOfWork()
    {
        return $this->belongsTo(StatementOfWork::class, 'sow_id');
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function sow()
    {
        return $this->belongsTo(StatementOfWork::class, 'sow_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class);
        // Or hasMany(Project::class) if 1 booking = many projects
    }


    public function customBookings()
    {
        return $this->hasMany(CustomeBooking::class, 'booking_id');
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'booking_id');
    }



    // In App\Models\Booking.php
    public function firstCall()
    {
        return $this->hasOne(Call::class, 'booking_id', 'id')->latestOfMany();
    }
    
    // public function recurringSubscription()
    // {
    //     return $this->hasOne(RecurringSubscription::class);
    // }


    public function recurringSubscription()
    {
        return $this->belongsTo(RecurringSubscription::class, 'subscription_id');
    }


public function hireTalent()
    {
        return $this->belongsTo(HireTalent::class, 'hire_talent_id');
    }

}
