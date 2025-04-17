<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Display the index page based on the user's role
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');  // Redirect to login if user is not authenticated
        }

        $userRole = auth()->user()->school()->pivot->role;  // Retrieve the role of the authenticated user

        if ($userRole == 'admin') {
            return $this->adminIndex();  // Show the admin index if the user is an admin
        }

        return redirect()->route('home');  // Redirect to home for non-admin users
    }

    // Show the admin page with the list of teachers
    private function adminIndex()
    {
        // Fetch the teachers assigned to the current user's school
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->get();

        return view('pages.teachers.index-admin', [
            'teachers' => $teachers,  // Pass the teachers to the view
        ]);
    }

    // Store a new teacher in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // Ensure the email is unique
            'birth_date' => 'nullable|date',
            'password' => 'required|string|min:6',  // Password must be at least 6 characters
        ]);

        // Create a new user (teacher) and save it to the database
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),  // Encrypt the password
        ]);

        // Associate the user with the school as a teacher
        UserSchool::create([
            'user_id' => $user->id,
            'school_id' => auth()->user()->school()->id,  // Link the user to the authenticated user's school
            'role' => 'teacher',  // Set the role to teacher
        ]);

        return redirect()->back()->with('success', 'Enseignant créé avec succès.');  // Redirect with success message
    }

    // Update an existing teacher's information
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,  // Ensure email is unique except for the current teacher
            'password' => 'nullable|string|min:6',  // Password is optional for update
        ]);

        $teacher = User::findOrFail($id);  // Find the teacher by ID or fail if not found

        // Update the teacher's details
        $teacher->last_name = $request->last_name;
        $teacher->first_name = $request->first_name;
        $teacher->email = $request->email;

        // If a new password is provided, update it
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();  // Save the updated teacher information

        return redirect()->back()->with('success', 'Enseignant mis à jour avec succès.');  // Redirect with success message
    }

    // Delete a teacher from the database
    public function destroy($id)
    {
        $teacher = User::findOrFail($id);  // Find the teacher by ID or fail if not found

        // Delete the teacher's association with the school
        UserSchool::where('user_id', $teacher->id)->delete();

        $teacher->delete();  // Delete the teacher from the database

        return redirect()->back()->with('success', 'Enseignant supprimé avec succès.');  // Redirect with success message
    }
}
