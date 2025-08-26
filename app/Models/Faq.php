<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

      protected $fillable = [
        'page_name',
        'question',
        'answer',
        'is_active',
    ];
}
