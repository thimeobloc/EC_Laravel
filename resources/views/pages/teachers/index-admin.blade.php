<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Enseignants') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des enseignants</h3>
                        <!-- Search bar for teachers -->
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un enseignant" type="text"/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
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
                                                <span class="sort-label">Email</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">modifier</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Loop through teachers to display each teacher's details -->
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->last_name }}</td>
                                            <td>{{ $teacher->first_name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>
                                                <!-- Edit button for teacher -->
                                                <button type="button" class="btn btn-primary openModal" data-id="{{ $teacher->id }}">edit</button>
                                                <!-- Delete button for teacher with confirmation prompt -->
                                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Supprimer cet enseignant ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="flex items-center justify-between">
                                                    <a href="#"><i class="text-success ki-filled ki-shield-tick"></i></a>
                                                    <!-- Trigger for modal to view teacher details -->
                                                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#teacher-modal">
                                                        <i class="ki-filled ki-cursor"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination controls -->
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <!-- Dropdown to select how many entries to show per page -->
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

        <!-- Add Teacher Form -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un Enseignant</h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- Form to add a new teacher -->
                    <form method="POST" action="{{ route('teachers.store') }}" class="flex flex-col gap-4">
                        @csrf

                        <!-- Last Name Field -->
                        <div class="form-group">
                            <label for="last_name" class="form-label">Nom</label>
                            <input type="text" id="last_name" name="last_name" class="input input-sm w-full" placeholder="Dupont">
                        </div>

                        <!-- First Name Field -->
                        <div class="form-group">
                            <label for="first_name" class="form-label">Prénom</label>
                            <input type="text" id="first_name" name="first_name" class="input input-sm w-full" placeholder="Jean">
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="input input-sm w-full" placeholder="jean.dupont@example.com">
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password" class="input input-sm w-full" placeholder="********">
                        </div>

                        <!-- Submit Button to create a teacher -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-full">Créer l'enseignant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
