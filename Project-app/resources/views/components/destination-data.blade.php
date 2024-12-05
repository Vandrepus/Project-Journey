<div class="{{ $attributes->get('class', 'flex flex-col lg:flex-row items-center gap-6 my-8') }}">
    <div class="des-text lg:w-1/2 text-center lg:text-left">
        <h1 class="text-3xl font-bold mb-4">{{ $heading }}</h1>
        <p class="text-gray-600 text-lg">{{ $text }}</p>
    </div>
    <div class="image lg:w-1/2 flex flex-col gap-4">
        <img src="{{ asset('images/' . $img1) }}" alt="img" class="w-full h-64 object-cover rounded-lg shadow-lg">
        <img src="{{ asset('images/' . $img2) }}" alt="img" class="w-full h-64 object-cover rounded-lg shadow-lg">
    </div>
</div>
