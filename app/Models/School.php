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
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_schools'); // Relationship with the pivot table 'users_schools'
    }
}
