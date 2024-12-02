<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Propose Country</title>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-200 min-h-screen flex flex-col">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Propose a Country</h2>

                <!-- Success Notification -->
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M14.348 14.849l-3.849-3.849-3.849 3.849-1.414-1.414 3.849-3.849-3.849-3.849 1.414-1.414 3.849 3.849 3.849-3.849 1.414 1.414-3.849 3.849 3.849 3.849z" />
                            </svg>
                        </button>
                    </div>
                @endif

                <form action="{{ route('countries.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Country Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Country Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Enter the country name"
                        />
                    </div>
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Provide a brief description"
                        ></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Submit Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
