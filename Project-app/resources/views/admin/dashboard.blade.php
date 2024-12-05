<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto bg-base-100 p-8 rounded-lg shadow-lg">
            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>
            <p class="text-lg text-gray-600 mb-4">Welcome, Admin! Please adhere to the following rules while performing your tasks:</p>
            
            <!-- Admin Rules Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Rules to Follow</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Ensure all user data is handled securely and confidentially.</li>
                    <li>Approve or decline submissions (locations, countries, tickets) based on the platform’s guidelines.</li>
                    <li>Resolve support tickets promptly and professionally.</li>
                    <li>Maintain neutrality and avoid favoritism in decision-making.</li>
                    <li>Do not share sensitive information about users or the platform with unauthorized individuals.</li>
                    <li>Ensure your actions align with the platform’s terms and policies.</li>
                </ul>
            </div>

            <!-- Quick Actions Section -->
            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Action Card: Manage Users -->
                    <a href="{{ route('admin.users.index') }}" class="card bg-blue-100 shadow-lg hover:bg-blue-200 transition duration-200">
                        <div class="card-body items-center text-center">
                            <i class="fas fa-users text-blue-600 text-4xl"></i>
                            <p class="mt-2 text-lg font-semibold text-blue-800">Manage Users</p>
                        </div>
                    </a>
                    
                    <!-- Action Card: Review Locations -->
                    <a href="{{ route('admin.sights.index') }}" class="card bg-green-100 shadow-lg hover:bg-green-200 transition duration-200">
                        <div class="card-body items-center text-center">
                            <i class="fas fa-map-marked-alt text-green-600 text-4xl"></i>
                            <p class="mt-2 text-lg font-semibold text-green-800">Review Locations</p>
                        </div>
                    </a>
                    
                    <!-- Action Card: Review Countries -->
                    <a href="{{ route('admin.countries.index') }}" class="card bg-yellow-100 shadow-lg hover:bg-yellow-200 transition duration-200">
                        <div class="card-body items-center text-center">
                            <i class="fas fa-globe text-yellow-600 text-4xl"></i>
                            <p class="mt-2 text-lg font-semibold text-yellow-800">Review Countries</p>
                        </div>
                    </a>
                    
                    <!-- Action Card: Manage Tickets -->
                    <a href="{{ route('admin.tickets.index') }}" class="card bg-red-100 shadow-lg hover:bg-red-200 transition duration-200">
                        <div class="card-body items-center text-center">
                            <i class="fas fa-ticket-alt text-red-600 text-4xl"></i>
                            <p class="mt-2 text-lg font-semibold text-red-800">Manage Tickets</p>
                        </div>
                    </a>
                    
                    <!-- Action Card: Check Messages -->
                    <a href="{{ route('admin.contact-messages.index') }}" class="card bg-purple-100 shadow-lg hover:bg-purple-200 transition duration-200">
                        <div class="card-body items-center text-center">
                            <i class="fas fa-envelope text-purple-600 text-4xl"></i>
                            <p class="mt-2 text-lg font-semibold text-purple-800">Check Messages</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
