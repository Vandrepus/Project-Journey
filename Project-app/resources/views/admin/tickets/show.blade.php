<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Admin - Ticket Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @include('layouts.navigation')

    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8 flex-grow">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Ticket Details</h1>

            <!-- Ticket Information -->
            <div class="space-y-4">
                <div>
                    <p class="font-semibold text-gray-700">Subject:</p>
                    <p class="text-gray-800 break-words overflow-hidden">{{ $ticket->subject }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Category:</p>
                    <p class="text-gray-800">{{ $ticket->category }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Message:</p>
                    <p class="text-gray-800 break-words overflow-hidden">{{ $ticket->message }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Status:</p>
                    <p class="inline-block px-3 py-1 text-sm font-medium rounded-md 
                        {{ $ticket->status === 'closed' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                        {{ ucfirst($ticket->status) }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">User:</p>
                    <a href="{{ route('user.profile', $ticket->user->username) }}" class="text-blue-600 hover:underline">
                        {{ $ticket->user->username }}
                    </a>
                </div>
            </div>

            <!-- Replies Section -->
            <h2 class="text-2xl font-bold mt-8 mb-4">Replies</h2>
            @if($ticket->replies->isEmpty())
                <p class="text-gray-500">No replies yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach($ticket->replies as $reply)
                        <li class="bg-gray-50 p-4 rounded-md shadow-sm">
                            <p class="mb-2">
                                <strong>
                                    @if($reply->user->usertype === 'admin')
                                        <span class="text-red-500">Admin</span>
                                    @endif
                                    <a href="{{ route('user.profile', $reply->user->username) }}" class="text-blue-600 hover:underline">
                                        {{ $reply->user->username }}
                                    </a>:
                                </strong>
                            </p>
                            <p class="text-gray-800  break-words">{{ $reply->message }}</p>
                            <p class="text-gray-500 text-sm mt-2">{{ $reply->created_at->diffForHumans() }}</p>
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
                            class="w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Write your reply here..." 
                            required
                            ></textarea>
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
