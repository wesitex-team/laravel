@extends('layouts.admin-layout')

@section('content')
<div class="card mb-4" style="background: transparent; border: none;">
    <div class="card-header d-flex justify-content-between align-items-center" style="background: transparent; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
        <div>
            <strong style="color: black; text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);">User Management</strong> 
            <small style="color: black;">List of all users</small>
        </div>
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-coreui-toggle="modal" data-coreui-target="#addUserModal" style="box-shadow: 0 0 10px rgba(50, 31, 219, 0.5); border: none;">
            <i class="cil-plus"></i> Add User
        </button>
    </div>
    <div class="card-body p-0 pt-3">
        <div class="table-responsive rounded-3" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
            <table class="table table-borderless table-striped mb-0 text-black">
                <thead style="background: rgba(255, 255, 255, 0.1);">
                    <tr>
                        <th scope="col" class="text-black-50 ps-3">ID</th>
                        <th scope="col" class="text-black-50">User Type</th>
                        <th scope="col" class="text-black-50">First Name</th>
                        <th scope="col" class="text-black-50">Last Name</th>
                        <th scope="col" class="text-black-50">Email</th>
                        <th scope="col" class="text-black-50 pe-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="align-middle" style="transition: background 0.3s;">
                        <th scope="row" class="ps-3 text-black">{{ $user->id }}</th>
                        <td>
                            @if($user->user_type == 1)
                                <span class="badge bg-danger shadow-sm">Admin</span>
                            @elseif($user->user_type == 2)
                                <span class="badge bg-info shadow-sm text-white">HR</span>
                            @else
                                <span class="badge bg-success shadow-sm">Employee</span>
                            @endif
                        </td>
                        <td class="text-black">{{ $user->first_name }}</td>
                        <td class="text-black">{{ $user->last_name }}</td>
                        <td class="text-black">{{ $user->email }}</td>
                        <td class="pe-3 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-sm btn-primary text-white d-inline-flex align-items-center justify-content-center gap-2 edit-user-btn" 
                                    data-id="{{ $user->id }}" 
                                    style="padding-block: 6px; box-shadow: 0 0 8px rgba(50, 31, 219, 0.4); border: none;">
                                    <i class="cil-pencil text-white"></i>
                                    <span style="line-height: 1;">Edit</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger text-white d-inline-flex align-items-center justify-content-center gap-2 delete-user-btn" 
                                    data-id="{{ $user->id }}" 
                                    style="padding-block: 6px; box-shadow: 0 0 8px rgba(229, 83, 83, 0.4); border: none;">
                                    <i class="cil-trash text-white"></i>
                                    <span style="line-height: 1;">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Futuristic Modal Styles -->
<style>
    .futuristic-modal .modal-content {
        background: rgba(30, 30, 40, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        color: #fff;
    }
    .futuristic-modal .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .futuristic-modal .modal-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .futuristic-modal .form-control {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
    }
    .futuristic-modal .form-control:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #321fdb;
        box-shadow: 0 0 0 0.25rem rgba(50, 31, 219, 0.25);
        color: #fff;
    }
    .futuristic-modal .form-select {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
    }
    .futuristic-modal .form-select option {
        background-color: #2c2c36;
        color: #fff;
    }
    .futuristic-modal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
</style>

<!-- Add User Modal -->
<div class="modal fade futuristic-modal" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">
                    <i class="cil-user-plus me-2 text-primary"></i> Add New User
                </h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                    </div>
                    <div class="mb-3">
                        <label for="userType" class="form-label">Role</label>
                        <select class="form-select" id="userType" name="user_type" required>
                            <option value="1">Admin</option>
                            <option value="2">HR</option>
                            <option value="0">Employee</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="box-shadow: 0 0 10px rgba(50, 31, 219, 0.5);">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade futuristic-modal" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">
                    <i class="cil-pencil me-2 text-info"></i> Edit User
                </h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm">
                @method('PUT')
                <input type="hidden" id="editUserId" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password <small class="text-white-50">(Leave blank to keep current)</small></label>
                        <input type="password" class="form-control" id="editPassword" name="password" autocomplete="new-password">
                    </div>
                    <div class="mb-3">
                        <label for="editUserType" class="form-label">Role</label>
                        <select class="form-select" id="editUserType" name="user_type" required>
                            <option value="1">Admin</option>
                            <option value="2">HR</option>
                            <option value="0">Employee</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info text-white" style="box-shadow: 0 0 10px rgba(57, 175, 247, 0.5);">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade futuristic-modal" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">
                    <i class="cil-trash me-2 text-danger"></i> Delete User
                </h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                <input type="hidden" id="deleteUserId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger text-white" id="confirmDeleteBtn" style="box-shadow: 0 0 10px rgba(229, 83, 83, 0.5);">Delete User</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin-users/admin-users-actions/admin-add-user.js') }}"></script>
<script src="{{ asset('js/admin-users/admin-users-actions/admin-edit-user.js') }}"></script>
<script src="{{ asset('js/admin-users/admin-users-actions/admin-delete-user.js') }}"></script>
<script>
    // Include route definitions for JS files
    const routes = {
        store: "{{ route('admin.users.store') }}",
        edit: "{{ route('admin.users.edit', ':id') }}",
        update: "{{ route('admin.users.update', ':id') }}",
        destroy: "{{ route('admin.users.destroy', ':id') }}"
    };
    const csrfToken = "{{ csrf_token() }}";
</script>
@endpush
@endsection