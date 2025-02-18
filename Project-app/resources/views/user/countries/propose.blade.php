<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" 
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
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
                {{ $error }}<br />
              @endforeach
            </span>
          </div>
        </div>
      @endif

      <!-- Propose Country Form -->
      <!-- Note the addition of enctype="multipart/form-data" -->
      <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Country Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Country Name</label>
          <input type="text" name="name" id="name" class="input input-bordered w-full mt-1" required placeholder="Enter the country name" />
        </div>

        <!-- Capital -->
        <div>
          <label for="capital" class="block text-sm font-medium text-gray-700">Capital</label>
          <input type="text" name="capital" id="capital" class="input input-bordered w-full mt-1" required placeholder="Enter the country's capital" />
        </div>

        <!-- Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" id="description" rows="5" maxlength="3000" oninput="updateCharacterCount(event)" class="textarea textarea-bordered w-full mt-1" placeholder="Provide a brief description (max 3000 characters)"></textarea>
          <p id="descriptionCounter" class="text-sm text-gray-500 mt-2">
            Characters remaining: <span id="remainingCharacters">3000</span>
          </p>
        </div>

        <!-- Country Picture Upload with Preview -->
        <div>
        <label for="picture" class="block text-sm font-medium text-gray-700">Country Picture</label>
        <!-- Drag & Drop Upload Area -->
        <div class="mt-2 flex items-center justify-center w-full">
            <label for="picture" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <!-- Upload Icon -->
                <svg class="w-8 h-8 mb-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7l-4-4H4z" />
                </svg>
                <p class="mb-2 text-sm text-gray-500">
                <span class="font-semibold">Click to upload</span> 
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, JPEG (max. 2MB)</p>
            </div>
            <!-- Hidden File Input -->
            <input id="picture" name="picture" type="file" accept="image/*" class="hidden" onchange="previewPicture(event)" />
            </label>
        </div>
        
        <!-- Picture Preview Container -->
        <div id="picturePreviewContainer" class="mt-4 hidden">
            <p class="text-sm text-gray-500 mb-2">Picture Preview:</p>
            <img id="picturePreview" src="#" alt="Picture Preview" class="w-40 h-auto rounded-md shadow" />
        </div>
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

  <!-- JavaScript for Character Counter and Picture Preview -->
  <script>
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

    // Picture Preview
    function previewPicture(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('picturePreviewContainer');
    const previewImage = document.getElementById('picturePreview');
    
        if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
        } else {
        previewContainer.classList.add('hidden');
        }
    }
  </script>
</body>
</html>
