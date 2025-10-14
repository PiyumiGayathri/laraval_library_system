@extends('layout.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Add New User</a>
</div>

<h2 class="mb-4">&#128100;Registered Users</h2>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>NIC</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date Registered</th>
            <th>Mobile</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->nic }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->registered_at }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection