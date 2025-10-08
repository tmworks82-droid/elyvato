<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = 
    [   'currency_code', 
        'currency_symbol',
        'currency_name',
        'price',
        'min_price',
        'sow_id',
        'offer_price'
    ];


     public function sow()
    {
        return $this->belongsTo(\App\Models\StatementOfWork::class, 'sow_id', 'id');
    }
}
