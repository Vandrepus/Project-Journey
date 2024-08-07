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
<body>
@include('layouts.navigation')
    <div class="container mx-auto py-12">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">{{ $topic->title }}</h2>
            <p class="text-gray-700 mb-6">{{ $topic->content }}</p>
            <p class="text-gray-500 text-sm mb-6">Posted by {{ $topic->user->name }} on {{ $topic->created_at->format('M d, Y') }}</p>

            <h3 class="text-xl font-semibold mb-4">Replies</h3>
            <ul>
                @foreach($topic->replies as $reply)
                    <li class="border-b py-4">
                        <p class="text-gray-700">{{ $reply->content }}</p>
                        <p class="text-gray-500 text-sm">Replied by {{ $reply->user->name }} on {{ $reply->created_at->format('M d, Y') }}</p>
                    </li>
                @endforeach
            </ul>

            <h3 class="text-xl font-semibold mb-4 mt-6">Reply to this Topic</h3>
            <form action="{{ route('forum.reply', $topic->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Post Reply</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
