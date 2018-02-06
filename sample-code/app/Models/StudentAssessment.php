<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAssessment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students_assessments';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'subject_id', 'assessment', 'workload_lectures', 'workload_exercises',
    ];

    /**
     *
     * Get the students for assessments
     *
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    /**
     *
     * Get the subjects for assessments
     *
     */
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }

}
