<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * Šis kontrolieris pārvalda administratīvās darbības, kas saistītas ar kontaktu ziņojumiem.
 * Tas nodrošina iespēju skatīt, dzēst un pārvaldīt lietotāju iesniegtos ziņojumus.
 *
 * This controller manages administrative actions related to contact messages.
 * It provides the ability to view, delete, and manage user-submitted messages.
 */
class AdminContactMessageController extends Controller
{
    /**
     * Attēlo sarakstu ar visiem kontaktu ziņojumiem, sakārtotiem pēc jaunākajiem.
     *
     * Displays a list of all contact messages, sorted by the latest.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $messages = ContactMessage::latest()->paginate(10); // Lapdališana, lai nodrošinātu efektīvu datu ielādi
        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Parāda konkrētu kontaktu ziņojumu pēc tā ID.
     *
     * Displays a specific contact message by its ID.
     *
     * @param int $id Ziņojuma ID / Message ID
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        $message = ContactMessage::findOrFail($id);

        return view('admin.contact-messages.show', compact('message'));
    }

    /**
     * Dzēš konkrētu kontaktu ziņojumu.
     *
     * Deletes a specific contact message.
     *
     * @param ContactMessage $message Kontaktziņojums / Contact message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        try {
            $message->delete(); 
            return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted successfully!');
        } catch (\Exception $e) {
            Log::error("Error deleting contact message: {$e->getMessage()}");
            return redirect()->route('admin.contact-messages.index')->with('error', 'Failed to delete the message.');
        }
    }
}
