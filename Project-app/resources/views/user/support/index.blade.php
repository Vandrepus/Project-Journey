<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Tickets</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Your Support Tickets</h1>

            <!-- Create New Ticket Button -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('support.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus mr-2"></i>Create New Ticket
                </a>
            </div>

            @if($tickets->isEmpty())
                <!-- No Tickets Message -->
                <div class="alert alert-warning shadow-lg">
                    <div>
                        <i class="fa-solid fa-circle-info text-yellow-500"></i>
                        <span>You have no tickets at the moment.</span>
                    </div>
                </div>
            @else
                <!-- Ticket List -->
                <div class="overflow-x-auto">
                    <table class="table w-full text-left border-collapse border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 border border-gray-200">Subject</th>
                                <th class="p-3 border border-gray-200">Category</th>
                                <th class="p-3 border border-gray-200">Status</th>
                                <th class="p-3 border border-gray-200 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border border-gray-200">{{ $ticket->subject }}</td>
                                    <td class="p-3 border border-gray-200">{{ $ticket->category }}</td>
                                    <td class="p-3 border border-gray-200">
                                        <span class="badge badge-{{ $ticket->status == 'open' ? 'success' : 'error' }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 border border-gray-200 text-center">
                                        <a href="{{ route('support.show', $ticket->id) }}" class="btn btn-outline btn-sm">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
