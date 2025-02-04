<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Šis kontrolieris pārvalda foruma tēmu izveidi un apskati.
 * Lietotāji var izveidot jaunas tēmas un skatīt tēmu diskusijas.
 *
 * This controller manages forum topic creation and viewing.
 * Users can create new topics and view topic discussions.
 */
class TopicController extends Controller
{
    /**
     * Parāda formu jaunās tēmas izveidei.
     *
     * Displays the form for creating a new forum topic.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.forum.create');
    }

    /**
     * Saglabā jaunu tēmu datubāzē.
     *
     * Stores a new topic in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Parāda konkrētu foruma tēmu un tās atbildes.
     *
     * Displays a specific forum topic along with its replies.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $topic = Topic::with('replies.user')->findOrFail($id);
        return view('user.forum.show', compact('topic'));
    }
}
