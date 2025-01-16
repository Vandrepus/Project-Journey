<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Edit Sight</title>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Container -->
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                <i class="fas fa-edit mr-2"></i>Edit Sight
            </h1>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success shadow-lg mb-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-error shadow-lg mb-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-exclamation-circle text-lg"></i>
                        <span>There were some errors with your submission.</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.sights.update', $sight->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text font-medium">Name</span>
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="input input-bordered w-full" 
                        value="{{ $sight->name }}" 
                        placeholder="E.g., Eiffel Tower" 
                        required 
                    />
                </div>

                <!-- Country -->
                <div class="form-control">
                    <label class="label" for="country_id">
                        <span class="label-text font-medium">Country</span>
                    </label>
                    <select id="country_id" name="country_id" class="select select-bordered w-full">
                        <option disabled>Select a Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if($country->id == $sight->country_id) selected @endif>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Location -->
                <div class="form-control">
                    <label class="label" for="location">
                        <span class="label-text font-medium">Location</span>
                    </label>
                    <input 
                        id="location" 
                        name="location" 
                        type="text" 
                        class="input input-bordered w-full" 
                        value="{{ $sight->location }}" 
                        placeholder="E.g., Paris, France" 
                        required 
                    />
                </div>

                <!-- Category -->
                <div class="form-control">
                    <label class="label" for="category">
                        <span class="label-text font-medium">Category</span>
                    </label>
                    <input 
                        id="category" 
                        name="category" 
                        type="text" 
                        class="input input-bordered w-full" 
                        value="{{ $sight->category }}" 
                        placeholder="E.g., Landmark, Museum, etc." 
                        required 
                    />
                </div>

                <!-- Opening Hours -->
                <div class="form-control">
                    <label class="label" for="opening_hours">
                        <span class="label-text font-medium">Opening Hours</span>
                    </label>
                    <input 
                        id="opening_hours" 
                        name="opening_hours" 
                        type="text" 
                        class="input input-bordered w-full" 
                        value="{{ old('opening_hours', $sight->opening_hours) }}" 
                        placeholder="E.g., 9 AM - 5 PM" 
                    />
                    @error('opening_hours')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Map URL -->
                <div class="form-control">
                    <label class="label" for="map_url">
                        <span class="label-text font-medium">Map URL</span>
                    </label>
                    <input 
                        id="map_url" 
                        name="map_url" 
                        type="url" 
                        class="input input-bordered w-full" 
                        value="{{ $sight->map_url }}" 
                        placeholder="E.g., https://maps.google.com/..." 
                    />
                </div>

                <!-- Description -->
                <div class="form-control">
                    <label class="label" for="description">
                        <span class="label-text font-medium">Description</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4" 
                        class="textarea textarea-bordered w-full" 
                        placeholder="Write a detailed description..."
                    >{{ $sight->description }}</textarea>
                </div>

                <!-- Save and Cancel Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.sights.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
