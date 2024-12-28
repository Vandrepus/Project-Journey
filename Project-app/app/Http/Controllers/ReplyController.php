<?php

// app/Http/Controllers/ReplyController.php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, $topicId)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $topic = Topic::findOrFail($topicId);

        Reply::create([
            'content' => $request->content,
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.show', $topic->id)->with('success', 'Reply posted successfully.');
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);

        // Check if the authenticated user owns the reply or is an admin
        if (auth()->id() === $reply->user_id || auth()->user()->isAdmin()) {
            $reply->delete();
            return redirect()->back()->with('success', 'Reply deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this reply.');
    }

}
