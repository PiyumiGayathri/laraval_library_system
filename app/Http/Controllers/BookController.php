<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use App\Models\Books;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $categories = BookCategory::all();

        $query = Books::with('category');

        //apply the filter if selected
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('book_category_id', $request->category_id);
        }

        $books = $query->get();

        return view('books.index', compact('books', 'categories'));
    }


    public function create()
    {
        $categories = BookCategory::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:book_category,id'
        ]);

        Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'stock' => $request->stock,
            'book_category_id' => $request->category_id,
            'status' => 0,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function edit($id)
    {
        $book = Books::findOrFail($id);
        $categories = BookCategory::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);
        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function disable($id)
    {
        $book = Books::findOrFail($id);
        $book->status = 1; // 1 = disabled
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book disabled successfully!');
    }
}
