<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Etudiants') }} <!-- Students (French title) -->
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des étudiants</h3> <!-- List of students (French title) -->
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un étudiant" type="text"/> <!-- Search for a student (French placeholder) -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table id="students-table" class="table table-border table-with-modal" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span> <!-- Last name (French) -->
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span> <!-- First name (French) -->
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span> <!-- Birthdate (French) -->
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Promotion</span> <!-- Cohort (French) -->
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->first_name ?? 'Information manquante'}}</td> <!-- First name, fallback if missing -->
                                            <td>{{ $student->last_name ?? 'Information manquante'}}</td> <!-- Last name, fallback if missing -->
                                            <td>{{ $student->end_date ?? 'Information manquante'}}</td> <!-- Birthdate, fallback if missing -->
                                            <td>{{ $student->cohorts->first()?->name ?? 'Aucune promotion' }}</td> <!-- Cohort name, fallback if missing -->
                                            <td>
                                                <div class="flex items-center justify-between gap-2">
                                                    <a href="#">
                                                        <i class="text-success ki-filled ki-shield-tick"></i> <!-- Icon for status (success) -->
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-primary" data-route="{{ route('student.form.get', $student) }}"
                                                       data-modal="#student-modal"
                                                       onclick="handleClick(event, this)">
                                                        Modifier <!-- Edit button (French) -->
                                                    </a>
                                                    <script src="{{ asset('resources/js/custom/modal.js') }}"></script> <!-- Modal JavaScript -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show <!-- Show (English) -->
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page <!-- Items per page (English) -->
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un étudiant <!-- Add a student (French) -->
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    Formulaire à créer <!-- Form to be created (French) -->
                    <!-- @todo A compléter -->
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>

@include('pages.students.student-modal')
