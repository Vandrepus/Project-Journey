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
<body>
@include('layouts.navigation')
    <div class="container mx-auto py-12">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Forum</h2>
            <a href="{{ route('forum.create') }}" class="inline-block mb-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create New Topic</a>
            <ul>
                @foreach($topics as $topic)
                    <li class="border-b py-4">
                        <a href="{{ route('forum.show', $topic->id) }}" class="text-blue-600 hover:underline">
                            {{ $topic->title }}
                        </a>
                        <p class="text-gray-500 text-sm">Posted by {{ $topic->user->username }} on {{ $topic->created_at->format('M d, Y') }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
