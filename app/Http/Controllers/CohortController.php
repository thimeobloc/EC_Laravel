<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    /**
     * Display all available cohorts for the teacher
     * @return Factory|View|Application|object
     */
    public function teacherIndex() {
        $user = auth()->user(); // Récupère l'utilisateur connecté
        $cohorts = $user->cohorts; // Récupère toutes les promotions de l'enseignant actuel

        return view('pages.cohorts.index', compact('cohorts'));
    }

    /**
     * Display a specific cohort with students and their performances
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {
        // Récupérer les étudiants associés à la promotion
        $students = $cohort->students; // Relation many-to-many entre Cohort et User

        return view('pages.cohorts.show', [
            'cohort' => $cohort,
            'students' => $students
        ]);
    }
}
