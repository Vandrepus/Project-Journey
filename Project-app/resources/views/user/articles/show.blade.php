<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- DaisyUI CDN -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" 
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>{{ $article->title }}</title>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
  @include('layouts.navigation')

  <!-- Main Content -->
  <main class="flex-grow container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Article Section -->
    <article class="card bg-white shadow-xl rounded-lg p-6 mb-8">
      <div class="card-body">
        <h1 class="card-title text-4xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>
        <p class="text-gray-700 leading-relaxed">{{ $article->content }}</p>
      </div>
    </article>

    <!-- Comments Section -->
    <section class="card bg-white shadow-xl rounded-lg p-6 mb-8">
      <div class="card-body">
        <h2 class="card-title text-2xl font-bold text-gray-800 mb-4">Comments</h2>
        @if($article->comments->isEmpty())
          <p class="text-gray-500 text-center">No comments yet. Be the first to comment!</p>
        @else
          <ul class="space-y-4">
            @foreach($article->comments as $comment)
              <li class="border border-gray-200 p-4 rounded-lg">
                <p class="text-gray-800 break-words">{{ $comment->comment }}</p>
                <div class="flex justify-between items-center mt-2 text-sm text-gray-500">
                  <span>
                    By <a href="{{ route('user.profile', $comment->user->username) }}" class="text-blue-600 hover:underline font-medium">
                      {{ $comment->user->username }}
                    </a>• {{ $comment->created_at->diffForHumans() }}
                  </span>
                </div>
                <div class="flex mt-4 space-x-2">
                  @auth
                    @if(auth()->user()->isAdmin() || auth()->id() === $comment->user_id)
                      <form method="POST" action="{{ route('comments.delete', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                          <i class="fas fa-trash-alt"></i>Delete
                        </button>
                      </form>
                    @endif

                    @if(!auth()->user()->isAdmin() && auth()->id() !== $comment->user_id && !$comment->user->isAdmin())
                      <button type="button" onclick="openReportModal({{ $comment->id }})" class="btn btn-warning px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        <i class="fas fa-flag"></i>Report
                      </button>
                    @endif
                  @endauth
                </div>
              </li>
            @endforeach
          </ul>
        @endif
      </div>
    </section>

    <!-- Write a Comment Section -->
    @auth
      <section class="card bg-white shadow-xl rounded-lg p-6">
        <div class="card-body">
          <h2 class="card-title text-2xl font-bold text-gray-800 mb-4">Add Your Comment</h2>
          <form method="POST" action="{{ route('comments.store', $article) }}" class="space-y-4">
            @csrf
            <div class="form-control">
              <textarea name="comment" id="comment" rows="4" maxlength="200" oninput="updateCharacterCount(event)" placeholder="Write your comment here..." class="textarea textarea-bordered" required></textarea>
              <p id="characterCounter" class="text-sm text-gray-500 mt-2">
                Characters remaining: <span id="remainingCharacters">200</span>
              </p>
            </div>
            <button type="submit" class="btn btn-primary w-full">
              <i class="fas fa-paper-plane mr-2"></i>Post Comment
            </button>
          </form>
        </div>
      </section>
    @else
      <p class="text-gray-500 text-center mt-8">
        Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">log in</a> to add a comment.
      </p>
    @endauth
  </main>

  <!-- Report Modal -->
  <div id="reportModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="card bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
      <div class="card-body">
        <h2 class="card-title text-lg font-bold text-gray-800 mb-4">Report Comment</h2>
        <form id="reportForm" method="POST" action="{{ route('reports.store') }}">
          @csrf
          <input type="hidden" name="reportable_id" id="reportable_id">
          <input type="hidden" name="reportable_type" value="App\Models\Comment">
          <div class="form-control mb-4">
            <label for="reason" class="label">
              <span class="label-text">Reason</span>
            </label>
            <textarea name="reason" id="reason" rows="4" class="textarea textarea-bordered w-full" placeholder="Explain why you're reporting this comment..." required></textarea>
          </div>
          <div class="flex justify-end space-x-4">
            <button type="button" onclick="closeReportModal()" class="btn btn-secondary">
              Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              Submit Report
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function updateCharacterCount(event) {
      const maxLength = 200;
      const currentLength = event.target.value.length;
      const remainingCharacters = maxLength - currentLength;
      document.getElementById('remainingCharacters').textContent = remainingCharacters;
    }
    
    // Initialize counter if textarea already has content
    document.addEventListener('DOMContentLoaded', function () {
      const commentField = document.getElementById('comment');
      if (commentField) {
        updateCharacterCount({ target: commentField });
      }
    });
    function openReportModal(commentId) {
      document.getElementById('reportable_id').value = commentId;
      document.getElementById('reportModal').classList.remove('hidden');
    }
    function closeReportModal() {
      document.getElementById('reportModal').classList.add('hidden');
      document.getElementById('reportForm').reset();
    }
  </script>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-4 mt-8">
    <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
  </footer>
</body>
</html>
