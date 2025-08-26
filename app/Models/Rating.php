<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'rated_by',
        'rating',
        'review',
    ];


    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function ratedBy()
    {
        return $this->belongsTo(Admin::class, 'rated_by');
    }

}
