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
                <!-- Students (Category 1) -->
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Etudiant</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="30">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">prenom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">nom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">date anniversaire</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="max-w-[50px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Loop through the students in the cohort -->
                                    @foreach ($cohort->students as $student)
                                        <tr>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                            <td class="cursor-pointer pointer">
                                                <!-- Form to remove a student from the cohort -->
                                                <form action="{{route('cohort.removeUser')}}" method="POST" onsubmit="return confirm('Are you sure you want to remove this user from the cohort?');">
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

                <!-- Teachers (Category 2) -->
                <div class="card card-grid h-full min-w-full mt-6">
                    <div class="card-header">
                        <h3 class="card-title">profeseur</h3>
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
                                                <span class="sort-label">Prenom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">date anniversaire</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="max-w-[50px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Loop through the teachers in the cohort -->
                                    @foreach ($cohort->teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->last_name }}</td>
                                            <td>{{ $teacher->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($teacher->birth_date)->format('d/m/Y') }}</td>
                                            <td class="cursor-pointer pointer">
                                                <!-- Form to remove a teacher from the cohort -->
                                                <form action="{{route('cohort.removeUser')}}" method="POST" onsubmit="return confirm('Are you sure you want to remove this user from the cohort?');">
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

        <!-- Add Student and Teacher in the Same Block -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter des membres a la promotion
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- Form to add a student or teacher to the cohort -->
                    <!-- Form to add a student or teacher to the cohort -->
                    <form action="{{ route('cohorts.addUser', $cohort) }}" method="POST">
                        @csrf
                        <!-- Dropdown to add a student -->
                        <x-forms.dropdown name="user_id" :label="__('Etudiant')">
                            <option value="">{{ __('None') }}</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->last_name }} {{ $student->first_name }}</option>
                            @endforeach
                        </x-forms.dropdown>

                        <!-- Dropdown to add a teacher -->
                        <x-forms.dropdown name="teacher_id" :label="__('Professeur')">
                            <option value="">{{ __('None') }}</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                            @endforeach
                        </x-forms.dropdown>

                        <!-- Submit Button -->
                        <x-forms.primary-button>
                            {{ __('Ajouter') }}
                        </x-forms.primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
