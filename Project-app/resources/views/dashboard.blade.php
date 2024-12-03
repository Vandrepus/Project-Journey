<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Welcome to JourneyHub</title>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-200 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Welcome Section -->
    <header class="bg-indigo-600 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to JourneyHub</h1>
            <p class="text-lg">Your ultimate travel companion for exploring the world and connecting with fellow travelers.</p>
        </div>
    </header>

    <!-- Guide Section -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Getting Started</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Guide Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-user-plus text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Create Your Profile</h3>
                <p class="text-gray-600">Fill in your personal details and tell others about yourself in the "About Me" section.</p>
            </div>
            <!-- Guide Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-map-marker-alt text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Explore New Countries and Locations</h3>
                <p class="text-gray-600">Browse through countries and their sights or propose new locations to explore.</p>
            </div>
            <!-- Guide Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-comments text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Join the Forum</h3>
                <p class="text-gray-600">Engage in discussions, share your experiences, and connect with fellow travelers.</p>
            </div>
            <!-- Guide Card 4 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-check-circle text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Propose a Country and Locations</h3>
                <p class="text-gray-600">Suggest new countries to add to our growing collection of travel destinations.</p>
            </div>
            <!-- Guide Card 5 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-envelope text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Contact Us</h3>
                <p class="text-gray-600">Have questions? Reach out to our team for support and assistance.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
