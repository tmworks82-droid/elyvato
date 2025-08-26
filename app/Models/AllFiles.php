<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\StatementOfWork;

class AllFiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'sow_id', 'image_path', 'audio_path', 'video','file_type'
    ];

    public function statementOfWork()
    {
        return $this->belongsTo(StatementOfWork::class, 'sow_id', 'id');
    }
}
