<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Edit Country</title>
</head>
<body class="bg-gradient-to-b from-gray-100 to-gray-300 min-h-screen flex flex-col">
    @include('layouts.navigation')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-indigo-600 text-white text-center py-6">
                <h1 class="text-3xl font-bold">Edit Country</h1>
                <p class="text-sm text-indigo-200">Make changes to the country details and update its information</p>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <!-- Success Notification -->
                @if(session('success'))
                <div class="alert alert-success shadow-lg mb-6">
                    <div class="flex items-center space-x-2">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-error shadow-lg mb-6">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600">{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.country.update', $country->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- Country Name -->
                    <div class="form-control">
                        <label for="name" class="label">
                            <span class="label-text font-semibold">Country Name</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $country->name) }}" class="input input-bordered w-full" placeholder="Enter country name" required />
                    </div>

                    <!-- Capital -->
                    <div class="form-control">
                        <label for="capital" class="label">
                            <span class="label-text font-semibold">Capital</span>
                        </label>
                        <input type="text" name="capital" id="capital" value="{{ old('capital', $country->capital) }}" class="input input-bordered w-full" placeholder="Enter capital city" required />
                    </div>

                    <!-- Description -->
                    <div class="form-control">
                        <label for="description" class="label">
                            <span class="label-text font-semibold">Description</span>
                        </label>
                        <textarea name="description" id="description" rows="4" class="textarea textarea-bordered w-full" placeholder="Enter a detailed description">{{ old('description', $country->description) }}</textarea>
                    </div>

                    <!-- Current Picture -->
                    @if ($country->picture)
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Current Picture</span>
                            </label>
                            <img src="{{ asset('storage/' . $country->picture) }}" alt="{{ $country->name }}" class="w-56 h-40 object-cover rounded-md shadow-md">
                        </div>
                    @endif

                    <!-- New Picture Upload -->
                    <div class="form-control">
                        <label for="picture" class="label">
                            <span class="label-text font-semibold">Upload New Picture</span>
                        </label>
                        <div class="mt-2 flex items-center justify-center w-full">
                            <label for="picture" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7l-4-4H4z" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span>
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (max. 2MB)</p>
                                </div>
                                <input id="picture" name="picture" type="file" accept="image/*" class="hidden" onchange="previewNewPhoto(event)" />
                            </label>
                        </div>
                        <!-- New Photo Preview -->
                        <div id="newPhotoPreviewContainer" class="mt-4 hidden">
                            <p class="text-sm text-gray-500 mb-2">New Picture Preview:</p>
                            <img id="newPhotoPreview" src="#" alt="New Picture Preview" class="w-56 h-40 object-cover rounded-md shadow-md">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="btn btn-primary px-6 py-3">
                            <i class="fa-solid fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        function previewNewPhoto(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('newPhotoPreviewContainer');
            const previewImage = document.getElementById('newPhotoPreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
