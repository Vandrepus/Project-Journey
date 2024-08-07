<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>{{ $sight->name }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'figtree', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .bg-white {
            background-color: #ffffff;
        }
        .shadow-sm {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .sm\:rounded-lg {
            border-radius: 0.375rem;
        }
        .text-gray-800 {
            color: #2d3748;
        }
        .text-xl {
            font-size: 1.25rem;
        }
        .font-semibold {
            font-weight: 600;
        }
        .leading-tight {
            line-height: 1.25;
        }
        .py-12 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .max-w-7xl {
            max-width: 80rem;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }
        .p-6 {
            padding: 1.5rem;
        }
        .text-gray-900 {
            color: #4a5568;
        }
        .rating-number {
            display: flex;
            justify-content: center;
            font-size: 1.5rem;
        }
        .rating-number span {
            margin: 0 0.25rem;
        }
    </style>
</head>
<body>
@include('layouts.navigation')
    <div class="container mx-auto py-12">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $sight->name }}</h1>
            <p>{{ $sight->description }}</p>
            <p><strong>Location:</strong> {{ $sight->location }}</p>
            <p><strong>Category:</strong> {{ $sight->category }}</p>
            <p><strong>Opening Hours:</strong> {{ $sight->opening_hours }}</p>
            
            <div class="mt-4">
                <h2 class="text-xl font-semibold">Average Rating</h2>
                <div class="rating-number">
                    @if ($sight->average_rating)
                        <span>{{ number_format($sight->average_rating, 1) }}</span>
                    @else
                        <span>No ratings yet</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-semibold">Reviews</h2>
            @foreach($sight->reviews as $review)
                <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-4">
                    <p><strong>{{ $review->user->name }}:</strong> {{ $review->content }}</p>
                    <p><small>{{ $review->created_at->format('Y-m-d H:i:s') }}</small></p>
                    <div class="rating-number">
                        @if ($review->rating)
                            <span>{{ number_format($review->rating, 1) }}</span>
                        @else
                            <span>No rating</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @auth
            <div class="mt-8 bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Write a Review</h2>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sight_id" value="{{ $sight->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Your Review</label>
                        <textarea name="content" id="content" rows="5" class="w-full border border-gray-300 p-2 rounded-md"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700">Rating (1-5)</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" step="0.1" class="border border-gray-300 p-2 rounded-md w-full" required />
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
                    </div>
                </form>
            </div>
        @endauth
    </div>
</body>
</html>
