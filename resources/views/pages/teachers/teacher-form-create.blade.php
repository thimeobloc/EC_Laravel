<form id="teacher-form" class="space-y-4" method="POST" action="{{ route('teachers.store') }}">
    @csrf
    <!-- Last name -->
    <x-forms.input label="Nom" name="last_name" value="{{ old('last_name') }}"/>

    <!-- First name -->
    <x-forms.input label="Prénom" name="first_name" value="{{ old('first_name') }}" class="mt-4"/>

    <!-- Birth date -->
    <x-forms.input label="Date de naissance" type="date" name="birth_date" value="{{ old('birth_date') }}" class="mt-4"/>

    <!-- Email -->
    <x-forms.input label="Email" type="email" name="email" value="{{ old('email') }}" class="mt-4"/>

    <!-- Button to save the new teacher -->
    <x-forms.primary-button type="submit" class="mt-4">
        Enregistrer
    </x-forms.primary-button>
</form>
