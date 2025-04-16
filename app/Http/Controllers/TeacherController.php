<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TeacherController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->school()->pivot->role;
        if ($userRole == 'admin') {
            return $this->adminIndex();
        }
    }

    private function adminIndex()
    {
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->get();;
        return view('pages.teachers.index-admin', [
            'teachers' => $teachers,
        ]);
    }
}
