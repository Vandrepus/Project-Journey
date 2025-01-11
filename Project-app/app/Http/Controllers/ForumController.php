<?php

// app/Http/Controllers/ForumController.php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('user.forum.index', compact('topics'));
    }

    public function create()
    {
        return view('user.forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'content' => 'required|string|max:3000',
        ]);

        // Create the topic
        Topic::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.index')->with('success', 'Topic created successfully!');
    }

    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return view('user.forum.show', compact('topic'));
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('forum.index')->with('success', 'Topic deleted successfully.');
    }

}
