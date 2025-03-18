<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Admin - Reported Content</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="container mx-auto p-6 bg-white rounded-lg shadow mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Reported Content</h1>
        
        <!-- Success Notification -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if ($reports->count() > 0)
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200 text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Report ID</th>
                            <th class="px-4 py-2 border">Reported By</th>
                            <th class="px-4 py-2 border">Reason</th>
                            <th class="px-4 py-2 border">Type</th>
                            <th class="px-4 py-2 border">Content</th>
                            <th class="px-4 py-2 border text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @foreach ($reports as $report)
                            <tr class="hover:bg-gray-50 border-b border-gray-200">
                                <td class="px-4 py-2 border">{{ $report->id }}</td>
                                <td class="px-4 py-2 border">{{ $report->user->username }}</td>
                                <td class="px-4 py-2 border max-w-xs truncate">
                                    <span 
                                        class="block truncate" 
                                        title="{{ $report->reason ?? 'No reason provided' }}"
                                    >
                                        {{ Str::limit($report->reason ?? 'No reason provided', 50) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border">{{ class_basename($report->reportable_type) }}</td>
                                <td class="px-4 py-2 border max-w-xs truncate">
                                    <a 
                                        href="{{ route('admin.reports.show', $report->id) }}" 
                                        class="text-blue-600 hover:underline"
                                        title="{{ $report->reportable ? ($report->reportable_type === 'App\\Models\\Reply' ? $report->reportable->content : ($report->reportable_type === 'App\\Models\\Comment' ? $report->reportable->comment : ($report->reportable_type === 'App\\Models\\Review' ? $report->reportable->content : 'Content not available'))) : 'Content not available' }}"
                                    >
                                        {{ Str::limit($report->reportable ? ($report->reportable_type === 'App\\Models\\Reply' ? $report->reportable->content : ($report->reportable_type === 'App\\Models\\Comment' ? $report->reportable->comment : ($report->reportable_type === 'App\\Models\\Review' ? $report->reportable->content : 'Content not available'))) : 'Content not available', 50) }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        @if ($report->reportable)
                                            @php
                                                $deleteRoute = '';
                                                if ($report->reportable_type === 'App\\Models\\Review') {
                                                    $deleteRoute = route('admin.reviews.delete', $report->reportable->id);
                                                } elseif ($report->reportable_type === 'App\\Models\\Comment') {
                                                    $deleteRoute = route('admin.comments.delete', $report->reportable->id);
                                                } elseif ($report->reportable_type === 'App\\Models\\Reply') {
                                                    $deleteRoute = route('admin.forum.comments.delete', $report->reportable->id);
                                                }
                                            @endphp

                                            @if ($deleteRoute)
                                                <!-- Delete Reported Item -->
                                                <form method="POST" action="{{ $deleteRoute }}" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-error px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                                    >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        <!-- Dismiss Report -->
                                        <form method="POST" action="{{ route('admin.reports.destroy', $report->id) }}" onsubmit="return confirm('Are you sure you want to dismiss this report?')">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="btn btn-warning px-3 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $reports->links() }}
            </div>
        @else
            <p class="text-center text-gray-500">No reports found.</p>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
