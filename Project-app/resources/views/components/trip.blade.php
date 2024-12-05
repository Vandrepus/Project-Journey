<div class="trip container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-center mb-4">Recent Trips</h1>
    <p class="trip-des text-lg text-center text-gray-600 mb-10">
        You can discover unique places using our services
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="card bg-base-100 shadow-xl hover:shadow-2xl">
            <figure class="h-48 overflow-hidden">
                <img src="{{ asset('images/Paris.jpg') }}" alt="Trip to Paris" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </figure>
            <div class="card-body">
                <h2 class="card-title text-xl font-semibold">Trip in Paris</h2>
                <p class="text-gray-600">
                    Paris, the capital of France, offers a captivating blend of historic charm and modern allure. Discover iconic landmarks such as the Eiffel Tower, Notre-Dame Cathedral, and the Louvre Museum.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl">
            <figure class="h-48 overflow-hidden">
                <img src="{{ asset('images/Amsterdam.jpg') }}" alt="Trip to Amsterdam" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </figure>
            <div class="card-body">
                <h2 class="card-title text-xl font-semibold">Trip in Amsterdam</h2>
                <p class="text-gray-600">
                    Amsterdam, the capital of the Netherlands, is famed for its picturesque canals, historic architecture, and lively cultural scene. Explore the Anne Frank House and the Van Gogh Museum.
                </p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl">
            <figure class="h-48 overflow-hidden">
                <img src="{{ asset('images/Berlin.jpg') }}" alt="Trip to Berlin" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </figure>
            <div class="card-body">
                <h2 class="card-title text-xl font-semibold">Trip in Berlin</h2>
                <p class="text-gray-600">
                    Berlin, Germany's capital, is a city of contrasts where history and modernity coexist. Visit remnants of the Berlin Wall, explore the Brandenburg Gate, and delve into Museum Island exhibits.
                </p>
            </div>
        </div>
    </div>
</div>
