<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('user.support.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        Ticket::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'subject' => $request->subject,
                'category' => $request->category,
                'status' => 'open',
            ],
            ['message' => $request->message]
        );

        return redirect()->route('support.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        // Ensure only the ticket owner or an admin can view the ticket
        if (Auth::id() !== $ticket->user_id && Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        return view('user.support.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
    $request->validate(['message' => 'required|string']);

    // Ensure the user can reply only if the ticket is not closed
    if ($ticket->status === 'closed') {
        return redirect()->route('support.show', $ticket->id)->with('error', 'This ticket is closed and cannot be updated.');
    }

    TicketReply::create([
        'ticket_id' => $ticket->id,
        'user_id' => auth()->id(),
        'message' => $request->message,
    ]);

    // Allow users to reply but do not change the ticket's status
    return redirect()->route('support.show', $ticket->id)->with('success', 'Reply sent successfully.');
    }

}
