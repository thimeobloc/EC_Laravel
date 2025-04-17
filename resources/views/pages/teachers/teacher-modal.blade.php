@extends('layouts.modal', [
    'id'    => 'teacher-modal',  // Modal ID
    'title' => 'Informations enseignant',  // Modal title (Teacher information)
])

@section('modal-content')
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Info</h5>  <!-- Modal header with title -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  <!-- Close button -->
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <!-- Form to display teacher's information -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" readonly>  <!-- First name input (read-only) -->
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" readonly>  <!-- Last name input (read-only) -->
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" readonly>  <!-- Email input (read-only) -->
                        </div>
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="birth_date" readonly>  <!-- Birth date input (read-only) -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  <!-- Close button for modal -->
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>  <!-- Save changes button -->
                </div>
            </div>
        </div>
    </div>
@endsection
