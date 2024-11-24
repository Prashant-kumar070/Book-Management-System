<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\IncomingEntry;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
{
    $query = Book::query();

    // Check if there is a search query
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        });
    }

    $books = $query->paginate(8); // You can adjust pagination as needed

    return view('dashboard', compact('books'));
}




    public function viewBook(Request $request){

        $id = $request->id;
        $book = Book::with(['ratings', 'comments'])->findOrFail($id);
        return view('book-details', compact('book'));
// dd($books);
        return view('dashboard', compact('user', 'books'));
    }
}
