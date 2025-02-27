<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Admin - User Management</title>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-50 min-h-screen flex flex-col">
  <!-- Navigation -->
  @include('layouts.navigation')

  <!-- Main Content -->
  <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 flex-grow">
    <div class="bg-white shadow-lg rounded-lg p-8">
      <!-- Page Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg flex items-center">
          <i class="fas fa-check-circle mr-2"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <!-- Search & Filter Form -->
      <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <!-- Search by Username -->
          <div class="form-control w-full sm:w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by username..." class="input input-bordered" />
          </div>
          <!-- Filter by User Type -->
          <div class="form-control w-full sm:w-1/3">
            <select name="filter" class="select select-bordered">
              <option value="">All Users</option>
              <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Admins Only</option>
            </select>
          </div>
          <!-- Submit Button -->
          <div>
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>

      <!-- Users Table -->
      <div class="overflow-x-auto bg-gray-50 rounded-lg shadow-md">
        <table class="w-full bg-white divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-3 text-left text-sm font-bold text-gray-700">Username</th>
              <th class="px-4 py-3 text-left text-sm font-bold text-gray-700">Email</th>
              <th class="px-4 py-3 text-left text-sm font-bold text-gray-700">User Type</th>
              <th class="px-4 py-3 text-center text-sm font-bold text-gray-700">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse ($users as $user)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3 text-sm text-gray-800 font-medium">
                  <a href="{{ route('user.profile', $user->username) }}" class="text-blue-500 hover:underline">
                    {{ $user->username }}
                  </a>
                </td>
                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                <td class="px-4 py-3 text-sm text-gray-800 font-semibold">{{ ucfirst($user->usertype) }}</td>
                <td class="px-4 py-3 text-center">
                  <div class="flex justify-center items-center space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary flex items-center">
                      <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-4 py-3 text-center text-gray-500 italic">No users found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6">
        {{ $users->links() }}
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-6">
    <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
  </footer>
</body>
</html>
