<!-- resources/views/user/forum/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Forum</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
@include('layouts.navigation')

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Forum Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Forum</h2>
            <a href="{{ route('forum.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Create New Topic
            </a>
        </div>

        <!-- Forum Topics List -->
        @if($topics->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($topics as $topic)
                    <div class="py-4">
                        <a href="{{ route('forum.show', $topic->id) }}" class="text-lg font-medium text-blue-600 hover:underline">
                            {{ $topic->title }}
                        </a>
                        <p class="text-gray-500 text-sm mt-1">
                            Posted by <span class="font-semibold">{{ $topic->user->username }}</span> on {{ $topic->created_at->format('M d, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">No topics have been posted yet. Be the first to start a discussion!</p>
        @endif
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
</footer>
</body>
</html>
