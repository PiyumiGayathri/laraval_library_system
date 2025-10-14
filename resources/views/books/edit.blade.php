@extends('layout.app')

@section('content')
<h2>Edit Book</h2>

<form method="POST" action="{{ route('books.update', $book->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Author</label>
        <input type="text" name="author" value="{{ $book->author }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Stock</label>
        <input type="text" name="stock" value="{{ $book->stock }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection