<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::latest()->paginate(10); // Paginate for efficiency
        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        return view('admin.contact-messages.show', compact('message'));
    }

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
