@extends('layouts.admin-layout')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <strong>User Management</strong> <small>List of all users</small>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User Type</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="align-middle">
                        <th scope="row">{{ $user->id }}</th>
                        <td>
                            @if($user->user_type == 1)
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->user_type == 2)
                                <span class="badge bg-info">HR</span>
                            @else
                                <span class="badge bg-success">Employee</span>
                            @endif
                        </td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-sm btn-primary text-white d-inline-flex align-items-center justify-content-center gap-2" style="padding-block: 6px;">
                                    <i class="cil-pencil text-white"></i>
                                    <span style="line-height: 1;">Edit</span>
                                </a>
                                <form action="#" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-wrap text-white d-inline-flex align-items-center justify-content-center gap-2" style="padding-block: 6px;">
                                        <i class="cil-trash text-white"></i>
                                        <span style="line-height: 1;">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection