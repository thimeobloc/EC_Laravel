<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->school()->pivot->role;

        if ($userRole === 'admin') {
            return $this->adminIndex();
        } else {
            return redirect()->route('dashboard'); // ou autre selon ton projet
        }
    }

    private function adminIndex(): View|Application|Factory
    {
        $cohorts = Cohort::all(); // Récupère toutes les promotions

        return view('pages.cohorts.index', compact('cohorts'));
    }

    public function show(Cohort $cohort) {
        $students = $cohort->students;

        return view('pages.cohorts.show', [
            'cohort' => $cohort,
            'students' => $students
        ]);
    }

}
