<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthorDashboardController;
use Database\Seeders\BookSeeder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});


// Route::middleware(['auth', 'role:author'])->group(function () {
    Route::get('/author/dashboard', [AuthorDashboardController::class, 'index'])->name('author.dashboard');
    Route::get('/author/orders', [AuthorDashboardController::class, 'orders'])->name('author.orders');
    Route::get('/author/books', [AuthorDashboardController::class, 'books'])->name('author.books');
    Route::post('/author/books', [AuthorDashboardController::class, 'addBook'])->name('author.addBook');
// });

Route::get('/dashboard', [BooksController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/book/{id}', [BooksController::class, 'viewBook'])->name('book.details');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/messages/{chatId}', [ChatController::class, 'getMessages']);
    Route::get('/chat', [ChatController::class, 'chat'])->name('chat');
    Route::get('/fetch-messages/{userId}', [ChatController::class, 'fetchMessages']);

});

require __DIR__.'/auth.php';
