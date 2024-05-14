<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_plan_id',
        'type',
        'description',
    ];

    public function studyPlan()
    {
        return $this->belongsTo(StudyPlan::class);
    }
}
