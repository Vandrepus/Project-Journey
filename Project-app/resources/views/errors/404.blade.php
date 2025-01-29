<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>404 - Page Not Found</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-base-200 text-base-content">
    <div class="text-center p-8 shadow-lg bg-white rounded-lg max-w-md">
        <h1 class="text-6xl font-bold text-accent">404</h1>
        <p class="text-lg text-gray-600 mt-4">Sorry, the page you're looking for doesn't exist.</p>
        
        <div class="mt-6">
            <a href="{{ url('/') }}" class="btn btn-accent">
                <i class="fas fa-home mr-2"></i> Return Home
            </a>
        </div>
    </div>
</body>
</html>
