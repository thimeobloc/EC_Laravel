<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CohortUser extends Model
{
    protected $table = "cohort_user";
    protected $primaryKey = "id";
    protected $fillable=["user_id","cohort_id"];
}
