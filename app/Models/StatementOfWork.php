<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AllFiles;
use App\Models\SubService;

use App\Models\Service;
use Illuminate\Support\Str;



class StatementOfWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'subservice_id',
        'title',
        'slug',
        'description',
        'price',
        'offer_price',
        'estimated_time',
        'is_active',
        'featured',
        'is_subscription',
        'subscription_time',
        'created_by',
        'updated_by',
        'seo_title',
        'meta_description',
    ];

   


    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_at';


     protected static function booted()
    {
        static::creating(function ($sow) {
            $sow->slug = Str::slug($sow->title);
        });

    }

    public $timestamps = true;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subservice()
    {
        return $this->belongsTo(SubService::class);
    }

    public function allFiles()
    {
        return $this->hasMany(AllFiles::class, 'sow_id', 'id');
    }

}
