<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Countries</title>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-200 min-h-screen flex flex-col">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Explore Countries</h2>

            <!-- Search Bar -->
            <form action="{{ route('countries.index') }}" method="GET" class="mb-8">
                <div class="flex">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search countries..." 
                        value="{{ request('search') }}" 
                        class="input input-bordered w-full"
                    />
                    <button type="submit" class="btn btn-primary ml-2">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </div>
            </form>
            
            @if($countries->isEmpty())
                <p class="text-center text-gray-600">No countries available.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($countries as $country)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 overflow-hidden">
                            <a href="{{ route('countries.show', $country->id) }}" class="block">
                                <!-- Flag -->
                                <img 
                                    src="{{ $country->picture ? asset('storage/' . $country->picture) : asset('images/placeholder.jpg') }}" 
                                    alt="{{ $country->name }}" 
                                    class="w-full h-full object-cover"
                                />
                                <!-- Country Details -->
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $country->name }}</h3>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <strong>Capital:</strong> 
                                        {{ $country->capital ?? 'Not provided' }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        {{ Str::limit($country->description, 80, '...') ?? 'No description available.' }}
                                    </p>
                                </div>
                            </a>
                            
                            <!-- Admin-Only Delete Button -->
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('admin.countries.delete', $country->id) }}" class="p-4" onsubmit="return confirm('Are you sure you want to delete this country?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error w-full text-white">
                                            <i class="fas fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
