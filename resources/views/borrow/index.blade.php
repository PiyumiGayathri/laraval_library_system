@extends('layout.app')

@section('content')
<h2 class="mb-4">&#128214;Borrowed Books</h2>
<a href="{{ route('borrow.create') }}" class="btn btn-primary mb-4">+ Borrow a Book</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>User Name</th>
            <th>Book ID</th>
            <th>Book Name</th>
            <th>Borrowed Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrows as $b)
        <tr>
            <td>{{ $b->id }}</td>
            <td>{{ $b->users_id}}</td>
            <td>{{ $b->first_name }} {{ $b->last_name }}</td>
            <td>{{$b->books_id}}</td>
            <td>{{ $b->title }}</td>
            <td>{{ $b->borrowed_at }}</td>
            <td>{{ $b->returned_at }}</td>
            <td>
                @if ($b->status == 0)
                <span class="badge bg-secondary text-white">Pending</span>
                @else
                <span class="badge bg-info">Received</span>
                @endif
            </td>
            <td>
                @if ($b->status == 0)
                <form action="{{ route('borrow.markReceived', $b->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm w-100">
                        Mark Received
                    </button>
                </form>
                @else
                <button class="btn btn-success btn-sm w-100" disabled>Received</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection