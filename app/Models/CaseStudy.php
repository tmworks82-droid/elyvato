<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'project_type',
        'slug',
        'featured_image',
        'is_featured',
        
    ];

}
