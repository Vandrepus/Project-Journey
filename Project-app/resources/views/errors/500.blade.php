<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>500 - Server Error</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-base-200 text-base-content">
    <div class="text-center p-8 shadow-lg bg-white rounded-lg max-w-md">
        <h1 class="text-6xl font-bold text-error">500</h1>
        <p class="text-lg text-gray-600 mt-4">Something went wrong on our end. Please try again later.</p>
        
        <div class="mt-6">
            <a href="{{ url('/') }}" class="btn btn-error">
                <i class="fas fa-redo-alt mr-2"></i> Try Again
            </a>
        </div>
    </div>
</body>
</html>
