<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_short',
    ];

    /**
     *
     * Get the students for speciality
     *
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}