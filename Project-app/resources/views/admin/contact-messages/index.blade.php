<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Admin - Contact Messages</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 flex-grow">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Contact Messages</h1>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Messages Table -->
            <div class="overflow-x-auto">
                <table class="w-full bg-gray-50 rounded-lg shadow-md divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Subject</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 hidden sm:table-cell">Message</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if ($messages->count() > 0)
                            @foreach ($messages as $message)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-sm text-gray-800">{{ $message->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $message->email }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $message->subject }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 truncate max-w-xs hidden sm:table-cell">
                                        {{ \Illuminate\Support\Str::limit($message->message, 100) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a 
                                            href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                            class="text-blue-500 hover:text-blue-700 flex items-center space-x-1"
                                        >
                                            <i class="fas fa-eye"></i>
                                            <span>View</span>
                                        </a>
                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 flex items-center space-x-1">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-gray-500 italic">No messages found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $messages->links() }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
