@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title' => 'Informations étudiant',
])

@section('modal-content')
    <form id="student-form" class="space-y-4">
        <input type="hidden" id="student_id" name="student_id" />
        <div>
            <label class="form-label" for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Dupont">
        </div>

        <div>
            <label class="form-label" for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" class="form-input" placeholder="Jean">
        </div>

        <div>
            <label class="form-label" for="birth_date">Date de naissance</label>
            <input type="date" id="birth_date" name="birth_date" class="form-input">
        </div>

        <div>
            <label class="form-label" for="email">Adresse email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="jean.dupont@email.com">
        </div>
    </form>
@overwrite
