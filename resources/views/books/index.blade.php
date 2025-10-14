@extends('layout.app')

@section('content')
<h2>&#128218;Books List</h2>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add a Book</a>
</div>

<!-- Filter Form -->
<form method="GET" action="{{ route('books.index') }}" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <select name="category_id" class="form-control" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Added Date</th>
            <th>Last Updated</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name ?? 'N/A' }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->stock }}</td>
            <td>{{ $book->created_at }}</td>
            <td>{{ $book->updated_at }}</td>
            <td>@if($book->status == 0)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning w-100 mb-1">Edit</a>
                <form action="{{ route('books.disable', $book->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" onclick="return confirm('Disable this book?')" class="btn btn-sm btn-secondary w-100">
                        Disable
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection