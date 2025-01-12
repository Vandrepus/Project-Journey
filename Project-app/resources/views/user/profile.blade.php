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
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Profile Container -->
    <div class="container mx-auto py-12 px-6">
        <div class="card max-w-4xl mx-auto bg-white shadow-xl">
            <!-- Header -->
            <div class="card-body">
                <div class="flex items-center mb-6">
                    <!-- Profile Picture -->
                    <div class="avatar">
                        <div class="w-16 rounded-full bg-gray-200">
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" />
                            @else
                                <i class="fas fa-user text-gray-600 text-2xl flex items-center justify-center h-full w-full"></i>
                            @endif
                        </div>
                    </div>
                    <!-- Name and Username -->
                    <div class="ml-4">
                        <h1 class="text-3xl font-bold text-gray-800">
                            {{ $user->name }} {{ $user->surname }}
                            @if($user->usertype === 'admin')
                                <span class="badge badge-error text-lg font-semibold ml-2">ADMIN</span>
                            @endif
                        </h1>
                        <p class="text-sm text-gray-600 mt-1">
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

                <!-- Favorite Places Section -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-heart text-red-500 mr-2"></i> Favorite Places
                    </h2>
                    @if($user->favoriteSights->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                            @foreach($user->favoriteSights as $sight)
                            <div class="card shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 bg-base-100">
                                <figure>
                                    <img 
                                        src="{{ $sight->image_url ?? 'https://via.placeholder.com/300x200' }}" 
                                        alt="{{ $sight->name }}" 
                                        class="rounded-t-lg object-cover w-full h-48"
                                    >
                                </figure>
                                <div class="card-body p-4">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $sight->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ Str::limit($sight->description, 100) }}</p>
                                    <div class="mt-4 flex justify-center">
                                        <a 
                                            href="{{ route('sights.show', $sight) }}" 
                                            class="btn btn-link text-blue-500 hover:text-blue-600 text-sm"
                                        >
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-4 text-gray-500 italic">No favorite places added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
