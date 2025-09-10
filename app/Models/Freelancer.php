<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'country', 'pincode',
        'gst', 'talent', 'experience', 'qualification', 'languages',
        'certification', 'portfolio', 'ratecard'
    ];

}
