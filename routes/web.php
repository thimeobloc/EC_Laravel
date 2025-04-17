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

    // Profile routes (edit, update, destroy)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  // Display the profile edit form
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');  // Update the profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');  // Delete the profile

    Route::middleware('verified')->group(function () {  // Ensure the user's email is verified

        // Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohort routes (view, create, delete, add/remove users)
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');
        Route::get('/cohorts/{cohort}', [CohortController::class, 'show'])->name('cohorts.show');
        Route::get('/cohorts/create', [CohortController::class, 'create'])->name('cohorts.create');
        Route::post('/cohorts', [CohortController::class, 'store'])->name('cohorts.store');
        Route::delete('/cohorts/{cohort}', [CohortController::class, 'destroy'])->name('cohorts.destroy');
        Route::post('/cohort-removeUser', [CohortController::class, 'removeUserFromCohort'])->name('cohort.removeUser');
        Route::post('/cohorts/{cohort}/add-user', [CohortController::class, 'addUserToCohort'])->name('cohorts.addUser');

        // Teacher routes (view, store, delete)
        Route::get('/teacher',[TeacherController::class, 'index'])->name('teachers');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        // Student routes (view student list, get form for individual student)
        Route::get('students', [StudentController::class, 'index'])->name('student.index');
        Route::get('student/form/{user}', [StudentController::class, 'getForm'])->name('student.form.get');

        // Knowledge routes (view knowledge base)
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');

        // Group routes (view group list)
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');

        // Retro routes (view retrospectives)
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');

        // Common life routes (view common life info)
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');

        // Resources for various pages (cohorts, students, teachers, groups)
        Route::get('resources/pages/cohorts/index', [CohortController::class, 'index'])->name('cohorts.index');
        Route::get('resources/pages/students/index', [StudentController::class, 'index'])->name('students.index');
        Route::get('resources/pages/teachers/index', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('resources/pages/groups/index', [GroupController::class, 'index'])->name('groups.index');

    });

});

require __DIR__.'/auth.php';  // Include authentication routes
