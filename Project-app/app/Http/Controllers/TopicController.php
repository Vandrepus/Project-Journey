<?php

// app/Http/Controllers/TopicController.php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function create()
    {
        return view('user.forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Topic::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index')->with('success', 'Topic created successfully.');
    }

    public function show($id)
    {
        $topic = Topic::with('replies.user')->findOrFail($id);
        return view('user.forum.show', compact('topic'));
    }
}
