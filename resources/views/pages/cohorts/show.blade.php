<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">{{ $cohort->name }}</span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <!-- Etudiants (Catégorie 1) -->
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Étudiants</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="30">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="max-w-[50px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cohort->students as $student) <!-- Afficher les étudiants -->
                                    <tr>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->first_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                        <td class="cursor-pointer pointer">
                                            <i class="ki-filled ki-trash"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enseignants (Catégorie 2) -->
                <div class="card card-grid h-full min-w-full mt-6">
                    <div class="card-header">
                        <h3 class="card-title">Enseignants</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="30">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="max-w-[50px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($teachers as $teacher) <!-- Afficher les enseignants -->
                                    <tr>
                                        <td>{{ $teacher->last_name }}</td>
                                        <td>{{ $teacher->first_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($teacher->birth_date)->format('d/m/Y') }}</td>
                                        <td class="cursor-pointer pointer">
                                            <i class="ki-filled ki-trash"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
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

        <!-- Ajout étudiant et enseignant dans le même bloc -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un étudiant ou un enseignant à la promotion
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- Ajouter un étudiant -->
                    <x-forms.dropdown name="user_id" :label="__('Etudiant')">
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->last_name }} {{ $student->first_name }}</option>
                        @endforeach
                    </x-forms.dropdown>

                    <!-- Ajouter un enseignant -->
                    <x-forms.dropdown name="teacher_id" :label="__('Enseignant')">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                        @endforeach
                    </x-forms.dropdown>

                    <x-forms.primary-button>
                        {{ __('Valider') }}
                    </x-forms.primary-button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4 mt-6">
        <h1 class="text-xl font-semibold">{{ $cohort->name }}</h1>
        <button id="deleteButton" class="bg-red-600 text-white py-2 px-6 rounded-lg border-2 border-red-600 hover:bg-red-700 transition duration-300 ease-in-out transform hover:scale-105">
            Supprimer la promotion
        </button>
    </div>
    <!-- end: grid -->
</x-app-layout>
