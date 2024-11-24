<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(),
            'rating' => $request->stars,
        ]);

        return redirect()->route('book.details', $request->book_id)->with('success', 'Rating added successfully!');
    }
}

