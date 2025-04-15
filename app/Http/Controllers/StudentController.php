<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->school()->pivot->role;

        if ($role === 'admin') {
            return $this->adminIndex();
        } elseif ($role === 'teacher') {
            return $this->teacherIndex();
        } else {
            abort(403, "Accès refusé.");
        }
    }

    private function adminIndex()
    {
        $students = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))->get();

        return view('pages.students.index-admin', [
            'students' => $students,
        ]);
    }

    private function teacherIndex()
    {
        $user = auth()->user();
        $cohortIds = $user->cohorts()->pluck('cohort_id');

        $students = User::whereIn('id', function ($query) use ($cohortIds) {
            $query->select('user_id')
                ->from('cohort_user')
                ->whereIn('cohort_id', $cohortIds)
                ->where('role', 'student');
        })->get();

        return view('pages.students.index-teacher', [
            'students' => $students,
        ]);
    }

    // ✅ Création d'un étudiant (AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'last_name'   => 'required|string|max:255',
            'first_name'  => 'required|string|max:255',
            'birth_date'  => 'required|date',
            'email'       => 'required|email|unique:users,email',
            'cohort_id'   => 'required|exists:cohorts,id',
        ]);

        $password = Str::random(10);

        $student = User::create([
            'last_name'   => $request->last_name,
            'first_name'  => $request->first_name,
            'birth_date'  => $request->birth_date,
            'email'       => $request->email,
            'password'    => Hash::make($password),
        ]);

        UserSchool::create([
            'user_id'  => $student->id,
            'school_id' => auth()->user()->school->id,
            'role'     => 'student',
        ]);

        $student->cohorts()->attach($request->cohort_id, ['role' => 'student']);

        // ✉️ Envoi du mot de passe par mail (ajuste avec ton mail perso si besoin)
        Mail::to($student->email)->send(new \App\Mail\StudentPasswordMail($student, $password));

        return response()->json([
            'message' => 'Étudiant ajouté avec succès',
            'student' => $student,
        ]);
    }

    // ✅ Modification d'un étudiant (AJAX)
    public function update(Request $request, User $student)
    {
        $request->validate([
            'last_name'   => 'required|string|max:255',
            'first_name'  => 'required|string|max:255',
            'birth_date'  => 'required|date',
            'email'       => 'required|email|unique:users,email,' . $student->id,
            'cohort_id'   => 'required|exists:cohorts,id',
        ]);

        $student->update([
            'last_name'   => $request->last_name,
            'first_name'  => $request->first_name,
            'birth_date'  => $request->birth_date,
            'email'       => $request->email,
        ]);

        $student->cohorts()->sync([$request->cohort_id => ['role' => 'student']]);

        return response()->json([
            'message' => 'Étudiant mis à jour avec succès',
            'student' => $student,
        ]);
    }

    // ✅ Suppression d'un étudiant (AJAX)
    public function destroy(User $student)
    {
        $student->cohorts()->detach();
        UserSchool::where('user_id', $student->id)->delete();
        $student->delete();

        return response()->json(['message' => 'Étudiant supprimé avec succès']);
    }
}
