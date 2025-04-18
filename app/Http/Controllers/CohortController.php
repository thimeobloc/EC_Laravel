<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\School;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CohortUser;

class CohortController extends Controller
{
    public function index()
    {
        // Check the role of the logged-in user
        $user = auth()->user();
        $school = $user->schools()->first();

        if ($school && $school->pivot) {
            $userRole = $school->pivot->role;

            // Redirect based on user role (admin or not)
            if ($userRole === 'admin') {
                return $this->adminIndex();
            } else {
                return redirect()->route('dashboard');
            }
        }
        return redirect()->route('dashboard');
    }
    private function adminIndex(): View|Application|Factory
    {
        // Retrieve all cohorts and schools for display
        $cohorts = Cohort::all();
        $schools = School::all();

        return view('pages.cohorts.index', compact('cohorts', 'schools'));
    }

    public function show(Cohort $cohort)
    {
        // Retrieve the IDs of users already in the cohort
        $cohortUserIds = $cohort->users->pluck('id');

        // Retrieve students who are not yet in the cohort
        $students = User::whereHas('schools', function ($query) {
            $query->where('users_schools.role', 'student');
        })
            ->whereNotIn('id', $cohortUserIds)
            ->get();

        // Retrieve teachers who are not yet in the cohort
        $teachers = User::whereHas('schools', function ($query) {
            $query->where('users_schools.role', 'teacher');
        })
            ->whereNotIn('id', $cohortUserIds)
            ->get();

        return view('pages.cohorts.show', [
            'cohort' => $cohort,
            'students' => $students,
            'teachers' => $teachers
        ]);
    }
    public function create()
    {
        // Retrieve all schools and cohorts for creating a new cohort
        $schools = School::all();
        $cohorts = Cohort::all();
        return view('pages.cohorts.create', compact('schools', 'cohorts'));
    }
    public function destroy(Cohort $cohort)
    {
        // Delete the cohort
        $cohort->delete();

        return redirect()->route('cohorts.index')->with('success', 'Cohort deleted successfully.');
    }
    public function removeUserFromCohort(Request $request)
    {
        // Validate the user and cohort data
        $userId = $request->user_id;
        $cohortId = $request->cohort_id;

        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $cohort = Cohort::find($cohortId);
        if (!$cohort) {
            return redirect()->back()->with('error', 'Cohort not found.');
        }
        // Remove the user from the cohort
        $delete_user = CohortUser::where('user_id', $userId)->where("cohort_id", $cohortId)->firstOrFail();
        $delete_user->delete();

        return redirect()->back()->with('success', 'User removed from cohort successfully.');
    }

    public function addUserToCohort(Request $request, Cohort $cohort)
    {
        // Validate form fields
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'teacher_id' => 'nullable|exists:users,id',
        ]);

        // Add a student
        if ($request->filled('user_id')) {
            $student = User::find($request->user_id);

            // Check if the user is a student
            if ($student && $student->schools()->where('role', 'student')->exists()) {
                // Add the student to the cohort via the pivot table
                $cohort->users()->attach($student);
            } else {
                // If the user is not a student, return an error message
                return redirect()->route('cohorts.show', $cohort)->with('error', 'The selected user is not a student.');
            }
        }
        // Add a teacher
        if ($request->filled('teacher_id')) {
            $teacher = User::find($request->teacher_id);

            // Check if the user is a teacher
            if ($teacher && $teacher->schools()->where('role', 'teacher')->exists()) {
                // Add the teacher to the cohort via the pivot table
                $cohort->users()->attach($teacher);
            } else {
                // If the user is not a teacher, return an error message
                return redirect()->route('cohorts.show', $cohort)->with('error', 'The selected user is not a teacher.');
            }
        }
        // If everything went well, redirect with a success message
        return redirect()->route('cohorts.show', $cohort)->with('success', 'User added to the cohort successfully.');
    }

    public function store(Request $request)
    {
        // Validate data for creating the cohort
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'school_id' => 'required|exists:schools,id',
        ]);
        // Create the new cohort
        $cohort = new Cohort();
        $cohort->name = $request->input('name');
        $cohort->description = $request->input('description');
        $cohort->start_date = $request->input('start_date');
        $cohort->end_date = $request->input('end_date');
        $cohort->school_id = $request->input('school_id');
        $cohort->save();

        return redirect()->route('cohorts.index')->with('success', 'Cohort created successfully.');
    }
}
