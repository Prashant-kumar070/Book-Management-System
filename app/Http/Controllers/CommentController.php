<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(),
            'comment' => $request->body,
        ]);

        return redirect()->route('book.details', $request->book_id)->with('success', 'Comment added successfully!');
    }
}

