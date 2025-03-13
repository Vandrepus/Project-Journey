<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Your Favorite Sights</title>
</head>
<body class="bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="container mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-center mb-8 text-primary">Your Favorite Sights</h1>

        @if($favorites->isEmpty())
            <!-- No Favorites Message -->
            <div class="text-center py-12 bg-white shadow-md rounded-lg p-8">
                <p class="text-gray-600 text-lg">You haven't added any sights to your favorites yet.</p>
                <a href="{{ route('countries.index') }}" class="btn btn-primary mt-6">
                    <i class="fas fa-map-marker-alt mr-2"></i> Explore Sights
                </a>
            </div>
        @else
            <!-- Favorites Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($favorites as $sight)
                    <div class="card bg-base-100 shadow-lg hover:shadow-xl transform hover:scale-105 transition-transform duration-300">
                        <figure>
                            @if ($sight->photo)
                                <img 
                                    src="{{ asset('storage/' . $sight->photo) ?? asset('images/placeholder.jpg') }}" 
                                    alt="{{ $sight->name }}" 
                                    class="w-full h-56 object-cover rounded-t-lg"
                                />
                                @else
                                    <img 
                                        src="{{asset('images/placeholder.jpg') }}" 
                                        class="w-full h-56 object-cover rounded-t-lg"
                                    />
                                @endif
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-xl font-semibold text-gray-800">{{ $sight->name }}</h2>
                            <p class="text-gray-600 text-sm mt-2">{{ Str::limit($sight->description, 100) }}</p>
                            <div class="card-actions mt-4 justify-between">
                                <a href="{{ route('sights.show', $sight) }}" class="btn btn-outline btn-primary btn-sm">
                                    <i class="fas fa-eye mr-2"></i> View
                                </a>
                                <form method="POST" action="{{ route('favorites.destroy', $sight) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-error btn-sm">
                                        <i class="fas fa-trash-alt mr-2"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
