<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Šis kontrolieris pārvalda atbalsta biļetes lietotājiem.
 * Lietotāji var izveidot, skatīt un atbildēt uz biļetēm.
 * Administratori var pārvaldīt visas biļetes.
 *
 * This controller manages support tickets for users.
 * Users can create, view, and reply to tickets.
 * Admins can manage all tickets.
 */
class TicketController extends Controller
{
    /**
     * Attēlo lietotāja iesniegtās biļetes.
     *
     * Displays the tickets submitted by the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        
        return view('user.support.index', compact('tickets'));
    }

    /**
     * Parāda formu jaunas biļetes izveidei.
     *
     * Shows the form to create a new support ticket.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.support.create');
    }

    /**
     * Saglabā jaunu biļeti datubāzē.
     *
     * Stores a new support ticket in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:100',
            'message' => 'required|string',
            'category' => 'required|string|max:1000',
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

    /**
     * Parāda konkrētu biļeti, nodrošinot autorizāciju.
     *
     * Displays a specific support ticket, ensuring authorization.
     *
     * @param Ticket $ticket
     * @return \Illuminate\View\View
     */
    public function show(Ticket $ticket)
    {
        if (Auth::id() !== $ticket->user_id && Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        return view('user.support.show', compact('ticket'));
    }

    /**
     * Ļauj lietotājiem un administratoriem atbildēt uz biļeti.
     *
     * Allows users and admins to reply to a ticket.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate(['message' => 'required|string']);
        /**
         * Nodrošina, ka lietotājs nevar atbildēt uz slēgtu biļeti.
         * Ensure that users cannot reply to a closed ticket.
         */
        if ($ticket->status === 'closed') {
            return redirect()->route('support.show', $ticket->id)->with('error', 'This ticket is closed and cannot be updated.');
        }

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);
        return redirect()->route('support.show', $ticket->id)->with('success', 'Reply sent successfully.');
    }
}
