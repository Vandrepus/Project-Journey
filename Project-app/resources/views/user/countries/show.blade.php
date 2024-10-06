<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $country->name }}</title>
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <!-- Country Details -->
            <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $country->name }}</h1>
            <p class="text-gray-600 text-lg mb-8">{{ $country->description }}</p>

            <!-- Sights Section -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Sights</h2>

            @if(count($sights) > 0)
                <ul class="space-y-4">
                    @foreach($sights as $sight)
                        @if($sight->visible) <!-- Only show visible sights -->
                            <li class="flex items-center justify-between p-4 bg-gray-50 rounded-md hover:bg-gray-100 transition">
                                <div class="flex-1">
                                    <a href="{{ route('sights.show', $sight->id) }}" class="text-2xl font-medium text-blue-500 hover:underline">
                                        {{ $sight->name }}
                                    </a>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($sight->description, 150) }}</p>
                                </div>
                                <a href="{{ route('sights.show', $sight->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">No sights available for this country.</p>
            @endif
        </div>
    </div>
</body>
</html>
