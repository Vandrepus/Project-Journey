<div class="{{ $cName }} relative w-full h-screen">
    <img 
        alt="Hero Image" 
        src="{{ asset($heroImg) }}" 
        class="absolute top-0 left-0 w-full h-full object-cover"
    >
    <div class="hero-text absolute inset-0 flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-300">
            {{ $title }}
        </h1>

        @isset($text)
        <p class="text-lg sm:text-xl md:text-2xl text-white mt-4">{{ $text }}</p>
        @endisset
        

        @isset($buttonText)
        <a href="{{ $url }}" 
           class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-md hover:bg-indigo-700 transition-all shadow-lg transform hover:scale-105 mt-4">
           {{ $buttonText }}
        </a>
        @endisset
    </div>
</div>
