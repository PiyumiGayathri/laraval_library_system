<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Books;
use Illuminate\Routing\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::with('category')->get(); 
        return view('books.index', compact('books'));
    }
}