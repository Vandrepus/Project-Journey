<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>{{ $article->title }} - JourneyHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Article Section -->
            <article class="bg-white shadow-md rounded-lg p-6">
                <!-- Full Title -->
                <h1 class="text-4xl font-extrabold text-gray-800 mb-6 break-words">
                    {{ $article->title }}
                </h1>
                <!-- Fixed Description -->
                <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-wrap break-words">
                    {{ $article->content }}
                </p>
            </article>

            <!-- Comments Section -->
            <section class="bg-white shadow-md rounded-lg p-6 mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Comments</h2>

                <!-- Comments List -->
                @if ($article->comments->isEmpty())
                    <p class="text-gray-500 text-center">No comments yet. Be the first to comment!</p>
                @else
                    <ul class="space-y-6">
                        @foreach ($article->comments as $comment)
                            <li class="border-b border-gray-200 pb-4">
                                <p class="text-gray-800 break-words">{{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500 mt-2">By: <span class="font-medium">{{ $comment->user->username }}</span></p>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Comment Form -->
                @auth
                    <form method="POST" action="{{ route('comments.store', $article) }}" class="mt-8">
                        @csrf
                        <textarea 
                            name="comment" 
                            rows="4" 
                            class="textarea textarea-bordered w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 break-words" 
                            placeholder="Add your comment here..." 
                            required></textarea>
                        <button 
                            type="submit" 
                            class="btn btn-primary mt-4 px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:ring focus:ring-blue-300">
                            Post Comment
                        </button>
                    </form>
                @else
                    <p class="text-gray-500 text-center mt-8">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to add a comment.
                    </p>
                @endauth
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-8">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
