<!-- resources/views/user/forum/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $topic->title }}</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
@include('layouts.navigation')

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Topic Details -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">{{ $topic->title }}</h2>
            <p class="text-gray-700 text-lg mt-4">{{ $topic->content }}</p>
            <p class="text-sm text-gray-500 mt-2">
                Posted by <span class="font-medium">{{ $topic->user->username }}</span> on {{ $topic->created_at->format('M d, Y') }}
            </p>
        </div>

        <!-- Replies Section -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Replies</h3>
            @if ($topic->replies->count() > 0)
                <ul class="space-y-4">
                    @foreach($topic->replies as $reply)
                        <li class="bg-white rounded-lg p-4 shadow-md">
                            <p class="text-gray-700">{{ $reply->content }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                Replied by <span class="font-medium">{{ $reply->user->username }}</span> on {{ $reply->created_at->format('M d, Y') }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No replies yet. Be the first to reply!</p>
            @endif
        </div>

        <!-- Reply Form -->
        @auth
            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Reply to this Topic</h3>
                <form action="{{ route('forum.reply', $topic->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Reply Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Your Reply</label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="5" 
                            class="textarea textarea-bordered w-full focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Write your reply here..." 
                            required
                        ></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="btn btn-primary"
                        >
                            <i class="fas fa-paper-plane mr-2"></i>Post Reply
                        </button>
                    </div>
                </form>
            </div>
        @else
            <p class="text-gray-600 mt-8">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to reply to this topic.</p>
        @endauth
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
</footer>
</body>
</html>
