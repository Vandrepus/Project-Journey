<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous">
    <title>View Message</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 flex-grow">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Message Details</h1>
            <p class="text-gray-700"><strong>Name:</strong> {{ $message->name }}</p>
            <p class="text-gray-700"><strong>Email:</strong> {{ $message->email }}</p>
            <p class="text-gray-700"><strong>Subject:</strong> {{ $message->subject }}</p>
            <p class="mt-4 text-gray-700"><strong>Message:</strong></p>
            <!-- Tailwind utility classes for word break -->
            <p class="mt-2 text-gray-700 leading-relaxed break-words whitespace-pre-wrap">{{ $message->message }}</p>
            <p class="mt-4 text-sm text-gray-500">Sent on: {{ $message->created_at->format('Y-m-d H:i') }}</p>

            <!-- Back Button -->
            <div class="mt-6">
                <a 
                    href="{{ route('admin.contact-messages.index') }}" 
                    class="btn btn-primary flex items-center gap-2"
                >
                    <i class="fas fa-arrow-left"></i> Back to Messages
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
