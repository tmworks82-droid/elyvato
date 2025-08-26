<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;



   protected static function booted()
{
    static::creating(function ($blog) {
        $blog->slug = Str::slug($blog->title); // or $blog->name, depending on your column
    });

    static::updating(function ($blog) {
        if ($blog->isDirty('title')) { // use 'name' if your field is named differently
            $blog->slug = Str::slug($blog->title);
        }
    });
}


     protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'seo_title',
        'meta_description',
        'featured_image',
        'is_active',
    ];

    protected $casts = [
        'category' => 'array', // <-- important
    ];


}
