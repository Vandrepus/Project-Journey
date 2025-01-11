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
                Posted by 
                <a href="{{ route('user.profile', $topic->user->username) }}" class="text-blue-500 hover:underline font-medium">
                    {{ $topic->user->username }}
                </a> 
                on {{ $topic->created_at->format('M d, Y') }}
            </p>
        </div>

        <!-- Replies Section -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Replies</h3>
            @if ($topic->replies->count() > 0)
                <ul class="space-y-4">
                    @foreach($topic->replies as $reply)
                        <li class="bg-white rounded-lg p-4 shadow-md">
                            <!-- Apply line-break styles -->
                            <p class="text-gray-700 break-words whitespace-pre-wrap">{{ $reply->content }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                Replied by 
                                <a href="{{ route('user.profile', $reply->user->username) }}" class="text-blue-500 hover:underline font-medium">
                                    {{ $reply->user->username }}
                                </a> 
                                on {{ $reply->created_at->format('M d, Y') }}
                            </p>

                            <div class="mt-4 flex items-center space-x-4">
                            @auth
                                    @if (auth()->user()->isAdmin())
                                        <!-- Admin Delete Button -->
                                        <form method="POST" action="{{ route('admin.forum.comments.delete', $reply->id) }}" onsubmit="return confirm('Are you sure you want to delete this reply?')">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                            >
                                                <i class="fas fa-trash-alt mr-2"></i>Delete Reply
                                            </button>
                                        </form>
                                    @elseif (auth()->id() === $reply->user_id)
                                        <!-- User Delete Button -->
                                        <form method="POST" action="{{ route('forum.reply.delete', $reply->id) }}" onsubmit="return confirm('Are you sure you want to delete your reply?')">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                            >
                                                <i class="fas fa-trash-alt mr-2"></i>Delete Reply
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Report Button -->
                                    @if (!auth()->user()->isAdmin() && auth()->id() !== $reply->user_id && !$reply->user->isAdmin())
                                        <button 
                                            type="button" 
                                            onclick="openReportModal({{ $reply->id }})"
                                            class="btn btn-warning px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600"
                                        >
                                            <i class="fas fa-flag mr-2"></i>Report
                                        </button>
                                    @endif
                                @endauth
                            </div>
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
                        <label for="content" class="block text-sm font-medium text-gray-700">Your Reply (max 200 characters)</label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="5" 
                            maxlength="200" 
                            oninput="updateReplyCharacterCount(event)" 
                            class="textarea textarea-bordered w-full focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Write your reply here..." 
                            required
                        ></textarea>
                        <p id="replyCounter" class="text-sm text-gray-500 mt-2">
                            Characters remaining: <span id="remainingReplyCharacters">200</span>
                        </p>
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

<!-- Report Modal -->
<div 
    id="reportModal" 
    class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
>
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Report Reply</h2>
        <form id="reportForm" method="POST" action="{{ route('reports.store') }}">
            @csrf
            <input type="hidden" name="reportable_id" id="reportable_id">
            <input type="hidden" name="reportable_type" value="App\Models\Reply">
            <div class="form-control mb-4">
                <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                <textarea 
                    name="reason" 
                    id="reason" 
                    rows="4" 
                    class="textarea textarea-bordered w-full" 
                    placeholder="Explain why you're reporting this reply..." 
                    required
                ></textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <button 
                    type="button" 
                    onclick="closeReportModal()" 
                    class="btn btn-secondary px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Submit Report
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
</footer>

<script>
    function openReportModal(replyId) {
        document.getElementById('reportable_id').value = replyId; // Set the reply ID
        document.getElementById('reportModal').classList.remove('hidden'); // Show the modal
    }

    function closeReportModal() {
        document.getElementById('reportModal').classList.add('hidden'); // Hide the modal
        document.getElementById('reportForm').reset(); // Reset the form
    }

    function updateReplyCharacterCount(event) {
        const maxLength = 200;
        const currentLength = event.target.value.length;
        const remainingCharacters = maxLength - currentLength;

        // Update the counter display
        document.getElementById('remainingReplyCharacters').textContent = remainingCharacters;
    }

    // Initialize counter if textarea already has content
    document.addEventListener('DOMContentLoaded', function () {
        const replyField = document.getElementById('content');
        if (replyField) {
            updateReplyCharacterCount({ target: replyField });
        }
    });
</script>
</body>
</html>
