<?php
use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {  // Ensure the user is authenticated

    // Profile routes (edit, update, delete)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  // Display the profile edit form
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');  // Update the user's profile information
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');  // Delete the user's profile

    Route::middleware('verified')->group(function () {  // Ensure the user's email is verified

        // Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // Display the dashboard page

        // Cohort routes
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');  // Display the list of cohorts
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');  // Show the details of a specific cohort
        Route::get('/cohorts/create', [CohortController::class, 'create'])->name('cohorts.create');  // Show the form to create a new cohort
        Route::post('/cohorts', [CohortController::class, 'store'])->name('cohorts.store');  // Store a new cohort
        Route::delete('/cohorts/{cohort}', [CohortController::class, 'destroy'])->name('cohorts.destroy');  // Delete a specific cohort
        Route::post('/cohort-removeUser', [CohortController::class, 'removeUserFromCohort'])->name('cohort.removeUser');  // Remove a user from a cohort
        Route::post('/cohorts/{cohort}/add-user', [CohortController::class, 'addUserToCohort'])->name('cohorts.addUser');  // Add a user to a cohort

        // Teacher routes
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');  // Display the list of teachers
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');  // Store a new teacher
        Route::post('/teachers/update/{user}', [TeacherController::class, 'update'])->name('teachers.update');  // Update an existing teacher's information
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');  // Delete a teacher by their ID
        Route::get('/teacher/form/{user}', [TeacherController::class, 'getForm'])->name('teacher.form.get');  // Show the form to edit a teacher's details

        // Student routes
        Route::get('students', [StudentController::class, 'index'])->name('student.index');  // Display the list of students (Admin/Teacher view)
        Route::post('student/update/{user}', [StudentController::class, 'update'])->name('student.update');  // Update an individual student's data
        Route::get('student/form/{user}', [StudentController::class, 'getForm'])->name('student.form.get');  // Show the form for updating a specific student's data
        Route::post('students/store', [StudentController::class, 'store'])->name('students.store');  // Store a new student
        Route::delete('student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');  // Delete a student by their ID

        // Knowledge routes
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');  // Display the knowledge base page

        // Group routes
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');  // Display the list of groups

        // Retro routes
        Route::get('retros', [RetroController::class, 'index'])->name('retro.index');  // Display the retrospectives

        // Common life routes
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');  // Display common life information

        // Resources for cohorts, students, teachers, and groups pages
        Route::get('resources/pages/cohorts/index', [CohortController::class, 'index'])->name('cohorts.index');  // Access cohort resources
        Route::get('resources/pages/students/index', [StudentController::class, 'index'])->name('students.index');  // Access student resources
        Route::get('resources/pages/teachers/index', [TeacherController::class, 'index'])->name('teachers.index');  // Access teacher resources
        Route::get('resources/pages/groups/index', [GroupController::class, 'index'])->name('groups.index');  // Access group resources
    });

});

require __DIR__.'/auth.php';  // Include authentication routes
