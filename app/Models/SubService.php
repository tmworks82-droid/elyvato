<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubService extends Model
{
    use HasFactory;

    protected $table = 'subservices'; // Optional if Laravel default matches

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'subservice_icon',
        'status',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_active' => 'boolean',
    ];


      protected static function booted()
    {
        static::creating(function ($subservice) {
            $subservice->slug = Str::slug($subservice->name);
        });

         static::updating(function ($subservice) {
        
        if ($subservice->isDirty('name')) {
            $subservice->slug = Str::slug($subservice->name);
        }
    });

    }


    // Relationships
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

        public function bookings()
        {
            return $this->hasMany(Booking::class);
        }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
