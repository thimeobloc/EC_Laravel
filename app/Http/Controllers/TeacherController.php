<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TeacherController extends Controller
{
    // This method handles the index route for the teacher dashboard
    public function index()
    {
        // If the user is not authenticated, redirect them to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Retrieve the user's role from the pivot table
        $userRole = auth()->user()->school()->pivot->role;

        // If the user is an admin, show the admin index page
        if ($userRole == 'admin') {
            return $this->adminIndex();
        }

        // Otherwise, redirect to the home page
        return redirect()->route('home');
    }

    // This method is for showing the admin index page with a list of teachers
    private function adminIndex()
    {
        // Get all users with the role 'teacher' by looking up the 'UserSchool' pivot table
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->get();

        // Return the admin index view with the list of teachers
        return view('pages.teachers.index-admin', [
            'teachers' => $teachers,
        ]);
    }

    // This method retrieves the user data by ID
    public function getUserData($id)
    {
        // Find the user by ID
        $user = User::find($id);
        // If the user is not found, return an error message as JSON with a 404 status code
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        // Return the user data as JSON
        return response()->json($user);
    }
}
