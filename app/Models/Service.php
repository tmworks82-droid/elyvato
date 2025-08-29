<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table            = 'services';

    protected $fillable = [
            'name',
            'slug',
            'description',
            'service_icon',
            'icon',
            'created_by',
            'is_live',
            'status',
            'is_active',
            'created_at',
            'updated_at',
            'seo_title',
        'meta_description',
    ];

    protected $hidden           = [
        'created_at',
        'updated_at',
        'is_live',
        'status'
    ];

    protected $dates            = [
        'created_at',
        'updated_at',

    ];

    protected $casts            = [
        'created_at'            => "datetime:d-M-Y h:i A",
        'updated_at'            => "datetime:d-M-Y h:i A",
    ];


   protected static function booted()
    {
        static::creating(function ($service) {
            $service->slug = Str::slug($service->name);
        });

         static::updating(function ($service) {
        
        if ($service->isDirty('name')) {
            $service->slug = Str::slug($service->name);
        }
    });

    }

     public function statementsOfWork()
    {
        return $this->hasMany(StatementOfWork::class, 'service_id','id');
    }


    public function subservices() {
        return $this->hasMany(SubService::class, 'service_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


}
