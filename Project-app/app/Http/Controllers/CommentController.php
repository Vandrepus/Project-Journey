<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $article->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
