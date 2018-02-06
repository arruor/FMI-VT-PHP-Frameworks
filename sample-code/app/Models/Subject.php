<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'workload_lectures', 'workload_exercises'
    ];

    /**
     *
     * Get the assessments for subject
     *
     */
    public function assessments()
    {
        return $this->hasMany('App\Models\StudentAssessment');
    }
}
