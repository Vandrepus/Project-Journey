<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // For sending emails
use App\Mail\ContactFormSubmission; // Create this mail class if needed
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Validate Form Data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // 2. Send Email (or Store in Database)
        ContactMessage::create($validatedData); // Assuming you have a Mailable class

        // 3. Redirect with Success Message (or JSON Response)
        return redirect()->back()->with('success', 'Thank you for your message!');
    }

    public function index()
    {
    return view('contact'); 
    }
}
