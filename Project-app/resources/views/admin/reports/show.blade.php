<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Report Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
            <div class="flex items-center space-x-4">
                <i class="fas fa-flag text-red-500 text-2xl"></i>
                <h1 class="text-3xl font-bold text-gray-800">Report Details</h1>
            </div>

            <!-- Report Information -->
            <div class="card shadow-md bg-base-100 border border-gray-200">
                <div class="card-body space-y-4">
                    <h2 class="text-lg font-bold flex items-center space-x-2 text-blue-600">
                        <i class="fas fa-info-circle"></i>
                        <span>Report Information</span>
                    </h2>
                    <p class="text-gray-700"><strong>Report ID:</strong> {{ $report->id }}</p>
                    <p class="text-gray-700">
                        <strong>Reported By:</strong> 
                        <a href="{{ route('user.profile', $report->user->username) }}" class="text-blue-600 hover:underline">
                            {{ $report->user->username }}
                        </a>
                    </p>
                    <p class="text-gray-700"><strong>Reason:</strong></p>
                    <p class="text-gray-700 break-words">{{ $report->reason ?? 'No reason provided' }}</p>
                    <p class="text-gray-700"><strong>Type:</strong> {{ class_basename($report->reportable_type) }}</p>
                </div>
            </div>

            <!-- Reported Content -->
            <div class="card shadow-md bg-base-100 border border-gray-200">
                <div class="card-body space-y-4">
                    <h2 class="text-lg font-bold flex items-center space-x-2 text-green-600">
                        <i class="fas fa-comments"></i>
                        <span>Reported Content</span>
                    </h2>
                    @if ($report->reportable)
                        <p class="text-gray-700 break-words">
                            @if ($report->reportable_type === 'App\\Models\\Reply')
                                {{ $report->reportable->content }}
                            @elseif ($report->reportable_type === 'App\\Models\\Comment')
                                {{ $report->reportable->comment }}
                            @elseif ($report->reportable_type === 'App\\Models\\Review')
                                {{ $report->reportable->content }}
                            @else
                                Content not available
                            @endif
                        </p>
                    @else
                        <p class="text-gray-500">Content not found</p>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                @if ($report->reportable)
                    @php
                        $deleteRoute = '';
                        if ($report->reportable_type === 'App\Models\Review') {
                            $deleteRoute = route('admin.reviews.delete', $report->reportable->id);
                        } elseif ($report->reportable_type === 'App\Models\Comment') {
                            $deleteRoute = route('admin.comments.delete', $report->reportable->id);
                        } elseif ($report->reportable_type === 'App\Models\Reply') {
                            $deleteRoute = route('admin.forum.comments.delete', $report->reportable->id);
                        }
                    @endphp

                    @if ($deleteRoute)
                        <form method="POST" action="{{ $deleteRoute }}" onsubmit="return confirm('Are you sure you want to delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="btn btn-error w-full sm:w-auto px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center justify-center"
                            >
                                <i class="fas fa-trash-alt mr-2"></i> Delete Item
                            </button>
                        </form>
                    @endif
                @endif

                <form method="POST" action="{{ route('admin.reports.destroy', $report->id) }}" onsubmit="return confirm('Are you sure you want to dismiss this report?')">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="btn btn-warning w-full sm:w-auto px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 flex items-center justify-center"
                    >
                        <i class="fas fa-times-circle mr-2"></i> Dismiss Report
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
