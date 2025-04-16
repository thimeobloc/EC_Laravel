@extends('layouts.modal', [
    'id'    => 'student-modal', // Modal ID
    'title' => 'Informations étudiant', // Title of the modal in French
])

@section('modal-content')
    <form id="student-form" class="space-y-4"> <!-- Form with spacing between fields -->
        @csrf <!-- CSRF token to protect against cross-site request forgery -->
        @method('put') <!-- HTTP method PUT to indicate the form is for updating -->
        <input type="hidden" id="student_id" name="student_id" /> <!-- Hidden input to store the student ID -->

        <!-- last name -->
        <div>
            <label class="form-label" for="last_name">Nom</label> <!-- Label for last name in French -->
            <input type="text" id="last_name" name="last_name" class="form-input" placeholder=""> <!-- Input for the last name -->
            <div class="text-danger text-sm mt-1" id="error-last_name"></div> <!-- Error message for last name if any -->
        </div>

        <!-- first name -->
        <div>
            <label class="form-label" for="first_name">Prénom</label> <!-- Label for first name in French -->
            <input type="text" id="first_name" name="first_name" class="form-input" placeholder=""> <!-- Input for the first name -->
            <div class="text-danger text-sm mt-1" id="error-first_name"></div> <!-- Error message for first name if any -->
        </div>

        <!-- birth date -->
        <div>
            <label class="form-label" for="birth_date">Date de naissance</label> <!-- Label for birth date in French -->
            <input type="date" id="birth_date" name="birth_date" class="form-input"> <!-- Input for the birth date -->
            <div class="text-danger text-sm mt-1" id="error-birth_date"></div> <!-- Error message for birth date if any -->
        </div>

        <!-- Email -->
        <div>
            <label class="form-label" for="email">Adresse email</label> <!-- Label for email in French -->
            <input type="email" id="email" name="email" class="form-input" placeholder=""> <!-- Input for the email -->
            <div class="text-danger text-sm mt-1" id="error-email"></div> <!-- Error message for email if any -->
        </div>

        <!-- button update -->
        <div class="flex justify-end pt-4">
            <button type="button" id="update-student" class="btn btn-primary">
                Accepter les modifications <!-- Button text in French to accept changes -->
            </button>
        </div>
    </form>
@endsection
