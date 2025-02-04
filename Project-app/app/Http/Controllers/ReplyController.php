<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Šis kontrolieris pārvalda foruma tēmu atbildes, 
 * ļaujot lietotājiem pievienot un dzēst savas atbildes.
 *
 * This controller manages forum topic replies, 
 * allowing users to post and delete their responses.
 */
class ReplyController extends Controller
{
    /**
     * Saglabā jaunu atbildi konkrētā foruma tēmā.
     *
     * Stores a new reply in a specific forum topic.
     *
     * @param Request $request
     * @param int $topicId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $topicId)
    {
        $request->validate([
            'content' => 'required|string|max:200',
        ]);
        $topic = Topic::findOrFail($topicId);
        Reply::create([
            'content' => $request->content,
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('forum.show', $topic->id)->with('success', 'Reply posted successfully.');
    }

    /**
     * Dzēš lietotāja atbildi, ja lietotājs ir īpašnieks vai administrators.
     *
     * Deletes a user's reply if they are the owner or an administrator.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);

        /**
         * Pārbaudām, vai lietotājs ir īpašnieks vai administrators
         * Check if the user is the owner or an admin
         */
        if (auth()->id() === $reply->user_id || auth()->user()->isAdmin()) {
            $reply->delete();
            return redirect()->back()->with('success', 'Reply deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this reply.');
    }
}
