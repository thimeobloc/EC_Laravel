<form id="student-form" class="space-y-4" method="post" action="{{ $teacherRoute }}">
    @csrf <!-- CSRF token to protect against cross-site request forgery -->

    <!-- last name -->
    <x-forms.input label="Nom" name="last_name" value="{{ $user ? $user->last_name : '' }}"/>

    <!-- first name -->
    <x-forms.input label="Prénom" name="first_name" value="{{ $user ? $user->first_name : '' }}" class="mt-4"/>

    <!-- birth date -->
    <x-forms.input label="Date de naissance" type="date" name="birth_date" value="{{ $user ? $user->birth_date : '' }}" class="mt-4"/>

    <!-- Email -->
    <x-forms.input label="Email" type="email" name="email" value="{{ $user ? $user->email : '' }}" class="mt-4"/>

    <!-- School -->

    <!-- button update -->
    <x-forms.primary-button type="submit" class="mt-4">
        Enregistrer
    </x-forms.primary-button>
</form>
