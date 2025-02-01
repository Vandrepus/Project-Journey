<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $sight->name }} - Sight Details</title>
</head>
<body class="bg-base-200 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="card bg-white shadow-xl p-6">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800">{{ $sight->name }} - Sight Details</h1>
                <p class="text-gray-600 mt-2">{{ $sight->category }}</p>
            </div>

            <!-- Photo Preview -->
            <div class="mt-6 flex justify-center">
                @if($sight->photo)
                    <img src="{{ asset('storage/' . $sight->photo) }}" 
                        alt="{{ $sight->name }} Photo" 
                        class="w-56 h-auto rounded-lg shadow-md">
                @else
                    <p class="text-center text-gray-500">No photo available.</p>
                @endif
            </div>


            <!-- Sight Information Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <div>
                    <p class="font-semibold text-gray-800">Country:</p>
                    <p class="text-gray-600">{{ $sight->country->name }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Location:</p>
                    <p class="text-gray-600">{{ $sight->location }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Opening Hours:</p>
                    <p class="text-gray-600">{{ $sight->opening_hours ?? 'Not available' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Map:</p>
                    @if($sight->map_url)
                        <a href="{{ $sight->map_url }}" target="_blank" class="text-blue-500 hover:underline">View on Map</a>
                    @else
                        <span class="text-gray-500">No map available</span>
                    @endif
                </div>
                <div class="col-span-2">
                    <p class="font-semibold text-gray-800">Description:</p>
                    <p class="text-gray-600">{{ $sight->description }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Submitted By:</p>
                    @if($sight->user)
                        <a href="{{ route('user.profile', $sight->user->username) }}" class="text-blue-500 hover:underline">
                            {{ $sight->user->username }}
                        </a>
                    @else
                        <span class="text-gray-500">Unknown</span>
                    @endif
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Date Submitted:</p>
                    <p class="text-gray-600">{{ $sight->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <form action="{{ route('admin.sights.approve', $sight->id) }}" method="POST" onsubmit="return confirm('Approve this sight?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success w-full sm:w-auto">
                        <i class="fas fa-check-circle mr-2"></i> Approve
                    </button>
                </form>
                <form action="{{ route('admin.sights.decline', $sight->id) }}" method="POST" onsubmit="return confirm('Decline this sight?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error w-full sm:w-auto">
                        <i class="fas fa-times-circle mr-2"></i> Decline
                    </button>
                </form>
                <a href="{{ route('admin.sights.edit', $sight->id) }}" class="btn btn-warning w-full sm:w-auto">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.sights.index') }}" class="btn btn-outline btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Pending Sights
                </a>
            </div>
        </div>
    </div>
</body>
</html>
