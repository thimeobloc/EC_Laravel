<form id="student-form" class="space-y-4" method="POST" action="{{ route('students.store') }}">
    @csrf
    <!-- last name -->
    <x-forms.input label="Nom" name="last_name" value="{{ old('last_name') }}"/>

    <!-- first name -->
    <x-forms.input label="Prénom" name="first_name" value="{{ old('first_name') }}" class="mt-4"/>

    <!-- birth date -->
    <x-forms.input label="Date de naissance" type="date" name="birth_date" value="{{ old('birth_date') }}" class="mt-4"/>

    <!-- Email -->
    <x-forms.input label="Email" type="email" name="email" value="{{ old('email') }}" class="mt-4"/>

    <!-- button update -->
    <x-forms.primary-button type="submit" class="mt-4">
        Enregistrer
    </x-forms.primary-button>
</form>
