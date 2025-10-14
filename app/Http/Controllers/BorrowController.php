<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Books;
use App\Models\Borrows;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = \Illuminate\Support\Facades\DB::table('borrows')
            ->join('books', 'borrows.books_id', '=', 'books.id')
            ->join('users', 'borrows.users_id', '=', 'users.id')
            ->select('borrows.*', 'books.title', 'users.first_name', 'users.last_name')
            ->get();


        return view('borrow.index', compact('borrows'));
    }

    public function create(Request $request)
    {
        $user = null;
        $book = null;

        if ($request->filled('user_id')) {
            $user = Users::find($request->user_id);
        }

        if ($request->filled('book_id')) {
            $book = Books::find($request->book_id);
        }

        return view('borrow.create', compact('user', 'book'));
    }

    public function store(Request $request)
    {
        $book = Books::find($request->books_id);

        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        // Check ifbook disabled
        if ($book->status == 1) {
            return redirect()->back()->with('error', 'This book is currently disabled. Users cannot borrow it.');
        }

        // Check if stock available
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'This book is out of stock and cannot be borrowed.');
        }

        \Illuminate\Support\Facades\DB::table('borrows')->insert([
            'users_id' => $request->users_id,
            'books_id' => $request->books_id,
            'borrowed_at' => now(),
            'returned_at' => $request->returned_at,
            'status' => 0 // 0 = Pending
        ]);

        // Decrease book stock by 1
        $book->stock = $book->stock - 1;
        $book->save();

        return redirect()->route('borrow.index')->with('success', 'Book borrowed successfully and stock updated.');
    }



    public function markReceived($id)
    {
        $borrow = Borrows::find($id);

        if (!$borrow) {
            return redirect()->back()->with('error', 'Borrow record not found.');
        }

        $book = Books::find($borrow->books_id);

        if (!$book) {
            return redirect()->back()->with('error', 'Book record not found.');
        }

        // Update borrow status to received (1)
        $borrow->status = 1;
        $borrow->returned_at = now(); // optional: mark the return date
        $borrow->save();

        // Increase the book stock by 1
        $book->stock = $book->stock + 1;
        $book->save();

        return redirect()->back()->with('success', 'Book marked as received and stock updated successfully.');
    }
}
