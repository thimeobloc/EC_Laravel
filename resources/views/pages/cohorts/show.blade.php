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
                                    @foreach ($cohort->students as $student)
                                        <tr>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                            <td class="cursor-pointer pointer">
                                                <form action="{{route('cohort.removeUser')}}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur de la promotion ?');">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$student->id}}">
                                                    <input type="hidden" name="cohort_id" value="{{$cohort->id}}">
                                                    <button type="submit">
                                                        <i class="ki-filled ki-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
                                    @foreach ($cohort->teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->last_name }}</td>
                                            <td>{{ $teacher->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($teacher->birth_date)->format('d/m/Y') }}</td>
                                            <td class="cursor-pointer pointer">
                                                <form action="{{route('cohort.removeUser')}}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur de la promotion ?');">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$teacher->id}}">
                                                    <input type="hidden" name="cohort_id" value="{{$cohort->id}}">
                                                    <button type="submit">
                                                        <i class="ki-filled ki-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
                    <form action="{{ route('cohorts.addUser', $cohort) }}" method="POST">
                        @csrf
                        <!-- Ajouter un étudiant -->
                        <x-forms.dropdown name="user_id" :label="__('Etudiant')">
                            <option value="">{{ __('Aucun') }}</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->last_name }} {{ $student->first_name }}</option>
                            @endforeach
                        </x-forms.dropdown>

                        <!-- Ajouter un enseignant -->
                        <x-forms.dropdown name="teacher_id" :label="__('Enseignant')">
                            <option value="">{{ __('Aucun') }}</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                            @endforeach
                        </x-forms.dropdown>

                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
