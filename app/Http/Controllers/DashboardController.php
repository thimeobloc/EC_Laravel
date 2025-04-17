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
    // Displays the dashboard based on the user's role
    public function index()
    {
        $userRole = auth()->user()->school()->pivot->role; // Get the user's role

        if ($userRole == 'admin') return $this->adminIndex();       // Redirects to the admin dashboard
        else if ($userRole == 'teacher') return $this->teacherIndex(); // Redirects to the teacher's dashboard
        else return $this->studentIndex();                           // Redirects to the student dashboard (to be created)
    }

    // View for the admin
    private function adminIndex()
    {
        // Retrieves the first 3 cohorts, students, and teachers
        $cohorts = Cohort::take(3)->get();
        $students = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))->take(3)->get();
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->take(3)->get();

        // Total count of cohorts, students, and teachers
        $cohortsCount = Cohort::count();
        $studentsCount = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))->count();
        $teachersCount = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->count();

        // Displays the view with the retrieved data
        return view('pages.dashboard.dashboard-admin', [
            'cohorts' => $cohorts,
            'students' => $students,
            'teachers' => $teachers,
            'cohortsCount' => $cohortsCount,
            'studentsCount' => $studentsCount,
            'teachersCount' => $teachersCount,
        ]);
    }

    // View for a teacher
    private function teacherIndex()
    {
        $user = auth()->user();

        // Retrieves the first 3 cohorts of the teacher
        $cohorts = $user->cohorts()->take(3)->get();
        $cohortsCount = $user->cohorts()->count();

        // Retrieves 3 students associated with their cohorts
        $students = User::whereIn('id', function ($query) use ($cohorts) {
            $query->select('user_id')
                ->from('cohort_user')
                ->whereIn('cohort_id', $cohorts->pluck('id'))
                ->where('role', 'student');
        })->take(3)->get();

        // Total count of students associated with their cohorts
        $studentsCount = User::whereIn('id', function ($query) use ($cohorts) {
            $query->select('user_id')
                ->from('cohort_user')
                ->whereIn('cohort_id', $cohorts->pluck('id'))
                ->where('role', 'student');
        })->count();

        // Displays the view (same as the admin but without teachers)
        return view('pages.dashboard.dashboard-teacher', [
            'cohorts' => $cohorts,
            'students' => $students,
            'cohortsCount' => $cohortsCount,
            'studentsCount' => $studentsCount,
            'teachers' => null,
            'teachersCount' => null,
        ]);
    }

    // (To be implemented if necessary) View for the student
    private function studentIndex()
    {
        // To be completed based on project needs
    }
}
