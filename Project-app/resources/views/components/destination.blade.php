@props(['sights'])

<div class="destination container mx-auto px-6 py-12 text-center">
    <h1 class="text-4xl font-bold mb-4">Popular Destinations Shared by Our Community</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Discover hidden gems, share your experiences, and get travel tips from fellow explorers!
    </p>

    @foreach ($sights->take(5) as $index => $sight)
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 my-16 {{ $index % 2 === 0 ? '' : 'md:flex-row-reverse' }}">
            <!-- Text Content -->
            <div class="w-full md:w-1/2 text-left">
                <h2 class="text-2xl font-semibold mb-3">{{ $sight->name }}</h2>
                <p class="text-gray-700">{{ Str::limit($sight->description, 150) }}</p>
            </div>

            <!-- Image -->
            <div class="w-full md:w-1/2 relative">
                <img 
                    src="{{ $sight->photo ? asset('storage/' . $sight->photo) : asset('images/placeholder.jpg') }}" 
                    alt="{{ $sight->name }}" 
                    class="w-full h-80 object-cover rounded-lg shadow-lg"
                >
            </div>
        </div>
    @endforeach
</div>