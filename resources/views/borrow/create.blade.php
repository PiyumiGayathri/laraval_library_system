@extends('layout.app')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@section('content')
<h2 class="mb-4">&#128199;Borrow a Book</h2>

<!-- Search Form -->
<form method="GET" action="{{ route('borrow.create') }}" class="mb-3">
    <div class="row g-2">
        <div class="col-md-3">
            <label>User ID</label>
            <input type="number" name="user_id" class="form-control" value="{{ request('user_id') }}">
        </div>
        <div class="col-md-3">
            <label>Book ID</label>
            <input type="number" name="book_id" class="form-control" value="{{ request('book_id') }}">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary form-control">Search</button>
        </div>
    </div>
</form>

<!-- Borrow Form -->
<form method="POST" action="{{ route('borrow.store') }}">
    @csrf

    <!-- User Details Row -->
    <h5 class="mb-3 mt-5">User Details</h5>
    <div class="row mb-3">
        <div class="col-md-3">
            <label>User NIC</label>
            <input type="text" class="form-control" value="{{ $user->nic ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label>First Name</label>
            <input type="text" class="form-control" value="{{ $user->first_name ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label>Last Name</label>
            <input type="text" class="form-control" value="{{ $user->last_name ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label>Mobile</label>
            <input type="text" class="form-control" value="{{ $user->mobile ?? '' }}" readonly>
        </div>
    </div>

    <input type="hidden" name="users_id" value="{{ $user->id ?? '' }}">

    <!-- Book Details Row -->
    <h5 class="mb-3 mt-5">Book Details</h5>
    <div class="row mb-5">
        <div class="col-md-3">
            <label>Title</label>
            <input type="text" class="form-control" value="{{ $book->title ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label>Author</label>
            <input type="text" class="form-control" value="{{ $book->author ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label>Stock</label>
            <input type="text" class="form-control" value="{{ $book->stock ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label>Status</label>
            <input type="text" class="form-control" 
                   value="{{ isset($book->status) ? ($book->status == 0 ? 'Active' : 'Disabled') : '' }}" readonly>
        </div>
    </div>

    <input type="hidden" name="books_id" value="{{ $book->id ?? '' }}">

    <!-- Return Date -->
    <div class="col-md-4 mb-5">
        <label>Return Date</label>
        <input type="date" name="returned_at" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success w-25" {{ (!$user || !$book) ? 'disabled' : '' }}>Save</button>
</form>
@endsection
