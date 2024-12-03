<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Ticket Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Ticket Details</h1>

            <!-- Ticket Information -->
            <div class="space-y-4">
                <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
                <p><strong>Category:</strong> {{ $ticket->category }}</p>
                <p><strong>Message:</strong></p>
                <p class="bg-gray-50 p-4 rounded-md text-gray-800">{{ $ticket->message }}</p>
                <p><strong>Status:</strong> 
                    <span 
                        class="px-2 py-1 rounded-md text-sm font-medium 
                        {{ $ticket->status === 'closed' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }} ">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </p>
                <p><strong>User:</strong> <span class="text-blue-600">{{ $ticket->user->username }}</span></p>
            </div>

            <!-- Replies Section -->
            <h2 class="text-2xl font-bold mt-8 mb-4">Replies</h2>
            @if($ticket->replies->isEmpty())
                <p class="text-gray-500">No replies yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach($ticket->replies as $reply)
                        <li class="bg-gray-50 p-4 rounded-md shadow-sm">
                            <p>
                                <strong>
                                    @if($reply->user->usertype === 'admin')
                                        <span class="text-red-500">Admin</span> {{ $reply->user->username }}
                                    @else
                                        {{ $reply->user->username }}
                                    @endif
                                :</strong>
                                {{ $reply->message }}
                            </p>
                            <p class="text-gray-500 text-sm mt-1">{{ $reply->created_at->format('Y-m-d H:i:s') }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Close Ticket Button -->
            @if ($ticket->status !== 'closed')
                <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST" class="mt-8">
                    @csrf
                    @method('PATCH')
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-150"
                    >
                        Close Ticket
                    </button>
                </form>
            @endif

            <!-- Reply Form -->
            @if ($ticket->status !== 'closed')
                <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" class="mt-8">
                    @csrf
                    <label for="message" class="block text-gray-700 font-medium mb-2">Your Reply</label>
                    <textarea 
                        name="message" 
                        rows="5" 
                        class="w-full border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Write a reply..." 
                        required>
                    </textarea>
                    <button 
                        type="submit" 
                        class="mt-4 w-full sm:w-auto px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-150"
                    >
                        Send Reply
                    </button>
                </form>
            @else
                <p class="mt-8 text-gray-500 text-center">This ticket is closed and cannot be updated.</p>
            @endif
        </div>
    </div>
</body>
</html>
