<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
//        $role = 'student';
//        $users = User::whereHas('schools', function ($query) use ($role) {
//            $query->where('role', $role);
//        })->get();

        $userIds = UserSchool::where('role', 'student')->pluck('user_id');

        $students = User::whereIn('id', $userIds)->get();

        return view('pages.students.index', compact('students'));
    }



}
