<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;



// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

// Books
Route::resource('books', BookController::class);
Route::put('/books/{book}/disable', [BookController::class, 'disable'])->name('books.disable');

// Users
Route::resource('users', UserController::class);

// Borrows
Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');
Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create');
Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');
Route::post('/borrow/{id}/mark-received', [BorrowController::class, 'markReceived'])->name('borrow.markReceived');