<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeline_id',
        'description',
        'dueDate',
    ];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }
}
