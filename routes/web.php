<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use Database\Seeders\BookSeeder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

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
});

require __DIR__.'/auth.php';
