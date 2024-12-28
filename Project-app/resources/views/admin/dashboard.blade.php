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
<body class="bg-gradient-to-br from-gray-100 to-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="container mx-auto py-12 px-6">
        <div class="bg-white rounded-lg shadow-md p-8 space-y-8">
            <!-- Welcome Section -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-lg text-gray-600 mt-2">Welcome, Admin! Manage the platform efficiently while adhering to the guidelines below.</p>
            </div>

            <!-- Admin Rules -->
            <div class="bg-gray-50 rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-gavel text-red-500 mr-3"></i> Admin Rules
                </h2>
                <ul class="list-disc list-inside text-gray-700 mt-4 space-y-4">
                    <li><strong>Data Security:</strong> Always ensure the confidentiality and security of user data by following platform policies and best practices.</li>
                    <li><strong>Approval Process:</strong> Approve or decline submissions (locations, countries, and tickets) strictly based on platform guidelines and avoid bias.</li>
                    <li><strong>Support Management:</strong> Resolve user support tickets promptly, professionally, and with empathy to maintain platform trust.</li>
                    <li><strong>Neutrality:</strong> Treat all users equally without favoritism or prejudice in decision-making.</li>
                    <li><strong>Confidentiality:</strong> Avoid sharing sensitive user information or platform data with unauthorized individuals.</li>
                    <li><strong>Compliance:</strong> Ensure all administrative actions align with the platform’s terms, conditions, and regulatory requirements.</li>
                    <li><strong>Content Moderation:</strong> Regularly review and moderate user-generated content to maintain community standards and remove inappropriate content.</li>
                    <li><strong>Communication:</strong> Keep users informed about updates, decisions, or clarifications when their submissions or issues are reviewed.</li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-tools text-blue-500 mr-3"></i> Quick Actions
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Manage Users -->
                    <a href="{{ route('admin.users.index') }}" class="bg-blue-100 hover:bg-blue-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-users text-blue-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-blue-800">Manage Users</p>
                    </a>

                    <!-- Review Locations -->
                    <a href="{{ route('admin.sights.index') }}" class="bg-green-100 hover:bg-green-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-map-marked-alt text-green-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-green-800">Review Locations</p>
                    </a>

                    <!-- Review Countries -->
                    <a href="{{ route('admin.countries.index') }}" class="bg-yellow-100 hover:bg-yellow-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-globe text-yellow-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-yellow-800">Review Countries</p>
                    </a>

                    <!-- Manage Tickets -->
                    <a href="{{ route('admin.tickets.index') }}" class="bg-red-100 hover:bg-red-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-ticket-alt text-red-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-red-800">Manage Tickets</p>
                    </a>

                    <!-- Check Messages -->
                    <a href="{{ route('admin.contact-messages.index') }}" class="bg-purple-100 hover:bg-purple-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-envelope text-purple-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-purple-800">Check Messages</p>
                    </a>

                    <!-- View Reports -->
                    <a href="{{ route('admin.reports.index') }}" class="bg-indigo-100 hover:bg-indigo-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-flag text-indigo-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-indigo-800">View Reports</p>
                    </a>

                    <!-- Write News -->
                    <a href="{{ route('articles.index') }}" class="bg-orange-100 hover:bg-orange-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-pen text-orange-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-orange-800">Write News</p>
                    </a>

                    <!-- Manage Countries -->
                    <a href="{{ route('countries.index') }}" class="bg-teal-100 hover:bg-teal-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-map text-teal-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-teal-800">Manage Countries</p>
                    </a>

                    <!-- Forum Moderation -->
                    <a href="{{ route('forum.index') }}" class="bg-indigo-100 hover:bg-indigo-200 rounded-lg p-6 shadow-md flex flex-col items-center transition-transform transform hover:scale-105">
                        <i class="fas fa-comments text-indigo-500 text-5xl mb-4"></i>
                        <p class="text-lg font-semibold text-indigo-800">Forum Moderation</p>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
