<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $sight->name }}</title>
    <script>
        function openReportModal(reviewId) {
            document.getElementById('reportable_id').value = reviewId; // Set the review ID
            document.getElementById('reportModal').classList.remove('hidden'); // Show the modal
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.add('hidden'); // Hide the modal
            document.getElementById('reportForm').reset(); // Reset the form
        }
    </script>
</head>
<body class="bg-base-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Sight Details -->
        <div class="bg-white shadow-xl p-6">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $sight->name }}</h1>
                @if(auth()->user() && auth()->user()->isAdmin())
                    <a 
                        href="{{ route('admin.sights.edit', $sight->id) }}" 
                        class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center"
                    >
                        <i class="fas fa-edit mr-2"></i>Edit Sight
                    </a>
                @endif
            </div>
            <p class="text-gray-700 text-lg mb-4">{{ $sight->description }}</p>
            <p class="text-gray-700"><strong>Location:</strong> {{ $sight->location }}</p>
            <p class="text-gray-700"><strong>Category:</strong> {{ $sight->category }}</p>
            <p class="text-gray-700"><strong>Opening Hours:</strong> {{ $sight->opening_hours }}</p>
            <p class="text-gray-700"><strong>Map:</strong> 
                @if ($sight->map_url)
                    <a href="{{ $sight->map_url }}" target="_blank" class="text-indigo-600 hover:underline">
                        View on Map
                    </a>
                @else
                    None
                @endif
            </p>

            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800">Average Rating</h2>
                <div class="flex items-center mt-2">
                    @if ($sight->average_rating)
                        <span class="text-3xl font-bold text-yellow-500 mr-2">{{ number_format($sight->average_rating, 1) }}</span>
                        <i class="fas fa-star text-yellow-500"></i>
                    @else
                        <span class="text-gray-500">No ratings yet</span>
                    @endif
                </div>
            </div>

            <!-- Add to Favorites Button -->
            @auth
                <div class="mt-6">
                    <form method="POST" action="{{ route('favorites.store', $sight) }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="btn btn-primary w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center justify-center"
                        >
                            <i class="fas fa-heart mr-2"></i> Add to Favorites
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-6">
                    <p class="text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to add this sight to your favorites.</p>
                </div>
            @endauth
        </div>


        <!-- Reviews Section -->
        <section class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Reviews</h2>
        @if($sight->reviews->count() > 0)
            <div class="space-y-4">
                @foreach($sight->reviews as $review)
                    <div class="card bg-base-200 shadow-md p-4">
                        <p class="font-medium">
                            <a href="{{ route('user.profile', $review->user->username) }}" class="text-blue-600 hover:underline">
                                {{ $review->user->username }}
                            </a>
                        </p>
                        <p class="mt-1">{{ $review->content }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $review->created_at->format('Y-m-d H:i:s') }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-yellow-500 font-semibold mr-1">{{ number_format($review->rating, 1) }}</span>
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>

                        <div class="flex mt-4 space-x-4">
                            @auth
                                <!-- Admin-Only Delete Button -->
                                @if (auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('admin.reviews.delete', $review->id) }}" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            <i class="fas fa-trash-alt mr-2"></i>Delete
                                        </button>
                                    </form>
                                @endif


                                <!-- Report Button -->
                                @if (!auth()->user()->isAdmin() && auth()->id() !== $review->user_id && !$review->user->isAdmin())
                                    <button 
                                        type="button" 
                                        onclick="openReportModal({{ $review->id }})"
                                        class="btn btn-warning px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600"
                                    >
                                        <i class="fas fa-flag mr-2"></i>Report
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No reviews yet for this sight.</p>
        @endif
    </section>


        <!-- Write a Review Section -->
        @auth
            <section class="mt-8 card bg-base-100 shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Write a Review</h2>
                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="sight_id" value="{{ $sight->id }}">
                    
                    <!-- Review Content -->
                    <div class="form-control">
                        <label for="content" class="label font-medium text-gray-700">Your Review (max 300 characters)</label>
                        <textarea
                            id="content"
                            name="content"
                            rows="5"
                            maxlength="300"
                            oninput="updateCharacterCount(event)"
                            class="textarea textarea-bordered w-full"
                            placeholder="Share your thoughts..."
                            required
                        ></textarea>
                        <p id="characterCounter" class="text-sm text-gray-500 mt-2">
                            Characters remaining: <span id="remainingCharacters">300</span>
                        </p>
                    </div>

                    <!-- Rating -->
                    <div class="form-control">
                        <label for="rating" class="label font-medium text-gray-700">Rating (1-5)</label>
                        <input
                            type="number"
                            id="rating"
                            name="rating"
                            min="1"
                            max="5"
                            step="0.1"
                            class="input input-bordered w-full"
                            required
                        />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="btn btn-primary w-full"
                        >
                            Submit Review
                        </button>
                    </div>
                </form>
            </section>
        @endauth
    </main>

    <!-- Report Modal -->
    <div 
        id="reportModal" 
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Report Review</h2>
            <form id="reportForm" method="POST" action="{{ route('reports.store') }}">
                @csrf
                <input type="hidden" name="reportable_id" id="reportable_id">
                <input type="hidden" name="reportable_type" value="App\Models\Review">
                <div class="form-control mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                    <textarea 
                        name="reason" 
                        id="reason" 
                        rows="4" 
                        class="textarea textarea-bordered w-full" 
                        placeholder="Explain why you're reporting this review..." 
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

    <script>
    function updateCharacterCount(event) {
        const maxLength = 300;
        const currentLength = event.target.value.length;
        const remainingCharacters = maxLength - currentLength;

        // Update the counter display
        document.getElementById('remainingCharacters').textContent = remainingCharacters;
    }

    // Initialize counter if textarea already has content
    document.addEventListener('DOMContentLoaded', function () {
        const reviewField = document.getElementById('content');
        if (reviewField) {
            updateCharacterCount({ target: reviewField });
        }
    });
    </script>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
