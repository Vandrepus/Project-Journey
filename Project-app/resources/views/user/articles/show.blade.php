<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous">
    <title>{{ $article->title }} - JourneyHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function openReportModal(commentId) {
            document.getElementById('reportable_id').value = commentId; // Set the comment ID
            document.getElementById('reportModal').classList.remove('hidden'); // Show the modal
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.add('hidden'); // Hide the modal
            document.getElementById('reportForm').reset(); // Reset the form
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Article Section -->
            <article class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>
                <p class="text-gray-700 text-lg leading-relaxed">{{ $article->content }}</p>
            </article>

            <!-- Comments Section -->
            <section class="bg-white shadow-md rounded-lg p-6 mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Comments</h2>
                @if ($article->comments->isEmpty())
                    <p class="text-gray-500 text-center">No comments yet. Be the first to comment!</p>
                @else
                <ul class="space-y-4">
                    @foreach ($article->comments as $comment)
                        <li class="border-b border-gray-200 pb-4">
                            <p class="text-gray-800">{{ $comment->comment }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                By: 
                                <a href="{{ route('user.profile', $comment->user->username) }}" class="text-blue-600 hover:underline font-medium">
                                    {{ $comment->user->username }}
                                </a>
                            </p>
                            <div class="flex space-x-4 mt-2">
                            @auth
                        @if (auth()->user()->isAdmin())
                            <!-- Admin Delete Button -->
                            <form method="POST" action="{{ route('admin.comments.delete', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete
                                </button>
                            </form>
                        @elseif (auth()->id() === $comment->user_id)
                            <!-- User Delete Button (for their own comments) -->
                            <form method="POST" action="{{ route('comments.delete', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete your comment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete
                                </button>
                            </form>
                        @endif

                        <!-- Report Button (cannot report self or admin) -->
                        @if (!auth()->user()->isAdmin() && auth()->id() !== $comment->user_id && !$comment->user->isAdmin())
                            <button type="button" onclick="openReportModal({{ $comment->id }})" class="btn btn-warning px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                <i class="fas fa-flag mr-2"></i>Report
                            </button>
                        @endif
                    @endauth
                            </div>
                        </li>
                    @endforeach
                </ul>
                @endif
                <!-- Comment Form -->
                @auth
                    <form method="POST" action="{{ route('comments.store', $article) }}" class="mt-6 space-y-4">
                        @csrf
                        <textarea
                            name="comment"
                            id="comment"
                            rows="4"
                            maxlength="200"  Enforce limit
                            oninput="updateCharacterCount(event)" 
                            class="textarea textarea-bordered w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Add your comment (max 200 characters)..."
                            required
                        ></textarea>
                        <p id="characterCounter" class="text-sm text-gray-500">
                            Characters remaining: <span id="remainingCharacters">200</span>
                        </p>
                        <button type="submit" class="btn btn-primary mt-4 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
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

    <!-- Report Modal -->
    <div id="reportModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Report Comment</h2>
            <form id="reportForm" method="POST" action="{{ route('reports.store') }}">
                @csrf
                <input type="hidden" name="reportable_id" id="reportable_id">
                <input type="hidden" name="reportable_type" value="App\Models\Comment">
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                    <textarea name="reason" id="reason" rows="4" class="textarea textarea-bordered w-full" placeholder="Explain why you're reporting this comment..." required></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeReportModal()" class="btn btn-secondary px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function updateCharacterCount(event) {
        const maxLength = 200;
        const currentLength = event.target.value.length;
        const remainingCharacters = maxLength - currentLength;

        // Update the counter display
        document.getElementById('remainingCharacters').textContent = remainingCharacters;
    }

    // Initialize counter if textarea already has content
    document.addEventListener('DOMContentLoaded', function () {
        const commentField = document.getElementById('comment');
        if (commentField) {
            updateCharacterCount({ target: commentField });
        }
    });
    </script>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-8">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
