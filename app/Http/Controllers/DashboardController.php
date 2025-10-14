<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use App\Models\Books;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Books::count();
        $totalUsers = Users::count();
        $totalBorrowed = DB::table('borrows')->count();

        // Pie chart: books per category
        $categories = BookCategory::with('books')->get(); 
        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryCounts = $categories->map(fn ($cat) => $cat->books->count())->toArray();

        // Bar chart: borrowed books grouped by month
        $borrowStats = DB::table('borrows')
            ->select(
                DB::raw('DATE_FORMAT(borrowed_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total_borrowed')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $borrowMonths = $borrowStats->pluck('month')->toArray();
        $borrowCounts = $borrowStats->pluck('total_borrowed')->toArray();

        // Bar Chart: Borrowed books by category
        $data = Books::selectRaw('book_category.name as category, COUNT(books.id) as count')
            ->join('book_category', 'books.book_category_id', '=', 'book_category.id')
            ->join('borrows', 'books.id', '=', 'borrows.books_id')
            ->groupBy('book_category.name')
            ->get();

        $categories = $data->pluck('category');
        $counts = $data->pluck('count');

        return view('dashboard', compact(
            'totalBooks',
            'totalUsers',
            'totalBorrowed',
            'categoryLabels',
            'categoryCounts',
            'borrowMonths',
            'borrowCounts',
            'categories',
            'counts'
        ));
    }
}
