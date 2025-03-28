<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Topic</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
@include('layouts.navigation')

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">


        <!-- Page Title -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Create a New Topic</h2>
        
        <!-- Create Topic Form -->
        <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title (max 60 characters)</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    maxlength="60" 
                    oninput="updateTitleCount(event)" 
                    class="mt-1 block w-full input input-bordered focus:ring focus:ring-blue-300 focus:ring-opacity-50" 
                    placeholder="Enter the topic title" 
                    required
                >
                <p id="titleCounter" class="text-sm text-gray-500 mt-2">
                    Characters remaining: <span id="titleRemaining">60</span>
                </p>
            </div>

            <!-- Content Field -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content (max 3000 characters)</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="6" 
                    maxlength="3000" 
                    oninput="updateContentCount(event)" 
                    class="mt-1 block w-full textarea textarea-bordered focus:ring focus:ring-blue-300 focus:ring-opacity-50" 
                    placeholder="Write your topic content..." 
                    required
                ></textarea>
                <p id="contentCounter" class="text-sm text-gray-500 mt-2">
                    Characters remaining: <span id="contentRemaining">3000</span>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4">
                <a 
                    href="{{ route('forum.index') }}" 
                    class="btn btn-outline btn-error"
                >
                    <i class="fas fa-arrow-left mr-2"></i>Cancel
                </a>
                <button 
                    type="submit" 
                    class="btn btn-primary"
                >
                    <i class="fas fa-paper-plane mr-2"></i>Post Topic
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    function updateTitleCount(event) {
        const maxLength = 60;
        const currentLength = event.target.value.length;
        document.getElementById('titleRemaining').textContent = maxLength - currentLength;
    }

    function updateContentCount(event) {
        const maxLength = 3000;
        const currentLength = event.target.value.length;
        document.getElementById('contentRemaining').textContent = maxLength - currentLength;
    }

    // Initialize counters on page load
    document.addEventListener('DOMContentLoaded', function () {
        const titleField = document.getElementById('title');
        const contentField = document.getElementById('content');

        if (titleField) updateTitleCount({ target: titleField });
        if (contentField) updateContentCount({ target: contentField });
    });
</script>


<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
</footer>
</body>
</html>
