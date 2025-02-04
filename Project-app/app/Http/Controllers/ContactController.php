<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

/**
 * Šis kontrolieris pārvalda kontaktu ziņojumus un to iesniegšanu.
 *
 * This controller manages contact messages and their submission.
 */
class ContactController extends Controller
{
    /**
     * Apstrādā un saglabā lietotāja iesniegto kontaktu ziņojumu.
     *
     * Handles and stores a contact message submitted by the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        /**
         * Validē ievades datus
         * Validate input data
         */
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        /**
         * Saglabā ziņojumu datubāzē
         * Store the message in the database
         */ 
        ContactMessage::create($validatedData);
        /**
         * Atgriež lietotāju atpakaļ ar veiksmīgu paziņojumu
         * Redirect the user back with a success message
         */
        return redirect()->back()->with('success', 'Thank you for your message!');
    }

    /**
     * Parāda kontaktu lapu lietotājiem.
     *
     * Displays the contact page for users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }
}
