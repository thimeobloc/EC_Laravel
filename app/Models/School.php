<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class School extends Model
{
    // Defines the table associated with the model (by default, Laravel would associate it with 'schools')
    protected $table = 'schools';

    // Defines the attributes that can be mass assigned (fillable)
    protected $fillable = ['user_id', 'name', 'description'];

    // Many-to-Many relationship with users (the users associated with the school)
    public function students()
    {
        return $this->belongsToMany(User::class, 'users_schools')
            ->withPivot('role') // important pour accéder au champ "role"
            ->wherePivot('role', 'student');
    }


    public function cohorts()
    {
        return $this->hasMany(Cohort::class);
    }

}
