<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization (do not expose password and token)
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast during serialization (e.g., date and password)
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Cast the email_verified_at to date
            'password' => 'hashed', // Ensure that the password is hashed
        ];
    }

    /**
     * Function that returns the full name of the logged-in user
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name; // Returns the full name in the format: Last Name First Name
    }

    /**
     * Function that returns the short name of the user (first name and initial of last name)
     * @return string
     */
    public function getShortNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name[0] . '.'; // Example: Jean D.
    }

    /**
     * Retrieves the user's school
     *
     * @return (Model&object)|null
     */
    public function school() {
        // A user can be associated with only one school
        return $this->belongsToMany(School::class, 'users_schools')
            ->withPivot('role') // Also retrieve the user's role in the pivot table
            ->first(); // Returns the first associated school
    }

    /**
     * Retrieves the user's cohorts (promotions)
     *
     * @return BelongsToMany
     */
    public function cohorts()
    {
        return $this->belongsToMany(Cohort::class, 'cohort_user')->withPivot('role'); // Many-to-Many relationship with cohorts, also retrieving the role
    }

    // The userRole function is commented out but could be used to manage roles more precisely if activated
//    public function userRole(string $role){
//        return $this->belongsToMany()
//    }
}
