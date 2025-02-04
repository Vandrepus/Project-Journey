<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Šis kontrolieris pārvalda foruma diskusijas.
 * Lietotāji var izveidot, skatīt, meklēt un dzēst diskusiju tēmas.
 *
 * This controller manages forum discussions.
 * Users can create, view, search, and delete discussion topics.
 */
class ForumController extends Controller
{
    /**
     * Parāda visu foruma diskusiju tēmu sarakstu ar iespēju meklēt.
     *
     * Displays a list of all forum topics with search functionality.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /**
         * Iegūst meklēšanas ievadi
         * Retrieve the search input
         */
        $search = $request->input('search'); // 

        $topics = Topic::query()
            ->when($search, function ($query, $search) {
                /**
                 * Filtrē tēmas pēc nosaukuma
                 * Filter topics by title
                 */
                $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('user.forum.index', compact('topics'));
    }

    /**
     * Parāda jaunas diskusijas izveides lapu.
     *
     * Displays the page for creating a new forum topic.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.forum.create');
    }

    /**
     * Saglabā jaunu foruma diskusijas tēmu datubāzē.
     *
     * Stores a new forum topic in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'content' => 'required|string|max:3000',
        ]);

        Topic::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.index')->with('success', 'Topic created successfully!');
    }

    /**
     * Parāda konkrētas foruma diskusijas tēmas saturu.
     *
     * Displays the content of a specific forum topic.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return view('user.forum.show', compact('topic'));
    }

    /**
     * Dzēš konkrētu foruma diskusijas tēmu.
     *
     * Deletes a specific forum topic.
     *
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('forum.index')->with('success', 'Topic deleted successfully.');
    }

    /**
     * Parāda foruma noteikumu lapu.
     *
     * Displays the forum rules page.
     *
     * @return \Illuminate\View\View
     */
    public function rules()
    {
        return view('user.forum.rules');
    }
}
