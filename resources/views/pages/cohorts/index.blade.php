<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">
            {{ __('promotions') }}
        </h1>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($cohorts as $cohort)
            <div class="bg-white shadow rounded-xl p-5 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">{{ $cohort->name }}</h2>
                <p class="text-sm text-gray-600 mb-2">{{ $cohort->description }}</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Ecole: </strong>{{ $cohort->school->name }}</p>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Année</strong> {{ \Carbon\Carbon::parse($cohort->start_date)->year }} - {{ \Carbon\Carbon::parse($cohort->end_date)->year }}</li>
                    <li><strong>Etudiant:</strong> {{ $cohort->students()->count() }}</li>
                    <li><strong>professeur:</strong> {{ $cohort->teachers()->count() }}</li>
                </ul>
                <a href="{{ route('cohorts.show', $cohort) }}" class="mt-3 inline-block text-sm text-primary hover:underline">voir plus</a>

                <form action="{{ route('cohorts.destroy', $cohort) }}" method="POST" class="mt-3 inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Supprimer</button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-900">Ajouter des promotions</h2>
        <form action="{{ route('cohorts.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">nom</label>
                <input type="text" id="name" name="name" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                <textarea id="description" name="description" class="block w-full mt-1 p-2 border border-gray-300 rounded" required></textarea>
            </div>

            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700">date de debut</label>
                <input type="date" id="start_date" name="start_date" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700">date de fin</label>
                <input type="date" id="end_date" name="end_date" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label for="school_id" class="block text-sm font-semibold text-gray-700">ecole</label>
                <select id="school_id" name="school_id" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">ajouter</button>
            </div>
        </form>
    </div>
</x-app-layout>
