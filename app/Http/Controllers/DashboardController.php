<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->school()->pivot->role;

        if ($userRole == 'admin') return $this->adminIndex();
        else if ($userRole == 'teacher') return $this->teacherIndex();
        else return $this->studentIndex();
    }

    private function adminIndex()
    {
        $cohorts = Cohort::take(3)->get();
        $userIds = UserSchool::where('role', 'student')->pluck('user_id');
        $students = User::whereIn('id', $userIds)->take(3)->get();
        $userIds = UserSchool::where('role', 'teacher')->pluck('user_id');
        $teachers = User::whereIn('id', $userIds)->take(3)->get();
        return view('pages.dashboard.dashboard-admin', [
            'cohorts' => $cohorts,
            'students' => $students,
            'teachers' => $teachers,
        ]);
    }

    private function teacherIndex()
    {
        $cohorts = Cohort::take(3)->get();
        return view('pages.dashboard.dashboard-admin', compact('cohorts'));
    }

}
