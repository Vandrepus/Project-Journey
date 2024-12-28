<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Welcome to JourneyHub</title>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Welcome Section -->
    <header class="bg-primary text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4">Welcome to JourneyHub</h1>
            <p class="text-lg">Your ultimate travel companion for exploring the world and connecting with fellow travelers.</p>
        </div>
    </header>

    <!-- Guide Section -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Getting Started</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Guide Card 1 -->
            <a href="{{ route('profile.edit') }}" class="card bg-white shadow hover:shadow-md hover:bg-gray-50 transition-transform transform hover:scale-105">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-user-plus text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-semibold text-gray-800">Create Your Profile</h3>
                    <p class="text-gray-600">Fill in your personal details and tell others about yourself in the "About Me" section.</p>
                </div>
            </a>
            <!-- Guide Card 2 -->
            <a href="{{ route('countries.index') }}" class="card bg-white shadow hover:shadow-md hover:bg-gray-50 transition-transform transform hover:scale-105">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-map-marker-alt text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-semibold text-gray-800">Explore New Countries</h3>
                    <p class="text-gray-600">Browse through countries and their sights or propose new locations to explore.</p>
                </div>
            </a>
            <!-- Guide Card 3 -->
            <a href="{{ route('forum.index') }}" class="card bg-white shadow hover:shadow-md hover:bg-gray-50 transition-transform transform hover:scale-105">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-comments text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-semibold text-gray-800">Join the Forum</h3>
                    <p class="text-gray-600">Engage in discussions, share your experiences, and connect with fellow travelers.</p>
                </div>
            </a>
            <!-- Guide Card 4 -->
            <a href="{{ route('countries.propose') }}" class="card bg-white shadow hover:shadow-md hover:bg-gray-50 transition-transform transform hover:scale-105">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-check-circle text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-semibold text-gray-800">Propose Destinations</h3>
                    <p class="text-gray-600">Suggest new countries and sights to add to our travel database.</p>
                </div>
            </a>
            <!-- Guide Card 5 -->
            <a href="{{ route('support.index') }}" class="card bg-white shadow hover:shadow-md hover:bg-gray-50 transition-transform transform hover:scale-105">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-envelope text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-semibold text-gray-800">Contact Support</h3>
                    <p class="text-gray-600">Have questions? Reach out to our team for support and assistance.</p>
                </div>
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <div class="container mx-auto">
            <p class="text-lg">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
            <p class="text-sm mt-1">Designed with ❤️ by the JourneyHub Team</p>
        </div>
    </footer>
</body>
</html>
