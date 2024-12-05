<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Propose a New Sight</title>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-200 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Propose a New Sight</h1>

            <!-- Success Notification -->
            @if (session('success'))
                <div class="alert alert-success shadow-lg mb-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('location.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Country Selection -->
                <div>
                    <label for="country_id" class="block text-sm font-medium text-gray-700">Select Country</label>
                    <select name="country_id" id="country_id" required class="select select-bordered w-full mt-1">
                        <option value="" disabled selected>Select a country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sight Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Sight Name</label>
                    <input type="text" name="name" id="name" required class="input input-bordered w-full mt-1" placeholder="Enter sight name" />
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" required class="textarea textarea-bordered w-full mt-1" placeholder="Provide a brief description"></textarea>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" required class="input input-bordered w-full mt-1" placeholder="Enter the location" />
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" name="category" id="category" required class="input input-bordered w-full mt-1" placeholder="Enter the category" />
                </div>

                <!-- Opening Hours -->
                <div>
                    <label for="opening_hours" class="block text-sm font-medium text-gray-700">Opening Hours</label>
                    <input type="text" name="opening_hours" id="opening_hours" required class="input input-bordered w-full mt-1" placeholder="e.g., 9 AM - 5 PM" />
                </div>

                <!-- Map URL -->
                <div>
                    <label for="map_url" class="block text-sm font-medium text-gray-700">Map URL (Optional)</label>
                    <input type="url" name="map_url" id="map_url" class="input input-bordered w-full mt-1" placeholder="Paste a map URL (optional)" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="btn btn-primary w-full md:w-auto px-6 py-3">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Submit Proposal
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
