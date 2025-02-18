<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Latest News Articles - JourneyHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Latest News Articles</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($articles as $article)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow flex flex-col">
                        <div class="p-4 flex flex-col flex-grow">
                            <!-- Truncate title for long text -->
                            <h2 class="text-xl font-bold text-gray-800 line-clamp-2" title="{{ $article->title }}">{{ $article->title }}</h2>

                            <!-- Description with ellipsis -->
                            <p class="text-gray-600 mt-2 flex-grow line-clamp-3">
                                {{ $article->content }}
                            </p>
                        </div>
                        <!-- Read More Button -->
                        <div class="p-4 border-t">
                            <a href="{{ route('articles.show', $article) }}" class="block text-blue-600 hover:underline font-medium text-center">
                                Read More
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full text-center">No articles available at the moment.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($articles->hasPages())
                <div class="mt-8">
                    {{ $articles->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-6">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
