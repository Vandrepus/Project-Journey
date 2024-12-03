<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
    $category = $request->input('category');

    // Filter open tickets (tickets that are not closed)
    $openTickets = Ticket::where('status', '!=', 'closed')
        ->when($category, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->get();

    // Filter archived tickets (only closed tickets)
    $archivedTickets = Ticket::where('status', 'closed')
        ->when($category, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->get();

    return view('admin.tickets.index', compact('openTickets', 'archivedTickets', 'category'));
    }



    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
    $request->validate(['message' => 'required|string']);

    // Check if the ticket is closed before replying
    if ($ticket->status === 'closed') {
        return redirect()->route('admin.tickets.show', $ticket->id)->with('error', 'This ticket is closed and cannot be updated.');
    }

    // Create the reply
    TicketReply::create([
        'ticket_id' => $ticket->id,
        'user_id' => auth()->id(),
        'message' => $request->message,
    ]);

    // Update the status to 'answered' if the admin replies and the ticket is still open
    if ($ticket->status === 'open') {
        $ticket->update(['status' => 'answered']);
    }

    return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'Reply sent successfully.');
    }


    public function close(Ticket $ticket)
    {
    // Only admins can close tickets
    if (auth()->user()->usertype !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    // Update the ticket status to "closed"
    $ticket->update(['status' => 'closed']);

    return redirect()->route('admin.tickets.index')->with('success', 'Ticket closed successfully.');
    }

}

