<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $userIds = UserSchool::where('role', 'teacher')->pluck('user_id');

        $teachers = User::whereIn('id', $userIds)->get();

        return view('pages.teachers.index', compact('teachers'));
    }
}
