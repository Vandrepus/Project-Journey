<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>User Profile</title>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Profile Container -->
    <div class="container mx-auto py-12 px-6">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex items-center mb-6">
                <!-- Profile Picture -->
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                    @if ($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-user text-gray-600 text-2xl"></i>
                    @endif
                </div>
                <!-- Name and Username -->
                <div class="ml-4">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }} {{ $user->surname }}</h1>
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-user-circle mr-2"></i>Username: <span class="font-medium">{{ $user->username }}</span>
                    </p>
                </div>
            </div>

            <!-- About Section -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i> About Me
                </h2>
                @if($user->about_me)
                    <p class="mt-2 text-gray-700 leading-relaxed">{{ $user->about_me }}</p>
                @else
                    <p class="mt-2 text-gray-500 italic">No information available.</p>
                @endif
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
