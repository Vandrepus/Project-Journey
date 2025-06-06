<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Pending Countries</title>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Pending Countries</h2>

            <!-- Success Notification -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
                </div>
            @endif

            <div x-data="{ activeTab: 'pending' }" class="space-y-6">
                <!-- Tabs -->
                <div class="flex justify-center mb-6">
                    <button 
                        @click="activeTab = 'pending'"
                        :class="activeTab === 'pending' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-l-md text-sm font-medium focus:outline-none transition-all duration-200"
                        role="tab"
                        aria-selected="activeTab === 'pending'"
                    >
                        Pending Countries
                    </button>
                    <button 
                        @click="activeTab = 'details'"
                        :class="activeTab === 'details' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-r-md text-sm font-medium focus:outline-none transition-all duration-200"
                        role="tab"
                        aria-selected="activeTab === 'details'"
                    >
                        Country Details
                    </button>
                </div>

                <!-- Pending Countries Tab -->
                <div x-show="activeTab === 'pending'" x-cloak>
                    @if ($proposedCountries->isEmpty())
                        <p class="text-center text-gray-500">No pending countries.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                                <thead>
                                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        <th class="px-6 py-4 border-b">Name</th>
                                        <th class="px-6 py-4 border-b">Description</th>
                                        <th class="px-6 py-4 border-b text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-200">
                                    @foreach ($proposedCountries as $country)
                                        <tr>
                                            <td class="px-6 py-4 text-gray-800">{{ $country->name }}</td>
                                            <td class="px-6 py-4 text-gray-600">
                                                {{ \Illuminate\Support\Str::limit($country->description, 50, '...') }}
                                            </td>
                                            <td class="px-6 py-4 text-center space-y-2">
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.country.edit', $country->id) }}" 
                                                class="btn btn-info btn-sm"
                                                title="Edit this country">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <!-- Approve Button -->
                                                <form action="{{ route('admin.country.approve', $country->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-success btn-sm"
                                                        onclick="return confirm('Are you sure you want to approve this country?')"
                                                        title="Approve {{ $country->name }}">
                                                        Approve
                                                </button>
                                                </form>
                                                <!-- Decline Button -->
                                                <form action="{{ route('admin.country.decline', $country->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-error btn-sm"
                                                        onclick="return confirm('Are you sure you want to decline this country?')"
                                                        title="Decline {{ $country->name }}">
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

                <!-- Country Details Tab -->
                <div x-show="activeTab === 'details'" x-cloak class="space-y-6">
                    @if ($proposedCountries->isEmpty())
                        <p class="text-center text-gray-500">No countries available for details.</p>
                    @else
                        @foreach ($proposedCountries as $country)
                            <div class="bg-gray-100 p-6 rounded-md shadow-md">
                                <h3 class="text-lg font-bold text-gray-700">{{ $country->name }}</h3>
                                
                                <!-- Country Picture -->
                                <div class="mt-4">
                                    @if ($country->picture)
                                        <img 
                                            src="{{ asset('storage/' . $country->picture) }}" 
                                            alt="{{ $country->name }} picture" 
                                            class="w-full max-w-md rounded-lg shadow-md"
                                        />
                                    @else
                                        <p class="text-gray-500 italic">No photo available for this country.</p>
                                    @endif
                                </div>
                                
                                <!-- Capital -->
                                <p class="text-gray-600 mt-4">
                                    <strong>Capital:</strong> 
                                    <span class="break-words">
                                        {{ $country->capital ? $country->capital : 'Not provided' }}
                                    </span>
                                </p>
                                
                                <!-- Description -->
                                <p class="text-gray-600 mb-2 break-words">
                                    <strong>Description:</strong> 
                                    {{ $country->description }}
                                </p>
                                
                                <!-- Submitted By -->
                                <p class="text-gray-600 mb-2">
                                    <strong>Submitted By:</strong> 
                                    @if ($country->user)
                                        <a 
                                            href="{{ route('user.profile', $country->user->username) }}" 
                                            class="text-blue-500 hover:underline"
                                        >
                                            {{ $country->user->username }}
                                        </a>
                                    @else
                                        Unknown
                                    @endif
                                </p>
                                
                                <!-- Status -->
                                <p class="text-gray-600">
                                    <strong>Status:</strong> 
                                    {{ $country->visible ? 'Approved' : 'Pending' }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
