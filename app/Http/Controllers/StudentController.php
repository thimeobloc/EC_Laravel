<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;

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
        $students = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))
            ->with('cohorts') // Charge la relation pour éviter les requêtes N+1
            ->get();

        return view('pages.students.index-admin', [
            'students' => $students,
        ]);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function getForm(User $user)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Données récupérées avec succès',
            'user' => $user // On renvoie les données de l'utilisateur en plus du message
        ]);
    }



}
