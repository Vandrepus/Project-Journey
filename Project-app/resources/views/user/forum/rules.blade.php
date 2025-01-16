<!-- resources/views/user/forum/rules.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Forum Rules and Guidelines</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
@include('layouts.navigation')

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Forum Rules and Guidelines</h1>

        <p class="mb-4 text-gray-600">
            Welcome to the forum! To ensure a respectful and enjoyable experience for everyone, please follow these rules and guidelines:
        </p>

        <ol class="list-decimal list-inside text-gray-700 space-y-3">
            <li><strong>Be Respectful:</strong> Treat all members with respect. Avoid offensive, discriminatory, or inappropriate language.</li>
            <li><strong>Stay on Topic:</strong> Make sure your posts and comments are relevant to the forum topics.</li>
            <li><strong>No Spam:</strong> Avoid posting irrelevant content, advertisements, or repeated messages.</li>
            <li><strong>Protect Privacy:</strong> Do not share personal or sensitive information about yourself or others.</li>
            <li><strong>Report Issues:</strong> If you see inappropriate content or behavior, report it to the moderators.</li>
            <li><strong>Original Content:</strong> Share only your own content or content you have permission to use, and give proper credit where it's due.</li>
            <li><strong>Follow Admin Instructions:</strong> Respect the decisions and instructions of forum moderators and administrators.</li>
            <li><strong>Use Search:</strong> Before starting a new topic, use the search function to ensure the subject hasn’t been discussed already.</li>
            <li><strong>No Illegal Content:</strong> Do not post or share content that violates laws or forum policies.</li>
        </ol>

        <p class="mt-6 text-gray-600">
            By participating in this forum, you agree to adhere to these rules and understand that violations may result in warnings, post removal, or banning from the forum.
        </p>

        <div class="mt-8">
            <a href="{{ route('forum.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Forum
            </a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
</footer>
</body>
</html>
