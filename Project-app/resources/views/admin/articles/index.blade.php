<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Admin - Articles Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Articles Management</h1>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fa fa-plus mr-2"></i> Create New Article
                    </a>
                </div>

                <!-- Articles Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600">Title</th>
                                <th class="px-4 py-2 text-left text-gray-600">Published On</th>
                                <th class="px-4 py-2 text-center text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                <tr class="hover:bg-gray-50 border-b border-gray-200">
                                    <!-- Clickable Title -->
                                    <td class="px-4 py-3 text-gray-800 max-w-xs truncate">
                                        <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:underline" title="{{ $article->title }}">
                                            {{ $article->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ optional($article->created_at)->format('d M, Y') ?? 'Not Published' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-outline px-3 py-1 border rounded text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('articles.destroy', $article) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error px-3 py-1 border rounded text-red-600 border-red-600 hover:bg-red-600 hover:text-white" onclick="return confirm('Are you sure you want to delete this article?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-center text-gray-500">No articles available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
