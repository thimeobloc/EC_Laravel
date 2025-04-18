<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            return $this->teacherIndex(); // View for the teacher (not defined here)
        } else {
            abort(403, "Access denied."); // Access forbidden for other roles
        }
    }

    // Retrieves and displays all teachers for an admin
    private function adminIndex()
    {
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))
            ->with('cohorts') // Loads the associated cohorts to avoid multiple queries
            ->get();

        return view('pages.teachers.index-admin', [
            'teachers' => $teachers,
        ]);
    }

    // Displays a teacher's information in JSON format based on their ID
    public function show($id)
    {
        $teacher = User::findOrFail($id);
        return response()->json($teacher);
    }

    // Returns a teacher's information in JSON format (for forms, etc.)
    public function getForm(User $user)
    {
        $dom = view('pages.teachers.teacher-form-update', [
            'teacherRoute' => route('teacher.update', $user),
            'user' => $user
        ])->render();

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'dom' => $dom
        ]);
    }

    // Updates a teacher's data
    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        return redirect()->back();
    }

    // Creates a new teacher and adds to the user_schools table
    public function store(Request $request)
    {
        // Data validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);


        // Create the user with the given password
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
        ]);

        // Add the user to the user_schools table with the role "teacher"
        UserSchool::create([
            'user_id' => $user->id,  // ID of the created user
            'school_id' => 1,        // Ensure the school_id is correct
            'role' => 'teacher',     // Assign the "teacher" role
        ]);

        // Return a response or redirect after creation
        return redirect()->route('teachers.index')->with('success', 'Enseignant ajouté avec succès.');
    }

    // Deletes a teacher based on their ID
    public function destroy($id)
    {
        $teacher = User::findOrFail($id);
        UserSchool::where('user_id', $teacher->id)->delete(); // Remove from user_schools
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé avec succès.');
    }
}
