<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $sight->name }}</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Sight Details -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $sight->name }}</h1>
            <p class="text-gray-700 text-lg mb-4">{{ $sight->description }}</p>
            <p class="text-gray-700"><strong>Location:</strong> {{ $sight->location }}</p>
            <p class="text-gray-700"><strong>Category:</strong> {{ $sight->category }}</p>
            <p class="text-gray-700"><strong>Opening Hours:</strong> {{ $sight->opening_hours }}</p>

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

        <!-- Reviews Section -->
        <section class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Reviews</h2>
            @if($sight->reviews->count() > 0)
                <div class="space-y-4">
                    @foreach($sight->reviews as $review)
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <p class="text-gray-800 font-medium">{{ $review->user->username }}</p>
                            <p class="text-gray-600 mt-1">{{ $review->content }}</p>
                            <p class="text-sm text-gray-500 mt-2">{{ $review->created_at->format('Y-m-d H:i:s') }}</p>
                            <div class="flex items-center mt-2">
                                <span class="text-yellow-500 font-semibold mr-1">{{ number_format($review->rating, 1) }}</span>
                                <i class="fas fa-star text-yellow-500"></i>
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
            <section class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Write a Review</h2>
                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="sight_id" value="{{ $sight->id }}">
                    
                    <!-- Review Content -->
                    <div>
                        <label for="content" class="block text-gray-700 font-medium">Your Review</label>
                        <textarea
                            id="content"
                            name="content"
                            rows="5"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Share your thoughts..."
                            required
                        ></textarea>
                    </div>

                    <!-- Rating -->
                    <div>
                        <label for="rating" class="block text-gray-700 font-medium">Rating (1-5)</label>
                        <input
                            type="number"
                            id="rating"
                            name="rating"
                            min="1"
                            max="5"
                            step="0.1"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                        />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Submit Review
                        </button>
                    </div>
                </form>
            </section>
        @endauth
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
