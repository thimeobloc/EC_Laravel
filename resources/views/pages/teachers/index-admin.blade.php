<x-app-layout>
    <!-- Header section -->
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Enseignants') }} <!-- Page title: Teachers -->
            </span>
        </h1>
    </x-slot>

    <!-- begin: main grid layout -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">

        <!-- Left column: teachers list -->
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">

                    <!-- Card header with title and search input -->
                    <div class="card-header">
                        <h3 class="card-title">Liste des enseignants</h3> <!-- Card title -->
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un enseignant" type="text"/> <!-- Search input -->
                        </div>
                    </div>

                    <!-- Card body: teacher table -->
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table id="teachers-table" class="table table-border table-with-modal" data-datatable-table="true">

                                    <!-- Table headers -->
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
                                                <span class="sort-label">Email</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th> <!-- Actions -->
                                    </tr>
                                    </thead>

                                    <!-- Table body -->
                                    <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->last_name ?? 'Information manquante' }}</td>
                                            <td>{{ $teacher->first_name ?? 'Information manquante' }}</td>
                                            <td>{{ $teacher->email ?? 'Information manquante' }}</td>
                                            <td>
                                                <div class="flex items-center justify-between gap-2">
                                                    <a href="#">
                                                        <i class="text-success ki-filled ki-shield-tick"></i> <!-- Status icon -->
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-primary"
                                                       data-route="{{ route('teacher.form.get', $teacher) }}"
                                                       data-modal="#teacher-modal">
                                                        Modifier
                                                    </a>
                                                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Supprimer cet enseignant ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger bg-transparent border-0 cursor-pointer">
                                                            <i class="ki-filled ki-trash"></i>
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

        <!-- Right column: teacher creation form -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un enseignant
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    @include('pages.teachers.teacher-form-create', ['teacherRoute' => '', 'user' => false])
                </div>
            </div>
        </div>
    </div>
    <!-- end: main grid layout -->
</x-app-layout>

<!-- Include modal for teacher form -->
@include('pages.teachers.teacher-modal')
