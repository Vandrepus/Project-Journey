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
  <title>Edit User</title>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
  @include('layouts.navigation')

  <div class="flex-grow container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit User Information</h2>
      
      <!-- Success Notification -->
      @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md flex items-center">
          <i class="fas fa-check-circle mr-2"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">First Name</label>
          <input 
            type="text" 
            name="name" 
            id="name" 
            value="{{ $user->name }}" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed"
            disabled
          >
        </div>

        <!-- Last Name -->
        <div class="mb-4">
          <label for="surname" class="block text-sm font-medium text-gray-700">Last Name</label>
          <input 
            type="text" 
            name="surname" 
            id="surname" 
            value="{{ $user->surname ?? 'N/A' }}" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed"
            disabled
          >
        </div>

        <!-- Username -->
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input 
            type="text" 
            name="username" 
            id="username" 
            value="{{ $user->username }}" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed"
            disabled
          >
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input 
            type="email" 
            name="email" 
            id="email" 
            value="{{ $user->email }}" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed"
            disabled
          >
        </div>

        <!-- User Type -->
        <div class="mb-4">
          <label for="usertype" class="block text-sm font-medium text-gray-700">User Type</label>
          <select 
            name="usertype" 
            id="usertype" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
          >
            <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>

        <!-- Ban User Checkbox -->
        <div class="mb-4">
          <label for="banned" class="block text-sm font-medium text-gray-700">Ban User</label>
          <div class="flex items-center">
            <input 
              type="checkbox" 
              name="banned" 
              id="banned" 
              value="1" 
              class="mr-2" 
              {{ $user->banned ? 'checked' : '' }}
            >
            <span class="text-gray-700">Ban this user</span>
          </div>
        </div>

        <!-- Reason for Ban -->
        <div class="mb-4">
          <label for="ban_reason" class="block text-sm font-medium text-gray-700">Reason for Ban</label>
          <textarea 
            name="ban_reason" 
            id="ban_reason" 
            rows="3"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Enter the reason for banning the user..."
            {{ $user->banned ? '' : 'disabled' }}
          >{{ old('ban_reason', $user->ban_reason) }}</textarea>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
          <div class="mb-4">
            <ul class="text-sm text-red-600 space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Save Button -->
        <div class="flex justify-end">
          <button 
            type="submit" 
            class="bg-indigo-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-indigo-700 transition-all duration-150"
          >
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
  </footer>

  <script>
    // Toggle reason for ban field based on ban checkbox
    const banCheckbox = document.getElementById('banned');
    const banReason   = document.getElementById('ban_reason');

    function toggleBanReason() {
      if (banCheckbox.checked) {
        banReason.removeAttribute('disabled');
      } else {
        banReason.value = '';
        banReason.setAttribute('disabled', true);
      }
    }

    // Initialize the field state on page load
    toggleBanReason();

    // Listen for changes on the checkbox
    banCheckbox.addEventListener('change', toggleBanReason);
  </script>
</body>
</html>
