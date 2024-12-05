<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin - Support Tickets</title>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">All Support Tickets</h1>

            <!-- Filter Form -->
            <form method="GET" class="mb-6 flex flex-col sm:flex-row items-center gap-4">
                <div class="w-full sm:w-auto">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Filter by Category</label>
                    <select name="category" id="category" class="w-full sm:w-64 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        <option value="technical" {{ request('category') === 'technical' ? 'selected' : '' }}>Technical</option>
                        <option value="billing" {{ request('category') === 'billing' ? 'selected' : '' }}>Billing</option>
                        <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                    Filter
                </button>
            </form>

            <!-- Tabs for Open and Archived Tickets -->
            <div x-data="{ activeTab: 'open' }">
                <!-- Tab Buttons -->
                <div class="flex justify-center mb-6">
                    <button 
                        @click="activeTab = 'open'"
                        :class="activeTab === 'open' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-6 py-2 rounded-l-md text-sm font-medium transition-all"
                    >
                        Open Tickets
                    </button>
                    <button 
                        @click="activeTab = 'archived'"
                        :class="activeTab === 'archived' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-6 py-2 rounded-r-md text-sm font-medium transition-all"
                    >
                        Archived Tickets
                    </button>
                </div>

                <!-- Open Tickets -->
                <div x-show="activeTab === 'open'" class="space-y-6">
                    @if($openTickets->isEmpty())
                        <p class="text-center text-gray-500">No open tickets available.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($openTickets as $ticket)
                                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $ticket->subject }}</h3>
                                    <p class="text-sm text-gray-600 mb-1">Category: {{ ucfirst($ticket->category) }}</p>
                                    <p class="text-sm text-gray-600 mb-4">Status: 
                                        <span class="px-2 py-1 rounded-md text-white {{ $ticket->status === 'open' ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </p>
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Archived Tickets -->
                <div x-show="activeTab === 'archived'" class="space-y-6">
                    @if($archivedTickets->isEmpty())
                        <p class="text-center text-gray-500">No archived tickets available.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($archivedTickets as $ticket)
                                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $ticket->subject }}</h3>
                                    <p class="text-sm text-gray-600 mb-1">Category: {{ ucfirst($ticket->category) }}</p>
                                    <p class="text-sm text-gray-600 mb-4">Status: 
                                        <span class="px-2 py-1 rounded-md text-white {{ $ticket->status === 'open' ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </p>
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
