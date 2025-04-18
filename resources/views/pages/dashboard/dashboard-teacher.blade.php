<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Tableau de bord Enseignant') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-2 gap-6 items-start">

        <!-- Bloc cohorts -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <!-- Title of the promotions section -->
                <h3 class="card-title">Promotions ({{ $cohortsCount }})</h3>
                <!-- Link to manage cohorts -->
                <a href="{{ route('cohorts.index') }}" class="btn btn-sm btn-primary">Gérer</a>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Dernières promotions :</p>

                <div class="space-y-3">
                    @isset($cohorts)
                        @foreach ($cohorts as $cohort)
                            <!-- Display each cohort -->
                            <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                                <div>{{ $cohort->name }} — {{ $cohort->start_date }} — {{ $cohort->end_date }}</div>
                            </div>
                        @endforeach
                    @endisset
                </div>

                <!-- Link to view more cohorts -->
                <div class="pt-2 text-right">
                    <a href="{{ route('cohorts.index') }}" class="btn btn-sm btn-outline">Voir plus</a>
                </div>
            </div>
        </div>

        <!-- Bloc students -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <!-- Title of the students section -->
                <h3 class="card-title">Étudiants ({{ $studentsCount }})</h3>
                <!-- Link to manage students -->
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary">Gérer</a>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Derniers étudiants ajoutés :</p>

                <div class="space-y-3">
                    @isset($students)
                        @foreach($students as $student)
                            <!-- Display each student's name and email -->
                            <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                                <div class="font-semibold">{{ $student->last_name}} {{ $student->first_name }}</div>
                                <div class="text-sm text-gray-600">Promo : {{ $student->email }}</div>
                            </div>
                        @endforeach
                    @endisset
                </div>

                <!-- Link to view more students -->
                <div class="pt-2 text-right">
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline">Voir plus</a>
                </div>
            </div>
        </div>

        <!-- Bloc groups -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <!-- Title of the groups section -->
                <h3 class="card-title">Groupes (3)</h3>
                <!-- Link to manage groups -->
                <a href="{{ route('groups.index') }}" class="btn btn-sm btn-primary">Gérer</a>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Derniers groupes créés :</p>

                <div class="space-y-3">
                    <!-- Display sample groups -->
                    @foreach([['nom' => 'Groupe A - B1 Dev', 'count' => 15], ['nom' => 'Groupe B - B2 Cybersécurité', 'count' => 13], ['nom' => 'Groupe C - B3 Dev Web', 'count' => 18]] as $groupe)
                        <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                            <div class="font-semibold">{{ $groupe['nom'] }}</div>
                            <div class="text-sm text-gray-600">{{ $groupe['count'] }} étudiants</div>
                        </div>
                    @endforeach
                </div>

                <!-- Link to view more groups -->
                <div class="pt-2 text-right">
                    <a href="{{ route('groups.index') }}" class="btn btn-sm btn-outline">Voir plus</a>
                </div>
            </div>
        </div>

    </div>
    <!-- end: grid -->
</x-app-layout>
