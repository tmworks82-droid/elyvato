<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstRate extends Model
{
    use HasFactory;

    protected $table = 'gst_rates';

    protected $primaryKey = 'id';

    public $timestamps = false; // Because we're using custom timestamps

    protected $fillable = [
        'rate',
        'description',
        'is_active',
        'created_on',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'is_active' => 'string',
        'created_on' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
