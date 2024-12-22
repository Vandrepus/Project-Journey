<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Admin - Create Article</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto p-6">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New Article</h1>

                <form method="POST" action="{{ route('articles.store') }}" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" id="title" class="input input-bordered w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Enter the article title" required>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea name="content" id="content" rows="8" class="textarea textarea-bordered w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Write your article content here..." required></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline btn-gray-500 mr-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:ring focus:ring-blue-300">Submit</button>
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
