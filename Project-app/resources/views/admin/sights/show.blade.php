<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Sight Details</title>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Sight Details</h1>

            <!-- Sight Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-800 font-semibold">Name:</p>
                    <p class="text-gray-600 break-words">{{ $sight->name }}</p>
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Country:</p>
                    <p class="text-gray-600 break-words">{{ $sight->country->name }}</p>
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Location:</p>
                    <p class="text-gray-600 break-words">{{ $sight->location }}</p>
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Category:</p>
                    <p class="text-gray-600 break-words">{{ $sight->category }}</p>
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Opening Hours:</p>
                    <p class="text-gray-600 break-words">{{ $sight->opening_hours }}</p>
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Map URL:</p>
                    @if($sight->map_url)
                        <a href="{{ $sight->map_url }}" target="_blank" class="text-blue-500 hover:underline break-words">
                            View on Map
                        </a>
                    @else
                        <span class="text-gray-500">None</span>
                    @endif
                </div>
                <div class="col-span-2">
                    <p class="text-gray-800 font-semibold">Description:</p>
                    <p class="text-gray-600 break-words">{{ $sight->description }}</p>
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Submitted By:</p>
                    @if($sight->user)
                        <a href="{{ route('user.profile', $sight->user->username) }}" class="text-blue-500 hover:underline break-words">
                            {{ $sight->user->username }}
                        </a>
                    @else
                        <span class="text-gray-500">Unknown</span>
                    @endif
                </div>
                <div>
                    <p class="text-gray-800 font-semibold">Date Submitted:</p>
                    <p class="text-gray-600 break-words">{{ $sight->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <form action="{{ route('admin.sights.approve', $sight->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this sight?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600 transition duration-150">
                        Approve
                    </button>
                </form>
                <form action="{{ route('admin.sights.decline', $sight->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to decline this sight?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition duration-150">
                        Decline
                    </button>
                </form>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.sights.index') }}" class="text-blue-500 hover:underline">
                    Back to Pending Sights
                </a>
            </div>
        </div>
    </div>
</body>
</html>
