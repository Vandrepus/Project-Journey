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
<body class="bg-base-200 min-h-screen flex flex-col">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-base-100 shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Explore Countries</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($countries as $country)
                <div class="card card-compact bg-base-100 shadow hover:shadow-lg transition duration-300">
                    <a href="{{ route('countries.show', $country->id) }}">
                        <figure>
                            <img 
                                src="{{ $country->flag ?? 'https://via.placeholder.com/300x200?text=No+Flag' }}" 
                                alt="{{ $country->name }} Flag" 
                                class="w-full h-32 object-cover"
                            />
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title text-lg font-semibold">{{ $country->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $country->description ?? 'No description available.' }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
