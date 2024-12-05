<div class="form-container bg-gray-50 py-12 px-4 sm:px-6 lg:px-20">
    <!-- Title -->
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Send a message to us!</h1>

    <!-- Success Alert -->
    @if (session('success'))
    <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-center mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Contact Form -->
    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 max-w-lg mx-auto">
        @csrf 

        <!-- Name -->
        <div>
            <input 
                type="text" 
                name="name" 
                placeholder="Name" 
                class="input input-bordered w-full"
            />
            @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <input 
                type="email" 
                name="email" 
                placeholder="E-mail" 
                class="input input-bordered w-full"
            />
            @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Subject -->
        <div>
            <input 
                type="text" 
                name="subject" 
                placeholder="Subject" 
                class="input input-bordered w-full"
            />
            @error('subject')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Message -->
        <div>
            <textarea 
                name="message" 
                placeholder="Message" 
                rows="4" 
                class="textarea textarea-bordered w-full"
            ></textarea>
            @error('message')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button 
                type="submit" 
                class="btn btn-primary w-full md:w-auto"
            >
                Send Message
            </button>
        </div>
    </form>
</div>
