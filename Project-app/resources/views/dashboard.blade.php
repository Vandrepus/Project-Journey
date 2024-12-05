<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Welcome to JourneyHub</title>
</head>
<body class="bg-base-100 flex flex-col min-h-screen">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Welcome Section -->
    <header class="bg-primary text-primary-content py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4">Welcome to JourneyHub</h1>
            <p class="text-xl">Your ultimate travel companion for exploring the world and connecting with fellow travelers.</p>
        </div>
    </header>

    <!-- Guide Section -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Getting Started</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Guide Card 1 -->
            <div class="card bg-base-100 shadow-lg hover:shadow-xl">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-user-plus text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-bold">Create Your Profile</h3>
                    <p>Fill in your personal details and tell others about yourself in the "About Me" section.</p>
                </div>
            </div>
            <!-- Guide Card 2 -->
            <div class="card bg-base-100 shadow-lg hover:shadow-xl">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-map-marker-alt text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-bold">Explore New Countries and Locations</h3>
                    <p>Browse through countries and their sights or propose new locations to explore.</p>
                </div>
            </div>
            <!-- Guide Card 3 -->
            <div class="card bg-base-100 shadow-lg hover:shadow-xl">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-comments text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-bold">Join the Forum</h3>
                    <p>Engage in discussions, share your experiences, and connect with fellow travelers.</p>
                </div>
            </div>
            <!-- Guide Card 4 -->
            <div class="card bg-base-100 shadow-lg hover:shadow-xl">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-check-circle text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-bold">Propose a Country and Locations</h3>
                    <p>Suggest new countries to add to our growing collection of travel destinations.</p>
                </div>
            </div>
            <!-- Guide Card 5 -->
            <div class="card bg-base-100 shadow-lg hover:shadow-xl">
                <div class="card-body items-center text-center">
                    <i class="fa-solid fa-envelope text-primary text-5xl mb-4"></i>
                    <h3 class="card-title text-xl font-bold">Contact Us</h3>
                    <p>Have questions? Reach out to our team for support and assistance.</p>
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
