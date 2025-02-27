<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Ticket Details</h1>

            <!-- Ticket Information -->
            <div class="mb-8">
                <p class="text-lg break-words overflow-hidden"><strong>Subject:</strong> {{ $ticket->subject }}</p>
                <p class="text-lg"><strong>Category:</strong> {{ ucfirst($ticket->category) }}</p>
                <p class="text-lg">
                    <strong>Status:</strong>
                    <span 
                        class="px-2 py-1 rounded-md text-sm font-medium 
                        {{ $ticket->status === 'closed' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </p>
                <p class="text-lg mt-4"><strong>Message:</strong></p>
                <p class="bg-gray-50 p-4 rounded-md shadow-sm text-gray-700 break-words overflow-hidden">{{ $ticket->message }}</p>
            </div>

            <!-- Replies Section -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Replies</h2>
            <div class="space-y-6">
                @foreach ($ticket->replies as $reply)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                        <p class="font-medium">
                            @if ($reply->user->usertype === 'admin')
                                <span class="text-red-500">Admin</span> {{ $reply->user->username }}
                            @else
                                {{ $reply->user->username }}
                            @endif
                            <span class="text-sm text-gray-500 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="text-gray-700 mt-2 break-words overflow-hidden">{{ $reply->message }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Reply Form -->
            @if ($ticket->status !== 'closed')
                @auth
                    <form action="{{ route('support.reply', $ticket->id) }}" method="POST" class="mt-8 space-y-4">
                        @csrf
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Your Reply</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5" 
                                class="textarea textarea-bordered w-full"
                                placeholder="Write your reply..."
                                required
                            ></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Send Reply
                            </button>
                        </div>
                    </form>
                @endauth
            @else
                <p class="mt-8 text-gray-500 text-center">This ticket is closed and cannot be updated.</p>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
