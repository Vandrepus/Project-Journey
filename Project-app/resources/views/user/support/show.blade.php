<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Details</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Ticket Details</h1>

            <!-- Ticket Information -->
            <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
            <p><strong>Category:</strong> {{ $ticket->category }}</p>
            <p><strong>Status:</strong> 
                <span 
                    class="px-2 py-1 rounded-md text-sm font-medium 
                    {{ $ticket->status === 'closed' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </p>
            <p class="mt-4"><strong>Message:</strong></p>
            <p class="bg-gray-50 p-4 rounded-md">{{ $ticket->message }}</p>

            <!-- Replies Section -->
            <h2 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Replies</h2>
            <div class="space-y-4">
                @foreach ($ticket->replies as $reply)
                    <div class="bg-gray-50 p-4 rounded-md shadow-md">
                        <p>
                            <strong>
                                @if ($reply->user->usertype === 'admin')
                                    <span class="text-red-500">Admin</span> {{ $reply->user->username }}
                                @else
                                    {{ $reply->user->username }}
                                @endif
                                :
                            </strong>
                        </p>
                        <p>{{ $reply->message }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $reply->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Reply Form -->
            @if ($ticket->status !== 'closed')
                @auth
                    <form action="{{ route('support.reply', $ticket->id) }}" method="POST" class="mt-8">
                        @csrf
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Your Reply</label>
                            <textarea id="message" name="message" rows="5" class="w-full border border-gray-300 rounded-md shadow-sm mt-2"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded-md">Send Reply</button>
                    </form>
                @endauth
            @else
                <p class="mt-8 text-gray-500 text-center">This ticket is closed and cannot be updated.</p>
            @endif
        </div>
    </div>
</body>
</html>
