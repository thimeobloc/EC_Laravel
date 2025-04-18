<x-app-layout>
    <!-- Header section for the page, displaying the title 'Promotions' -->
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">
            {{ __('promotions') }}
        </h1>
    </x-slot>

    <!-- Main grid layout to display the cohorts in two columns on medium screens and above -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Loop through each cohort and display its details -->
        @foreach($cohorts as $cohort)
            <!-- Card displaying the cohort's information -->
            <div class="bg-white shadow rounded-xl p-5 border border-gray-200">
                <!-- Display the cohort's name -->
                <h2 class="text-lg font-semibold text-gray-900">{{ $cohort->name }}</h2>
                <!-- Display the cohort's description -->
                <p class="text-sm text-gray-600 mb-2">{{ $cohort->description }}</p>
                <!-- Display the school name associated with the cohort -->
                <p class="text-sm text-gray-700 mb-2"><strong>Ecole: </strong>{{ $cohort->school->name }}</p>
                <!-- List of additional cohort information like year, student count, and teacher count -->
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Année</strong> {{ \Carbon\Carbon::parse($cohort->start_date)->year }} - {{ \Carbon\Carbon::parse($cohort->end_date)->year }}</li>
                    <li><strong>Etudiant:</strong> {{ $cohort->students()->count() }}</li>
                    <li><strong>professeur:</strong> {{ $cohort->teachers()->count() }}</li>
                </ul>
                <!-- Link to view more details about the cohort -->
                <a href="{{ route('cohort.show', $cohort) }}" class="mt-3 inline-block text-sm text-primary hover:underline">voir plus</a>

                <!-- Form to delete a cohort -->
                <form action="{{ route('cohorts.destroy', $cohort) }}" method="POST" class="mt-3 inline-block">
                    @csrf
                    @method('DELETE')
                    <!-- Delete button with a red color to indicate removal -->
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Supprimer</button>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Section for adding a new cohort -->
    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-900">Ajouter des promotions</h2>
        <!-- Form for creating a new cohort -->
        <form action="{{ route('cohorts.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Input field for the cohort's name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">nom</label>
                <input type="text" id="name" name="name" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Input field for the cohort's description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                <textarea id="description" name="description" class="block w-full mt-1 p-2 border border-gray-300 rounded" required></textarea>
            </div>

            <!-- Input field for the cohort's start date -->
            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700">date de debut</label>
                <input type="date" id="start_date" name="start_date" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Input field for the cohort's end date -->
            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700">date de fin</label>
                <input type="date" id="end_date" name="end_date" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Dropdown to select the associated school for the cohort -->
            <div>
                <label for="school_id" class="block text-sm font-semibold text-gray-700">ecole</label>
                <select id="school_id" name="school_id" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
                    <!-- Loop through all available schools and display them in the dropdown -->
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit button to add the new cohort -->
            <div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">ajouter</button>
            </div>
        </form>
    </div>
</x-app-layout>
