<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\School;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CohortUser;

class CohortController extends Controller
{
    public function index()
    {
        // Vérification du rôle de l'utilisateur connecté
        $user = auth()->user();
        $school = $user->schools()->first();

        if ($school && $school->pivot) {
            $userRole = $school->pivot->role;

            // Redirection en fonction du rôle (admin ou non)
            if ($userRole === 'admin') {
                return $this->adminIndex();
            } else {
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('dashboard');
    }

    private function adminIndex(): View|Application|Factory
    {
        // Récupérer toutes les cohortes et écoles pour l'affichage
        $cohorts = Cohort::all();
        $schools = School::all();

        return view('pages.cohorts.index', compact('cohorts', 'schools'));
    }

    public function show(Cohort $cohort)
    {
        // Récupérer les IDs des utilisateurs déjà dans la cohorte
        $cohortUserIds = $cohort->users->pluck('id');

        // Récupérer les étudiants qui ne sont pas encore dans la cohorte
        $students = User::whereHas('schools', function ($query) {
            $query->where('users_schools.role', 'student');
        })
            ->whereNotIn('id', $cohortUserIds)
            ->get();

        // Récupérer les enseignants qui ne sont pas encore dans la cohorte
        $teachers = User::whereHas('schools', function ($query) {
            $query->where('users_schools.role', 'teacher');
        })
            ->whereNotIn('id', $cohortUserIds)
            ->get();

        return view('pages.cohorts.show', [
            'cohort' => $cohort,
            'students' => $students,
            'teachers' => $teachers
        ]);
    }

    public function create()
    {
        // Récupérer toutes les écoles et cohortes pour créer une nouvelle cohorte
        $schools = School::all();
        $cohorts = Cohort::all();
        return view('pages.cohorts.create', compact('schools', 'cohorts'));
    }

    public function destroy(Cohort $cohort)
    {
        // Supprimer la cohorte
        $cohort->delete();

        return redirect()->route('cohorts.index')->with('success', 'Cohorte supprimée avec succès.');
    }

    public function removeUserFromCohort(Request $request)
    {
        // Vérifier si les données de l'utilisateur et de la cohorte sont valides
        $userId = $request->user_id;
        $cohortId = $request->cohort_id;

        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        $cohort = Cohort::find($cohortId);
        if (!$cohort) {
            return redirect()->back()->with('error', 'Cohorte non trouvée.');
        }

        // Supprimer l'utilisateur de la cohorte
        $delete_user = CohortUser::where('user_id', $userId)->where("cohort_id", $cohortId)->firstOrFail();
        $delete_user->delete();

        return redirect()->back()->with('success', 'Utilisateur supprimé de la promotion avec succès.');
    }

    public function addUserToCohort(Request $request, Cohort $cohort)
    {
        // Validation des entrées pour les utilisateurs à ajouter
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'teacher_id' => 'nullable|exists:users,id',
        ]);

        // Ajouter un étudiant à la cohorte
        if ($request->filled('user_id')) {
            $student = User::find($request->user_id);
            $cohort->users()->attach($student);
        }

        // Ajouter un enseignant à la cohorte
        if ($request->filled('teacher_id')) {
            $teacher = User::find($request->teacher_id);
            $cohort->users()->attach($teacher);
        }

        return redirect()->route('cohorts.show', $cohort)->with('success', 'Utilisateur ajouté à la promotion.');
    }

    public function store(Request $request)
    {
        // Validation des données pour la création de la cohorte
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'school_id' => 'required|exists:schools,id',
        ]);

        // Créer la nouvelle cohorte
        $cohort = new Cohort();
        $cohort->name = $request->input('name');
        $cohort->description = $request->input('description');
        $cohort->start_date = $request->input('start_date');
        $cohort->end_date = $request->input('end_date');
        $cohort->school_id = $request->input('school_id');
        $cohort->save();

        return redirect()->route('cohorts.index')->with('success', 'Cohorte créée avec succès.');
    }
}
