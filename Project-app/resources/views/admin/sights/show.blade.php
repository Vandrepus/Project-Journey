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
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="container mx-auto py-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Sight Details</h1>

            <div class="mb-6">
                <p><strong class="text-gray-800">Name:</strong> {{ $sight->name }}</p>
                <p><strong class="text-gray-800">Country:</strong> {{ $sight->country->name }}</p>
                <p><strong class="text-gray-800">Location:</strong> {{ $sight->location }}</p>
                <p><strong class="text-gray-800">Category:</strong> {{ $sight->category}}</p>
                <p><strong class="text-gray-800">Opening Hours:</strong> {{ $sight->opening_hours }}</p>
                <p><strong class="text-gray-800">Map URL:</strong> 
                    @if($sight->map_url)
                        <a href="{{ $sight->map_url }}" target="_blank" class="text-blue-500 hover:underline">
                            View on Map
                        </a>
                    @else
                        <span class="text-gray-500">None</span>
                    @endif
</p>
                <p><strong class="text-gray-800">Description:</strong> {{ $sight->description }}</p>
                <p><strong class="text-gray-800">Submitted By:</strong> {{ $sight->submittedBy->name ?? 'Unknown' }}</p>
                <p><strong class="text-gray-800">Date Submitted:</strong> {{ $sight->created_at->format('F j, Y') }}</p>
            </div>

            <div class="flex justify-center space-x-4">
                <!-- Approve Button -->
                <form action="{{ route('admin.sights.approve', $sight->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600">
                        Approve
                    </button>
                </form>

                <!-- Decline Button -->
                <form action="{{ route('admin.sights.decline', $sight->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600">
                        Decline
                    </button>
                </form>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.sights.index') }}" class="text-blue-500 hover:underline">
                    Back to Pending Sights
                </a>
            </div>
        </div>
    </div>
</body>
</html>
