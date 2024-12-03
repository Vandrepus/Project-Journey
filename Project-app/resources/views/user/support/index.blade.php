<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Tickets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Support Tickets</h1>

            <div class="mb-6">
                <a href="{{ route('support.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Create New Ticket
                </a>
            </div>

            @if($tickets->isEmpty())
                <p class="text-gray-600">You have no tickets.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($tickets as $ticket)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">{{ $ticket->subject }}</h3>
                                <p class="text-gray-500">Category: {{ $ticket->category }}</p>
                                <p class="text-gray-500">Status: {{ ucfirst($ticket->status) }}</p>
                            </div>
                            <a href="{{ route('support.show', $ticket->id) }}" class="text-blue-500 hover:underline">
                                View Details
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</body>
</html>
