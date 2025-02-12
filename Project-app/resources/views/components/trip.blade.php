<div class="trip container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-center mb-4">Recent Travel Highlights</h1>
    <p class="trip-des text-lg text-center text-gray-600 mb-10">
        Explore breathtaking locations and must-visit landmarks.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="card bg-base-100 shadow-xl hover:shadow-2xl">
            <figure class="h-48 overflow-hidden">
                <img src="{{ asset('images/Paris.jpg') }}" alt="Eiffel Tower, Paris" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </figure>
            <div class="card-body">
                <h2 class="card-title text-xl font-semibold">Eiffel Tower, Paris</h2>
                <p class="text-gray-600">
                    A symbol of France and one of the most visited landmarks in the world. Experience stunning views of the city from its observation decks, especially breathtaking at night when it lights up.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl">
            <figure class="h-48 overflow-hidden">
                <img src="{{ asset('images/Amsterdam.jpg') }}" alt="Amsterdam Canals, Amsterdam" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </figure>
            <div class="card-body">
                <h2 class="card-title text-xl font-semibold">Amsterdam Canals, Amsterdam</h2>
                <p class="text-gray-600">
                    Amsterdam’s canals offer a picturesque view of the city’s historic charm. Lined with 17th-century buildings, these waterways provide a scenic and immersive way to explore the city by boat or on foot.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl">
            <figure class="h-48 overflow-hidden">
                <img src="{{ asset('images/Berlin.jpg') }}" alt="Brandenburg Gate, Berlin" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </figure>
            <div class="card-body">
                <h2 class="card-title text-xl font-semibold">Brandenburg Gate, Berlin</h2>
                <p class="text-gray-600">
                    One of Berlin's most famous landmarks, this historic gate stands as a symbol of unity and peace. It's a must-visit location, especially at sunset when it glows with warm golden hues.
                </p>
            </div>
        </div>
    </div>
</div>
