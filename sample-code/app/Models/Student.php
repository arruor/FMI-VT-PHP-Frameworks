<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'fnumber', 'email', 'course_id', 'speciality_id', 'education_form'
    ];

    /**
     *
     * Get the course for student
     *
     */
    public function course()
    {
        return $this->hasOne('App\Models\Course');
    }

    /**
     *
     * Get the speciality for student
     *
     */
    public function speciality()
    {
        return $this->hasOne('App\Models\Speciality');
    }

    /**
     *
     * Get the assessments for student
     *
     */
    public function assessments()
    {
        return $this->hasMany('App\Models\StudentAssessment');
    }
}
