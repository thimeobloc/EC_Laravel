<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserSchool extends Model
{
    // Defines the name of the table associated with the model
    protected $table = 'users_schools';

    // Attributes that can be mass-assigned
    protected $fillable = ['user_id', 'school_id', 'role', 'active'];

    /**
     * Relationship: A record in "users_schools" belongs to a user
     * This allows access to the associated user through $userSchool->user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // A user belongs to a "userSchool" (linked by user_id)
        return $this->belongsTo(User::class, 'user_id');
    }
}
