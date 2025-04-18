<x-app-layout>
    <!-- Header section -->
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Etudiants') }} <!-- Page title: Students -->
            </span>
        </h1>
    </x-slot>

    <!-- begin: main grid layout -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">

        <!-- Left column: students list -->
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">

                    <!-- Card header with title and search input -->
                    <div class="card-header">
                        <h3 class="card-title">Liste des étudiants</h3> <!-- Card title: List of students -->
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un étudiant" type="text"/> <!-- Search input -->
                        </div>
                    </div>

                    <!-- Card body: student table -->
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table id="students-table" class="table table-border table-with-modal" data-datatable-table="true">

                                    <!-- Table headers -->
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span> <!-- Last name column -->
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span> <!-- First name column -->
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span> <!-- Birth date column -->
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th> <!-- Action buttons column -->
                                    </tr>
                                    </thead>

                                    <!-- Table body -->
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->first_name ?? 'Information manquante'}}</td> <!-- Display first name or fallback -->
                                            <td>{{ $student->last_name ?? 'Information manquante'}}</td> <!-- Display last name or fallback -->
                                            <td>{{ $student->birth_date ?? 'Information manquante'}}</td> <!-- Display birth date or fallback -->
                                            <td>
                                                <!-- Action buttons: status, edit, delete -->
                                                <div class="flex items-center justify-between gap-2">
                                                    <a href="#">
                                                        <i class="text-success ki-filled ki-shield-tick"></i> <!-- Status icon -->
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-primary" data-route="{{ route('student.form.get', $student) }}" data-modal="#student-modal">
                                                        Modifier <!-- Edit student button -->
                                                    </a>
                                                    <form action="{{ route('student.delete', $student->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger bg-transparent border-0 cursor-pointer">
                                                            <i class="ki-filled ki-trash"></i> <!-- Delete icon -->
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination and page size control -->
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show <!-- Label: show items per page -->
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page <!-- Label: items per page -->
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span> <!-- Pagination info -->
                                    <div class="pagination" data-datatable-pagination="true"></div> <!-- Pagination controls -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right column: student creation form -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un étudiant <!-- Card title: Add a student -->
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- Include student creation form -->
                    @include('pages.students.student-form-create', ['studentRoute' => '', 'user' => false])
                </div>
            </div>
        </div>
    </div>
    <!-- end: main grid layout -->
</x-app-layout>

<!-- Include modal for student form -->
@include('pages.students.student-modal')
