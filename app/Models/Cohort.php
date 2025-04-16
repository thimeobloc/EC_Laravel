<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    // Defines the table associated with the model (by default, Laravel would associate it with 'cohorts')
    protected $table = 'cohorts';

    // Defines the attributes that can be mass assigned (fillable)
    protected $fillable = ['school_id', 'name', 'description', 'start_date', 'end_date'];

    // Many-to-Many relationship with users (all users of a cohort)
    public function users()
    {
        return $this->belongsToMany(User::class, 'cohort_user');
    }

    // Many-to-Many relationship with students only (filter by 'student' role in the pivot table)
    public function students()
    {
        return $this->belongsToMany(User::class, 'cohort_user')
            ->wherePivot('role', 'student'); // Filter to only retrieve students
    }

    // Many-to-Many relationship with teachers only (filter by 'teacher' role in the pivot table)
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'cohort_user')
            ->wherePivot('role', 'teacher'); // Filter to only retrieve teachers
    }
}
