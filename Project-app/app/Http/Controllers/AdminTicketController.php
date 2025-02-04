<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda administratora "Ticket" sistēmu, ieskaitot "Ticket" apskati, atbildēšanu un slēgšanu.
 *
 * This controller manages the admin ticket system, including viewing, replying to, and closing tickets.
 */
class AdminTicketController extends Controller
{
    /**
     * Parāda atvērtās un arhivētās Pieprasījumi, pēc nepieciešamības filtrējot pēc kategorijas.
     *
     * Displays open and archived tickets, with an optional category filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $category = $request->input('category');
        /**
         * Atvērtie Pieprasījumi (kas nav slēgtas)
         * Open tickets (not closed)
         */
        $openTickets = Ticket::where('status', '!=', 'closed')
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->get();
        /**
         * Arhivēti Pieprasījumi (slēgti pieprasījumi)
         * Archived tickets (closed tickets only)
         */
        $archivedTickets = Ticket::where('status', 'closed')
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->get();

        return view('admin.tickets.index', compact('openTickets', 'archivedTickets', 'category'));
    }

    /**
     * Parāda konkrētu pieprasījumu ar tās informāciju un atbildēm.
     *
     * Displays a specific ticket along with its details and replies.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\View\View
     */
    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Administrators var atbildēt uz pieprasījumu, ja tā nav slēgta.
     * Ja atbilde tiek pievienota atvērtai pieprasījumu, statuss tiek mainīts uz "answered".
     *
     * The admin can reply to a ticket if it is not closed.
     * If a reply is added to an open ticket, the status is updated to "answered".
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate(['message' => 'required|string']);

        /**
         * Pārbauda, vai pieprasījums nav slēgts
         * Check if the ticket is closed before replying
         */
        if ($ticket->status === 'closed') {
            return redirect()->route('admin.tickets.show', $ticket->id)
                ->with('error', 'This ticket is closed and cannot be updated.');
        }
        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);
        /**
         * Ja pieprasījumu statuss ir "open", tas tiek mainīts uz "answered"
         * If the ticket status is "open", update it to "answered"
         */
        if ($ticket->status === 'open') {
            $ticket->update(['status' => 'answered']);
        }

        return redirect()->route('admin.tickets.show', $ticket->id)
            ->with('success', 'Reply sent successfully.');
    }

    /**
     * Administrators var slēgt pieprasījumu.
     *
     * The admin can close a ticket.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close(Ticket $ticket)
    {
        /**
         * Tikai administratori var slēgt Pieprasījumu
         * Only admins can close tickets
         */
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        /**
         * Atjaunina pieprasījumu statusu uz "closed"
         * Update the ticket status to "closed"
         */
        $ticket->update(['status' => 'closed']);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket closed successfully.');
    }
}
