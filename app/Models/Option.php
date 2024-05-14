<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'practice_question_id',
        'text',
    ];

    public function practiceQuestion()
    {
        return $this->belongsTo(PracticeQuestion::class);
    }
}
