<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_type',
        'transaction_id',
        'status',
        'payment_date',
        'is_active',
        'created_on',
        'created_by',
        'updated_by'
    ];

    public $timestamps = false; // Because we’re using custom timestamps

    protected $dates = ['payment_date', 'created_on', 'updated_at'];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
