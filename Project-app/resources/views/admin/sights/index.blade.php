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
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="container mx-auto py-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Pending Sights for Review</h1>

            @if($pendingSights->isEmpty())
                <p class="text-gray-600">No pending sights for review.</p>
            @else
                <table class="min-w-full table-auto bg-white">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Description</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($pendingSights as $sight)
                        <tr>
                            <td class="px-6 py-4 text-gray-900">{{ $sight->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ Str::limit($sight->description, 100) }}</td>
                            <td class="px-6 py-4 flex justify-center space-x-4">
                                <!-- Approve Button -->
                                <form action="{{ route('admin.sights.approve', $sight->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600">
                                        Approve
                                    </button>
                                </form>
                                <!-- Decline Button -->
                                <form action="{{ route('admin.sights.decline', $sight->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600">
                                        Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
