<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;
use App\Models\Booking;

class HireTalent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'is_active',
        'is_available',
        'content'
    ];
    
     protected static function booted(): void
    {
        // Before saving the model, generate the slug from the name.
        static::saving(function ($hireTalent) {
            // Check if the name is being changed or if the model is new
            if ($hireTalent->isDirty('name') || !$hireTalent->exists) {
                $hireTalent->slug = Str::slug($hireTalent->name);
            }
        });
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'hire_talent_id');
    }

}
