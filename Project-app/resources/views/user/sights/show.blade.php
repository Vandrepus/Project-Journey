<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $sight->name }}</title>
</head>
<body class="bg-base-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Sight Details -->
            <div class="bg-white shadow-xl p-6">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Sight Image Section -->
                    <div class="lg:w-1/3 flex justify-center items-center">
                        <div class="relative w-full h-64 bg-gray-100 rounded-lg overflow-hidden">
                            @if ($sight->photo)
                                <a href="javascript:void(0);" onclick="openPhotoModal()">
                                    <img
                                        src="{{ asset('storage/' . $sight->photo) }}"
                                        alt="{{ $sight->name }}"
                                        class="w-full h-full object-cover"
                                    />
                                </a>
                            @else
                            <div class="flex flex-col items-center text-gray-500">
                                <i class="fas fa-image text-6xl"></i>
                                <p class="mt-2 text-lg font-medium">No photo available</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Full-Size Image Modal -->
                    <div id="photoModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4">
                        <div class="relative bg-white p-4 rounded-lg shadow-lg max-w-2xl w-full">
                            <!-- Close Button -->
                            <button onclick="closePhotoModal()" class="absolute top-2 right-2 text-gray-800 hover:text-red-600 text-3xl font-bold">
                                &times;
                            </button>

                            @if ($sight->photo)
                                <img 
                                    src="{{ asset('storage/' . $sight->photo) }}" 
                                    alt="{{ $sight->name }}" 
                                    class="w-full max-h-[75vh] object-contain rounded-lg"
                                />
                            @endif
                        </div>
                    </div>

                    <!-- Sight Information -->
                    <div class="w-full lg:w-1/2">
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
                    </div>
                </div>

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
            </div>


            <!-- Add to Favorites Button -->
            @auth
            <div class="mt-6">
                @if($sight->isFavoritedBy(auth()->user()))
                <form method="POST" action="{{ route('favorites.destroy', $sight) }}">
                    @csrf
                    @method('DELETE')
                    <button 
                    type="submit" 
                    class="btn btn-secondary w-full sm:w-auto px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center justify-center"
                    >
                    <i class="fas fa-heart-broken mr-2"></i> Remove from Favorites
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('favorites.store', $sight) }}">
                    @csrf
                    <button 
                    type="submit" 
                    class="btn btn-primary w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center justify-center"
                    >
                    <i class="fas fa-heart mr-2"></i> Add to Favorites
                    </button>
                </form>
                @endif
            </div>
            @else
            <div class="mt-6">
                <p class="text-gray-500">
                Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to add this sight to your favorites.
                </p>
            </div>
            @endauth


         <!-- Reviews Section -->
        <section class="card bg-white shadow-xl rounded-lg p-6 mb-8">
            <h2 class="card-title text-2xl font-bold text-gray-800 mb-4">Reviews</h2>
            
            <!-- Sort Reviews Form -->
            <div class="mb-4 flex items-center">
                <label for="sort_reviews" class="mr-2 text-sm font-medium text-gray-700">Sort reviews by:</label>
                <form method="GET" action="{{ route('sights.show', $sight->id) }}" class="flex items-center">
                <select name="sort_reviews" id="sort_reviews" class="select select-bordered">
                    <option value="newest" {{ request('sort_reviews', 'newest') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ request('sort_reviews') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Sort</button>
                </form>
            </div>
            
            @php
                $sortOrder = request('sort_reviews', 'newest');
                $sortedReviews = $sight->reviews;
                if($sortOrder === 'oldest'){
                    $sortedReviews = $sight->reviews->sortBy('created_at');
                } else {
                    $sortedReviews = $sight->reviews->sortByDesc('created_at');
                }
            @endphp

            @if($sortedReviews->count() > 0)
                <div class="space-y-4">
                @foreach($sortedReviews as $review)
                    <div class="card bg-base-200 shadow-md p-4">
                    <p class="font-medium">
                        <a href="{{ route('user.profile', $review->user->username) }}" class="text-blue-600 hover:underline">
                        {{ $review->user->username }}
                        </a>
                    </p>
                    <p class="mt-1 break-words overflow-hidden">{{ $review->content }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        {{ $review->created_at->diffForHumans() }}
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-500 font-semibold mr-1">{{ number_format($review->rating, 1) }}</span>
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                    <div class="flex mt-4 space-x-4">
                        @auth
                        @if (auth()->user()->isAdmin() || auth()->id() === $review->user_id)
                            <form method="POST" action="{{ route('reviews.delete', $review->id) }}" onsubmit="return confirm('Are you sure you want to delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                <i class="fas fa-trash-alt mr-2"></i>Delete
                            </button>
                            </form>
                        @endif

                        @if (!auth()->user()->isAdmin() && auth()->id() !== $review->user_id && !$review->user->isAdmin())
                            <button type="button" onclick="openReportModal({{ $review->id }})" class="btn btn-warning px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
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
                        <label for="content" class="label font-medium text-gray-700">Your Review (max 600 characters)</label>
                        <textarea
                            id="content"
                            name="content"
                            rows="5"
                            maxlength="600"
                            oninput="updateCharacterCount(event)"
                            class="textarea textarea-bordered w-full"
                            placeholder="Share your thoughts..."
                            required
                        ></textarea>
                        <p id="characterCounter" class="text-sm text-gray-500 mt-2">
                            Characters remaining: <span id="remainingCharacters">600</span>
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
        const maxLength = 600;
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

    function openPhotoModal() {
        document.getElementById('photoModal').classList.remove('hidden');
    }

    function closePhotoModal() {
        document.getElementById('photoModal').classList.add('hidden');
    }

    function openReportModal(reviewId) {
        document.getElementById('reportable_id').value = reviewId; // Set the review ID
        document.getElementById('reportModal').classList.remove('hidden'); // Show the modal
    }

    function closeReportModal() {
        document.getElementById('reportModal').classList.add('hidden'); // Hide the modal
        document.getElementById('reportForm').reset(); // Reset the form
    }
    </script>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
