@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title' => 'Informations étudiant',
])

@section('modal-content')
    <form id="student-form" class="space-y-4">
        @csrf
        @method('put')
        <input type="hidden" id="student_id" name="student_id" />

        <!-- Champ Nom -->
        <div>
            <label class="form-label" for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" class="form-input" placeholder="">
            <div class="text-danger text-sm mt-1" id="error-last_name"></div>
        </div>

        <!-- Champ Prénom -->
        <div>
            <label class="form-label" for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" class="form-input" placeholder="">
            <div class="text-danger text-sm mt-1" id="error-first_name"></div>
        </div>

        <!-- Date de naissance -->
        <div>
            <label class="form-label" for="birth_date">Date de naissance</label>
            <input type="date" id="birth_date" name="birth_date" class="form-input">
            <div class="text-danger text-sm mt-1" id="error-birth_date"></div>
        </div>

        <!-- Email -->
        <div>
            <label class="form-label" for="email">Adresse email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="">
            <div class="text-danger text-sm mt-1" id="error-email"></div>
        </div>

        <!-- Bouton de mise à jour -->
        <div class="flex justify-end pt-4">
            <button type="button" id="update-student" class="btn btn-primary">
                Accepter les modifications
            </button>
        </div>
    </form>
@endsection
