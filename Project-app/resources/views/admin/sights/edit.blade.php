<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- DaisyUI CDN -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Edit Sight</title>
</head>
<body class="bg-gradient-to-b from-gray-100 to-gray-300 min-h-screen flex flex-col">
  @include('layouts.navigation')

  <!-- Main Container -->
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
      <!-- Header -->
      <div class="bg-indigo-600 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Edit Sight</h1>
        <p class="text-sm text-indigo-200">Update the sight details below</p>
      </div>

      <!-- Form Content -->
      <div class="p-8">
        @if ($errors->any())
          <div class="alert alert-error shadow-lg mb-6">
            <ul>
              @foreach ($errors->all() as $error)
                <li class="text-red-600">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.sights.update', $sight->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
          @csrf
          @method('PUT')

          <!-- Basic Details Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Sight Name -->
            <div class="form-control">
              <label for="name" class="label">
                <span class="label-text font-semibold">Sight Name</span>
              </label>
              <input type="text" name="name" id="name" value="{{ old('name', $sight->name) }}" class="input input-bordered w-full" placeholder="Enter sight name" required />
            </div>

            <!-- Country -->
            <div class="form-control">
              <label for="country_id" class="label">
                <span class="label-text font-semibold">Country</span>
              </label>
              <select id="country_id" name="country_id" class="select select-bordered">
                <option disabled>Select a Country</option>
                @foreach($countries as $country)
                  <option value="{{ $country->id }}" @if($country->id == $sight->country_id) selected @endif>
                    {{ $country->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Location -->
            <div class="form-control">
              <label for="location" class="label">
                <span class="label-text font-semibold">Location</span>
              </label>
              <input type="text" name="location" id="location" value="{{ old('location', $sight->location) }}" class="input input-bordered w-full" placeholder="Enter sight location" required />
            </div>

            <!-- Category -->
            <div class="form-control">
              <label for="category" class="label">
                <span class="label-text font-semibold">Category</span>
              </label>
              <input type="text" name="category" id="category" value="{{ old('category', $sight->category) }}" class="input input-bordered w-full" placeholder="E.g., Landmark, Museum, Natural Wonder" required />
            </div>
          </div>

          <!-- Opening Hours -->
          <div class="form-control">
            <label for="opening_hours" class="label">
              <span class="label-text font-semibold">Opening Hours</span>
            </label>
            <input type="text" id="opening_hours" name="opening_hours" class="input input-bordered w-full" value="{{ old('opening_hours', $sight->opening_hours) }}" placeholder="E.g., 9 AM - 5 PM" />
            @error('opening_hours')
              <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
          </div>

          <!-- Map URL -->
          <div class="form-control">
            <label for="map_url" class="label">
              <span class="label-text font-semibold">Map URL</span>
            </label>
            <input type="url" id="map_url" name="map_url" class="input input-bordered w-full" value="{{ old('map_url', $sight->map_url) }}" placeholder="E.g., https://maps.google.com/..." />
          </div>

          <!-- Description -->
          <div class="form-control">
            <label for="description" class="label">
              <span class="label-text font-semibold">Description</span>
            </label>
            <textarea id="description" name="description" rows="4" maxlength="3000" class="textarea textarea-bordered w-full" placeholder="Enter a detailed description">{{ old('description', $sight->description) }}</textarea>
          </div>

          <!-- Current Photo Preview -->
          @if ($sight->photo)
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold">Current Photo</span>
              </label>
              <img src="{{ asset('storage/' . $sight->photo) }}" alt="{{ $sight->name }}" class="w-56 h-40 object-cover rounded-md shadow-md">
            </div>
          @endif

          <!-- New Photo Upload -->
          <div class="form-control">
            <label for="photo" class="label">
              <span class="label-text font-semibold">Upload New Photo</span>
            </label>
            <div class="mt-2 flex items-center justify-center w-full">
              <label for="photo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg class="w-10 h-10 mb-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7l-4-4H4z" />
                  </svg>
                  <p class="mb-2 text-sm text-gray-500">
                    <span class="font-semibold">Click to upload</span>
                  </p>
                  <p class="text-xs text-gray-500">PNG, JPG, JPEG (max. 2MB)</p>
                </div>
                <input id="photo" name="photo" type="file" accept="image/*" class="hidden" onchange="previewNewPhoto(event)" />
              </label>
            </div>
            <!-- New Photo Preview -->
            <div id="newPhotoPreviewContainer" class="mt-4 hidden">
              <p class="text-sm text-gray-500 mb-2">New Photo Preview:</p>
              <img id="newPhotoPreview" src="#" alt="New Photo Preview" class="w-56 h-40 object-cover rounded-md shadow-md">
            </div>
            @error('photo')
              <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
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
