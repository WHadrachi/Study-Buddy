<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'type',
        'content',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}