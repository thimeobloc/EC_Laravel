<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'cohort_user');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'cohort_user')
            ->wherePivot('role', 'student');
    }


    public function teachers()
    {
        return $this->belongsToMany(User::class, 'cohort_user')
            ->wherePivot('role', 'teacher');
    }

}
