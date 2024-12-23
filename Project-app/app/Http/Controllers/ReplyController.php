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

    public function destroy(Reply $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

}
