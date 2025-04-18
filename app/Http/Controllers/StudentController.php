<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use function Termwind\render;

class StudentController extends Controller
{
    // Displays the list of students based on the user's role
    public function index()
    {
        $user = auth()->user();
        $role = $user->school()->pivot->role;

        if ($role === 'admin') {
            return $this->adminIndex(); // Show the admin view
        } elseif ($role === 'teacher') {
            return $this->teacherIndex(); // Show the teacher view (not implemented here)
        } else {
            abort(403, "Access denied."); // Deny access for other roles
        }
    }

    // Retrieves and displays all students for the admin
    private function adminIndex()
    {
        $students = User::whereIn('id', UserSchool::where('role', 'student')->pluck('user_id'))
            ->with('cohorts') // Eager-load associated cohorts to optimize queries
            ->get();

        return view('pages.students.index-admin', [
            'students' => $students,
        ]);
    }

    // Returns the student data in JSON format based on the given ID
    public function show($id)
    {
        $student = User::findOrFail($id);
        return response()->json($student);
    }

    // Loads and returns the student edit form as HTML (used in modals)
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

    // Updates student information based on submitted data
    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        return redirect()->back();
    }

    // Stores a new student and links them to the school
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'birth_date'  => 'required|date',
        ]);

        // Create the user with a default password
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'birth_date' => $request->birth_date,
            'password'   => bcrypt('12345678'), // Default password
        ]);

        // Link the user to the school with the "student" role
        UserSchool::create([
            'user_id'   => $user->id,
            'school_id' => 1, // Ensure this is the correct school_id
            'role'      => 'student',
        ]);

        // Redirect after successful creation
        return redirect()->route('student.index')->with('success', 'Student successfully added.');
    }

    // Deletes a student by ID
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student successfully deleted.');
    }
}
