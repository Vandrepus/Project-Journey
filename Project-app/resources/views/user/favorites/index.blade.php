<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Your Favorite Sights</title>
</head>
<body class="bg-base-200 min-h-screen flex flex-col">
    @include('layouts.navigation')

    <main class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-6 text-primary">Your Favorite Sights</h1>

        @if($favorites->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">You haven't added any sights to your favorites yet.</p>
                <a href="{{ route('countries.index') }}" class="btn btn-primary mt-4">Explore Sights</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($favorites as $sight)
                    <div class="card bg-base-100 shadow-xl">
                        <figure>
                            <img 
                                src="{{ $sight->image_url ?? 'https://via.placeholder.com/300x200' }}" 
                                alt="{{ $sight->name }}" 
                                class="w-full h-48 object-cover rounded-t-lg"
                            />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-lg font-bold text-gray-800">{{ $sight->name }}</h2>
                            <p class="text-gray-600 text-sm">{{ Str::limit($sight->description, 100) }}</p>
                            <div class="card-actions mt-4 justify-between">
                                <a href="{{ route('sights.show', $sight) }}" class="btn btn-outline btn-sm btn-primary">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <form method="POST" action="{{ route('favorites.destroy', $sight) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm btn-error">
                                        <i class="fas fa-trash-alt mr-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="bg-gray-800 text-white text-center py-6 mt-auto">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
