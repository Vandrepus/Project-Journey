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
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Propose a Country</h2>

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

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error shadow-lg mb-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                                <br />
                            @endforeach
                        </span>
                    </div>
                </div>
            @endif

            <!-- Propose Country Form -->
            <form action="{{ route('countries.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Country Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Country Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input input-bordered w-full mt-1"
                        required
                        placeholder="Enter the country name"
                    />
                </div>

                <!-- Capital -->
                <div>
                    <label for="capital" class="block text-sm font-medium text-gray-700">Capital</label>
                    <input
                        type="text"
                        name="capital"
                        id="capital"
                        class="input input-bordered w-full mt-1"
                        required
                        placeholder="Enter the country's capital"
                    />
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="5"
                        maxlength="3000"
                        oninput="updateCharacterCount(event)"
                        class="textarea textarea-bordered w-full mt-1"
                        placeholder="Provide a brief description (max 3000 characters)"
                    ></textarea>
                    <p id="descriptionCounter" class="text-sm text-gray-500 mt-2">
                        Characters remaining: <span id="remainingCharacters">3000</span>
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="btn btn-primary w-full md:w-auto px-6 py-3"
                    >
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

    <!-- JavaScript for Character Counter -->
    <script>
        function updateCharacterCount(event) {
            const maxLength = 3000;
            const currentLength = event.target.value.length;
            const remainingCharacters = maxLength - currentLength;

            // Update the counter display
            document.getElementById('remainingCharacters').textContent = remainingCharacters;
        }

        // Initialize counter if textarea already has content
        document.addEventListener('DOMContentLoaded', function () {
            const descriptionField = document.getElementById('description');
            if (descriptionField) {
                updateCharacterCount({ target: descriptionField });
            }
        });
    </script>
</body>
</html>
