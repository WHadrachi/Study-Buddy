<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_plan_id',
        'startDate',
        'endDate',
    ];

    public function studyPlan()
    {
        return $this->belongsTo(StudyPlan::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}
