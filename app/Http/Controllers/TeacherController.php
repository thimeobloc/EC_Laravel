<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->school()->pivot->role;

        if ($userRole == 'admin') {
            return $this->adminIndex();
        }

        return redirect()->route('home');
    }

    private function adminIndex()
    {
        $teachers = User::whereIn('id', UserSchool::where('role', 'teacher')->pluck('user_id'))->get();

        return view('pages.teachers.index-admin', [
            'teachers' => $teachers,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'nullable|date',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
        ]);

        UserSchool::create([
            'user_id' => $user->id,
            'school_id' => auth()->user()->school()->id,
            'role' => 'teacher',
        ]);

        return redirect()->back()->with('success', 'Enseignant créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $teacher = User::findOrFail($id);

        $teacher->last_name = $request->last_name;
        $teacher->first_name = $request->first_name;
        $teacher->email = $request->email;

        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return redirect()->back()->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $teacher = User::findOrFail($id);

        UserSchool::where('user_id', $teacher->id)->delete();

        $teacher->delete();

        return redirect()->back()->with('success', 'Enseignant supprimé avec succès.');
    }
}
