@props(['sights'])

<div class="trip container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-center mb-4">Recent Travel Highlights</h1>
    <p class="trip-des text-lg text-center text-gray-600 mb-10">
        Explore breathtaking locations and must-visit landmarks.
    </p>

    @if ($sights->isEmpty())
        <p class="text-center text-gray-500">No recent sights found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($sights->take(3) as $sight)
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <figure class="h-48 overflow-hidden">
                        <img 
                            src="{{ $sight->photo ? asset('storage/' . $sight->photo) : asset('images/placeholder.jpg') }}" 
                            alt="{{ $sight->name }}" 
                            class="w-full h-full object-cover hover:scale-110 transition-transform duration-300"
                        >
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-xl font-semibold">{{ $sight->name }}</h2>
                        <p class="text-gray-600">
                            {{ Str::limit($sight->description, 150) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>