<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $country->name }}</title>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen flex flex-col">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Country Details -->
            <div class="p-8 bg-blue-50">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $country->name }}</h1>
                <p class="text-gray-700 text-lg">{{ $country->description }}</p>
            </div>

            <!-- Sights Section -->
            <div class="p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Sights</h2>
                @if(count($sights) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($sights as $sight)
                            @if($sight->visible) <!-- Only show visible sights -->
                                <div class="bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
                                    <a href="{{ route('sights.show', $sight->id) }}" class="block">
                                        <!-- Sight Image -->
                                        <img 
                                            src="{{ $sight->image_url ?? 'https://via.placeholder.com/300' }}" 
                                            alt="{{ $sight->name }}" 
                                            class="w-full h-40 object-cover"
                                        >
                                        <!-- Sight Details -->
                                        <div class="p-4">
                                            <h3 class="text-lg font-medium text-gray-800 truncate">
                                                {{ $sight->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-2">
                                                {{ Str::limit($sight->description, 100) }}
                                            </p>
                                        </div>
                                    </a>

                                    <!-- Admin-Only Delete Button -->
                                    @auth
                                        @if(auth()->user()->isAdmin())
                                            <form method="POST" action="{{ route('admin.sights.delete', $sight->id) }}" onsubmit="return confirm('Are you sure you want to delete this sight?');" class="p-4">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="btn btn-error w-full text-white"
                                                >
                                                    <i class="fas fa-trash-alt mr-2"></i>Delete Sight
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">No sights available for this country.</p>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
