<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'practice_question_id',
        'score',
        'feedback',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function practiceQuestion()
    {
        return $this->belongsTo(PracticeQuestion::class);
    }
}