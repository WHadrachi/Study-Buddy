<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'learningStyle',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyPlan()
    {
        return $this->hasOne(StudyPlan::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}
