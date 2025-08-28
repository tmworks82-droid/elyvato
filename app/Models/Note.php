<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Admin;

class Note extends Model
{
    use HasFactory;

      protected $fillable = [
        'booking_id',
        'note',
        'created_by',
        'updated_by',
    ];

    /**
     * Relations
     */
    
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
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
