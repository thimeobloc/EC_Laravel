<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    // Displays the view based on the logged-in user's role
    public function index()
    {
        $userRole = auth()->user()->school()->pivot->role; // Get the user's role in their school

        if ($userRole === 'admin') {
            return $this->adminIndex(); // If admin, display the list of cohorts
        } else {
            return redirect()->route('dashboard'); // Otherwise, redirect to the dashboard
        }
    }

    // Private method to display all cohorts (for admin only)
    private function adminIndex(): View|Application|Factory
    {
        $cohorts = Cohort::all(); // Get all cohorts from the database

        return view('pages.cohorts.index', compact('cohorts')); // Display the view with the cohorts
    }

    // Displays the details of a specific cohort (and its students)
    public function show(Cohort $cohort) {
        $students = $cohort->students; // Get the students associated with the cohort
        $teachers = $cohort->teachers; // Get the teachers associated with the cohort

        return view('pages.cohorts.show', [
            'cohort' => $cohort,
            'students' => $students,
            'teachers' => $teachers // Pass the teachers to the view
        ]);
    }
}
