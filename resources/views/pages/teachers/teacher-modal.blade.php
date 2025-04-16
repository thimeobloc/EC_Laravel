@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title' => 'Informations enseignant',
])

@section('modal-content')
    <form id="teacher-form">
        <input type="hidden" id="teacher_id">
        <div class="mb-4">
            <label for="teacher_first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
            <input type="text" id="teacher_first_name" class="form-input mt-1 block w-full" required>
        </div>
        <div class="mb-4">
            <label for="teacher_last_name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" id="teacher_last_name" class="form-input mt-1 block w-full" required>
        </div>
        <div class="mb-4">
            <label for="teacher_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="teacher_email" class="form-input mt-1 block w-full" required>
        </div>
        <div class="mb-4">
            <label for="teacher_birth_date" class="block text-sm font-medium text-gray-700">Date de naissance</label>
            <input type="date" id="teacher_birth_date" class="form-input mt-1 block w-full" required>
        </div>
    </form>
    <div class="flex justify-end">
        <button id="update-teacher" class="btn btn-primary">Mettre à jour</button>
    </div>
@overwrite
