<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Tableau de bord') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-2 gap-6 items-start">

        <!-- bloc cohort -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Promotions ({{ $cohortsCount }})</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Dernières promotions ajoutées :</p>

                <div class="space-y-3">
                    <!-- Display the list of promotions -->
                    @isset($cohorts)
                        @foreach ($cohorts as $cohort)
                            <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                                <div>{{ $cohort->name }} — {{ $cohort->start_date }} — {{ $cohort->end_date }}</div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <!-- Bloc students-->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Étudiants ({{ $studentsCount }})</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Derniers étudiants ajoutés :</p>

                <div class="space-y-3">
                    <!-- Display the list of students -->
                    @isset($students)
                        @foreach($students as $student)
                            <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                                <div class="font-semibold">{{ $student->last_name}} {{ $student->first_name }}</div>
                                <div class="text-sm text-gray-600">Promo : {{ $student->email }}</div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <!-- Bloc teachers -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Enseignants ({{ $teachersCount }})</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Derniers enseignants ajoutés :</p>

                <div class="space-y-3">
                    <!-- Display the list of teachers -->
                    @isset($teachers)
                        @foreach($teachers as $teacher)
                            <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                                <div class="font-semibold">{{ $teacher->last_name }} {{ $teacher->first_name }}</div>
                                <div class="text-sm text-gray-600">Email : {{ $teacher->email }}</div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <!-- Bloc Group -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Groupes (3)</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Derniers groupes créés :</p>

                <div class="space-y-3">
                    <!-- Display the list of groups -->
                    @foreach([['nom' => 'Groupe A - B1 Dev', 'count' => 15], ['nom' => 'Groupe B - B2 Cybersécurité', 'count' => 13], ['nom' => 'Groupe C - B3 Dev Web', 'count' => 18]] as $groupe)
                        <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                            <div class="font-semibold">{{ $groupe['nom'] }}</div>
                            <div class="text-sm text-gray-600">{{ $groupe['count'] }} étudiants</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- end: grid -->
</x-app-layout>
