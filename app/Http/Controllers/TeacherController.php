<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Displays the list of teachers based on the user's role
    public function index()
    {
        $user = auth()->user();
        $role = $user->school()->pivot->role;

        if ($role === 'admin') {
            return $this->adminIndex(); // View for the admin
        } elseif ($role === 'teacher') {
            return $this->teacherIndex(); // View for the teacher
        } else {
            abort(403, "Access denied."); // Access forbidden for other roles
        }
    }

    // Retrieves and displays all teachers for an admin
    private function adminIndex()
    {
        // Retrieve teachers who are in the "teacher" role
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))
            ->with('cohorts') // You can also eager load other relations as needed
            ->get();

        return view('pages.teachers.index-admin', [
            'teachers' => $teachers,
        ]);
    }

    // Displays an individual teacher's information in JSON format
    public function show($id)
    {
        $teacher = User::findOrFail($id); // Checks if the teacher exists
        return response()->json($teacher);
    }

    // Returns a teacher's information in JSON format (for forms, etc.)
    public function getForm(User $teacher)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'teacher' => $teacher
        ]);
    }

    // Updates a teacher's data
    public function update(Request $request, $id)
    {
        try {
            $teacher = User::findOrFail($id); // Checks if the teacher exists
            $teacher->update($request->all()); // Updates with the received data

            return response()->json(['status' => 'success', 'teacher' => $teacher], 200);
        } catch (\Exception $e) {
            // If an error occurs, return an error message
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
