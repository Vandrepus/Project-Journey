@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Delete Contact Message</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mt-6">
            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <p>Are you sure you want to delete the following contact message?</p>
                <div class="mt-4">
                    <p><strong>Name:</strong> {{ $message->name }}</p>
                    <p><strong>Email:</strong> {{ $message->email }}</p>
                    <p><strong>Subject:</strong> {{ $message->subject }}</p>
                    <p><strong>Message:</strong> {{ $message->message }}</p>
                    <p><strong>Date:</strong> {{ $message->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                    <a href="{{ route('admin.contact-messages.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
