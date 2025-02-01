<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- DaisyUI CDN -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Edit Sight</title>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
  @include('layouts.navigation')

  <!-- Main Container -->
  <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="card w-full max-w-2xl mx-auto bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title justify-center">
          <i class="fas fa-edit mr-2"></i>Edit Sight
        </h2>
        <div class="divider"></div>

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

        <form action="{{ route('admin.sights.update', $sight->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf
          @method('PUT')

          <!-- Name -->
          <div class="form-control">
            <label for="name" class="label">
              <span class="label-text">Name</span>
            </label>
            <input type="text" id="name" name="name" class="input input-bordered" value="{{ $sight->name }}" placeholder="E.g., Eiffel Tower" required />
          </div>

          <!-- Country -->
          <div class="form-control">
            <label for="country_id" class="label">
              <span class="label-text">Country</span>
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

          <!-- Location -->
          <div class="form-control">
            <label for="location" class="label">
              <span class="label-text">Location</span>
            </label>
            <input type="text" id="location" name="location" class="input input-bordered" value="{{ $sight->location }}" placeholder="E.g., Paris, France" required />
          </div>

          <!-- Category -->
          <div class="form-control">
            <label for="category" class="label">
              <span class="label-text">Category</span>
            </label>
            <input type="text" id="category" name="category" class="input input-bordered" value="{{ $sight->category }}" placeholder="E.g., Landmark, Museum" required />
          </div>

          <!-- Opening Hours -->
          <div class="form-control">
            <label for="opening_hours" class="label">
              <span class="label-text">Opening Hours</span>
            </label>
            <input type="text" id="opening_hours" name="opening_hours" class="input input-bordered" value="{{ old('opening_hours', $sight->opening_hours) }}" placeholder="E.g., 9 AM - 5 PM" />
            @error('opening_hours')
              <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
          </div>

          <!-- Map URL -->
          <div class="form-control">
            <label for="map_url" class="label">
              <span class="label-text">Map URL</span>
            </label>
            <input type="url" id="map_url" name="map_url" class="input input-bordered" value="{{ $sight->map_url }}" placeholder="E.g., https://maps.google.com/..." />
          </div>

          <!-- Description -->
          <div class="form-control">
            <label for="description" class="label">
              <span class="label-text">Description</span>
            </label>
            <textarea id="description" name="description" rows="4" maxlength="3000" class="textarea textarea-bordered" placeholder="Write a detailed description (max 3000 characters)..." oninput="updateCharacterCount(event)">{{ $sight->description }}</textarea>
            <p id="descriptionCounter" class="text-sm text-gray-500 mt-2">
              Characters remaining: <span id="remainingCharacters">3000</span>
            </p>
          </div>

          <!-- Photo Upload with Preview -->
          <div class="form-control">
            <label for="photo" class="label">
              <span class="label-text">Photo</span>
            </label>
            <!-- Current Photo Preview -->
            @if($sight->photo)
              <div class="mb-4">
                <img id="photoPreview" src="{{ asset('storage/' . $sight->photo) }}" alt="Current Photo" class="w-40 object-cover rounded-lg shadow-md" />
              </div>
            @else
              <div class="mb-4">
                <p class="text-sm text-gray-500">No photo uploaded.</p>
              </div>
            @endif

            <!-- Input for New Photo -->
            <input type="file" id="photo" name="photo" accept="image/*" class="file-input file-input-bordered" onchange="previewNewPhoto(event)" />

            <!-- New Photo Preview -->
            <div class="mt-4 hidden" id="newPhotoContainer">
              <p class="text-sm text-gray-700">New photo preview:</p>
              <img id="newPhotoPreview" src="#" alt="New Photo Preview" class="w-40 object-cover rounded-lg shadow-md" />
            </div>
            @error('photo')
              <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
          </div>

          <!-- Save and Cancel Buttons -->
          <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.sights.index') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function previewNewPhoto(event) {
      const file = event.target.files[0];
      const previewContainer = document.getElementById('newPhotoContainer');
      const previewImage = document.getElementById('newPhotoPreview');

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        previewContainer.classList.add('hidden');
      }
    }

    function updateCharacterCount(event) {
      const maxLength = 3000;
      const currentLength = event.target.value.length;
      const remainingCharacters = maxLength - currentLength;
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

  <footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
  </footer>
</body>
</html>
