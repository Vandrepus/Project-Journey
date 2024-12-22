<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-6">
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Article</h1>

                <form method="POST" action="{{ route('articles.update', $article) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="input input-bordered w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            value="{{ $article->title }}" 
                            placeholder="Enter the article title" 
                            required>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="8" 
                            class="textarea textarea-bordered w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Write the article content here..." 
                            required>{{ $article->content }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline btn-gray-500 px-4 py-2 border rounded-lg hover:bg-gray-100">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="btn btn-primary px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:ring focus:ring-blue-300">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
