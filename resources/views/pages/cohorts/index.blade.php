<x-app-layout>
    <x-slot name="header">
        <!-- Title for the page -->
        <h1 class="text-xl font-semibold text-gray-800">
            {{ __('Promotions') }}
        </h1>
    </x-slot>

    <!-- Grid for displaying cohorts -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($cohorts as $cohort)
            <div class="bg-white shadow rounded-xl p-5 border border-gray-200">
                <!-- Displaying cohort's name -->
                <h2 class="text-lg font-semibold text-gray-900">{{ $cohort->name }}</h2>
                <!-- Displaying the cohort's description -->
                <p class="text-sm text-gray-600 mb-2">{{ $cohort->description }}</p>
                <!-- List of cohort details -->
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Année :</strong> {{ \Carbon\Carbon::parse($cohort->start_date)->year }} - {{ \Carbon\Carbon::parse($cohort->end_date)->year }}</li>
                    <li><strong>Étudiants :</strong> {{ $cohort->students()->count() }}</li>
                    <li><strong>Enseignants :</strong> {{ $cohort->teachers()->count() }}</li>
                </ul>
                <!-- Link to view more details about the cohort -->
                <a href="{{ route('cohorts.show', $cohort) }}" class="mt-3 inline-block text-sm text-primary hover:underline">Voir plus</a>
            </div>
        @endforeach
    </div>

<!--new cohort-->

    <div>
        <div class="bg-white shadow rounded-xl border border-gray-200">
            <div class="p-5 border-b border-gray-100">
                <!-- Title for the add cohort section -->
                <h3 class="text-lg font-semibold text-gray-900">Ajouter une promotion</h3>
            </div>
            <div class="p-5 flex flex-col gap-4">
                <!-- Form fields for adding a new cohort -->
                <x-forms.input name="name" :label="__('Nom')" />
                <x-forms.input name="description" :label="__('Description')" />
                <x-forms.input type="date" name="start_date" :label="__('Début de l\'année')" />
                <x-forms.input type="date" name="end_date" :label="__('Fin de l\'année')" />
                <!-- Submit button -->
                <x-forms.primary-button>
                    {{ __('Valider') }}
                </x-forms.primary-button>
            </div>
        </div>
    </div>
</x-app-layout>
