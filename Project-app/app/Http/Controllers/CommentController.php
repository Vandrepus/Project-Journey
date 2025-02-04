<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda komentārus, ļaujot lietotājiem pievienot un dzēst komentārus pie rakstiem.
 *
 * This controller manages comments, allowing users to add and delete comments on articles.
 */
class CommentController extends Controller
{
    /**
     * Saglabā jaunu komentāru pie konkrēta raksta.
     *
     * Stores a new comment for a specific article.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'comment' => 'required|string|max:200',
        ]);
        $article->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);
        return back()->with('success', 'Comment added successfully.');
    }

    /**
     * Dzēš konkrētu komentāru, ja lietotājam ir atļauja to darīt.
     *
     * Deletes a specific comment if the user has permission.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        /**
         * Tikai administratori vai komentāra autors var dzēst komentāru
         * Only admins or the comment's author can delete the comment
         */
        if (auth()->user()->isAdmin() || auth()->id() === $comment->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }
        return redirect()->back()->with('error', 'You do not have permission to delete this comment.');
    }
}
