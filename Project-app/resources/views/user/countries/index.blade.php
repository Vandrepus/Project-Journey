<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Countries</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Explore Countries</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($countries as $country)
                    <div class="bg-gray-50 hover:shadow-lg transition-shadow duration-300 rounded-lg overflow-hidden">
                        <a href="{{ route('countries.show', $country->id) }}" class="block">
                            <!-- Flag -->
                            <img 
                                src="{{ $country->flag }}" 
                                alt="{{ $country->name }} Flag" 
                                class="w-full h-32 object-cover"
                            >
                            <!-- Country Info -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $country->name }}</h3>
                                <p class="text-sm text-gray-600 truncate">
                                    {{ $country->description ?? 'No description available.' }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
