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


    private function teacherIndex()
    {
        // À implémenter si nécessaire pour un rôle de professeur
        // Par exemple, tu peux récupérer les étudiants en fonction de la cohorte du professeur
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

}
