<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Pending Sights for Review</title>
</head>
<body class="bg-gray-50 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-3xl font-bold text-gray-800">Pending Sights for Review</h1>
            </div>

            @if($pendingSights->isEmpty())
                <div class="px-6 py-4">
                    <p class="text-gray-600 text-center">No pending sights for review.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingSights as $sight)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $sight->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ Str::limit($sight->description, 100) }}
                                    </td>
                                    <td class="px-6 py-4 text-center space-y-2 md:space-y-0 md:space-x-2">
                                        <!-- View Details Button -->
                                        <a href="{{ route('admin.sights.show', $sight->id) }}" 
                                           class="inline-block px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 transition duration-150"
                                           aria-label="View details for {{ $sight->name }}">
                                            View Details
                                        </a>
                                        <!-- Approve Button -->
                                        <form action="{{ route('admin.sights.approve', $sight->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600 transition duration-150"
                                                    onclick="return confirm('Are you sure you want to approve this sight?')"
                                                    aria-label="Approve {{ $sight->name }}">
                                                Approve
                                            </button>
                                        </form>
                                        <!-- Decline Button -->
                                        <form action="{{ route('admin.sights.decline', $sight->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition duration-150"
                                                    onclick="return confirm('Are you sure you want to decline this sight?')"
                                                    aria-label="Decline {{ $sight->name }}">
                                                Decline
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
