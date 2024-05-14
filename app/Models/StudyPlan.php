<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function timeline()
    {
        return $this->hasOne(Timeline::class);
    }
}
