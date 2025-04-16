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
        $student = Student::findOrFail($id); // Checks if the student exists
        return response()->json($student);
    }

    // Returns a user's information in JSON format (for forms, etc.)
    public function getForm(User $user)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'user' => $user
        ]);
    }

    // Updates a student's data
    public function update(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id); // Checks if the student exists
            $student->update($request->all()); // Updates with the received data

            return response()->json(['status' => 'success', 'user' => $student], 200);
        } catch (\Exception $e) {
            // If an error occurs, returns an error message
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
