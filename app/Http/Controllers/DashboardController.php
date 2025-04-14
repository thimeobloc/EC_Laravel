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
        $students = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))->take(3)->get();
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->take(3)->get();


        $cohortsCount = Cohort::count();
        $studentsCount = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))->count();
        $teachersCount = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->count();

        return view('pages.dashboard.dashboard-admin', [
            'cohorts' => $cohorts,
            'students' => $students,
            'teachers' => $teachers,
            'cohortsCount' => $cohortsCount,
            'studentsCount' => $studentsCount,
            'teachersCount' => $teachersCount,
        ]);
    }



    private function teacherIndex()
    {
        $user = auth()->user();

        // Récupère les promotions de l'enseignant
        $cohorts = $user->cohorts()->take(3)->get();
        $cohortsCount = $user->cohorts()->count();

        // Récupère tous les étudiants liés à ces promotions
        $students = User::whereIn('id', function ($query) use ($cohorts) {
            $query->select('user_id')
                ->from('cohort_user')
                ->whereIn('cohort_id', $cohorts->pluck('id'))
                ->where('role', 'student');
        })->take(3)->get();

        $studentsCount = User::whereIn('id', function ($query) use ($cohorts) {
            $query->select('user_id')
                ->from('cohort_user')
                ->whereIn('cohort_id', $cohorts->pluck('id'))
                ->where('role', 'student');
        })->count();

        return view('pages.dashboard.dashboard-admin', [
            'cohorts' => $cohorts,
            'students' => $students,
            'cohortsCount' => $cohortsCount,
            'studentsCount' => $studentsCount,
            'teachers' => null,
            'teachersCount' => null,
        ]);
    }


}
