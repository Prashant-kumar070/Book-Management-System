<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class AuthorDashboardController extends Controller
{
    // Show dashboard with summary
    public function index()
    {
        $booksCount = Book::where('author_id', auth()->user()->id)->count();
        $ordersCount = Order::where('book_author_id', auth()->user()->id)->count();

        return view('author.dashboard', compact('booksCount', 'ordersCount'));
    }

    // Show customer orders related to the author
    public function orders()
    {
        $orders = Order::where('book_author_id', auth()->user()->id)->with('book')->get();
        return view('author.orders', compact('orders'));
    }

    // Show books added by the author
    public function books()
    {
        $books = Book::where('author_id', auth()->user()->id)->get();
        return view('author.books', compact('books'));
    }

    // Add new book
    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            // Add other validation as needed
        ]);

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'author_id' => auth()->user()->id,
        ]);

        return redirect()->route('author.books')->with('success', 'Book added successfully');
    }
}

