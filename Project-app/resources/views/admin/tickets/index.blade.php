<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Support Tickets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">All Support Tickets</h1>

            <!-- Filter Form -->
            <form method="GET" class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700">Filter by Category</label>
                <select name="category" id="category" class="mt-1 w-full max-w-xs border-gray-300 rounded-md shadow-sm">
                    <option value="">All Categories</option>
                    <option value="technical" {{ request('category') === 'technical' ? 'selected' : '' }}>Technical</option>
                    <option value="billing" {{ request('category') === 'billing' ? 'selected' : '' }}>Billing</option>
                    <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General</option>
                </select>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Filter
                </button>
            </form>

            <!-- Tabs for Open and Archived Tickets -->
            <div x-data="{ activeTab: 'open' }" class="mb-6">
                <div class="flex justify-center space-x-4 mb-4">
                    <button 
                        @click="activeTab = 'open'"
                        :class="activeTab === 'open' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-md font-medium transition-all"
                    >
                        Open Tickets
                    </button>
                    <button 
                        @click="activeTab = 'archived'"
                        :class="activeTab === 'archived' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-md font-medium transition-all"
                    >
                        Archived Tickets
                    </button>
                </div>

                <!-- Open Tickets -->
                <div x-show="activeTab === 'open'" class="space-y-4">
                    @if($openTickets->isEmpty())
                        <p class="text-gray-500">No open tickets available.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach($openTickets as $ticket)
                                <li class="py-4 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-700">{{ $ticket->subject }}</h3>
                                        <p class="text-gray-500">Category: {{ $ticket->category }}</p>
                                        <p class="text-gray-500">Status: {{ ucfirst($ticket->status) }}</p>
                                    </div>
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">
                                        View Details
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Archived Tickets -->
                <div x-show="activeTab === 'archived'" class="space-y-4">
                    @if($archivedTickets->isEmpty())
                        <p class="text-gray-500">No archived tickets available.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach($archivedTickets as $ticket)
                                <li class="py-4 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-700">{{ $ticket->subject }}</h3>
                                        <p class="text-gray-500">Category: {{ $ticket->category }}</p>
                                        <p class="text-gray-500">Status: {{ ucfirst($ticket->status) }}</p>
                                    </div>
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">
                                        View Details
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
