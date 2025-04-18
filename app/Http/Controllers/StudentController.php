<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Displays the list of students based on the user's role
    public function index()
    {
        $user = auth()->user();
        $role = $user->school()->pivot->role;

        if ($role === 'admin') {
            return $this->adminIndex(); // View for the admin
        } elseif ($role === 'teacher') {
            return $this->teacherIndex(); // View for the teacher (not defined here)
        } else {
            abort(403, "Access denied."); // Access forbidden for other roles
        }
    }

    // Retrieves and displays all students for an admin
    private function adminIndex()
    {
        $students = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))
            ->with('cohorts') // Loads the associated cohorts to avoid multiple queries
            ->get();

        return view('pages.students.index-admin', [
            'students' => $students,
        ]);
    }

    // Displays a student's information in JSON format based on their ID
    public function show($id)
    {
        $student = User::findOrFail($id);
        return response()->json($student);
    }

    // Returns a user's information in JSON format (for forms, etc.)
    public function getForm(User $user)
    {
        $dom = view('pages.students.student-form-update', [
            'studentRoute' => route('student.update', $user),
            'user' => $user
        ])->render();

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'dom' => $dom
        ]);
    }

    // Updates a student's data
    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        return redirect()->back();
    }

    // Creates a new student and adds to the user_schools table
    public function store(Request $request)
    {
        // Data validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'required|date',
        ]);

        // Create the user with a default password
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'password' => bcrypt('12345678'), // Default password
        ]);

        // Add the user to the user_schools table with the role "student"
        UserSchool::create([
            'user_id' => $user->id,  // ID of the created user
            'school_id' => 1,        // Ensure the school_id is correct
            'role' => 'student',     // Assign the "student" role
        ]);

        // Return a response or redirect after creation
        return redirect()->route('student.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    // Deletes a student based on their ID
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Étudiant supprimé avec succès.');
    }
}
