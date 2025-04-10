<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class School extends Model
{
    protected $table        = 'schools';
    protected $fillable     = ['user_id', 'name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_schools');
    }
}
