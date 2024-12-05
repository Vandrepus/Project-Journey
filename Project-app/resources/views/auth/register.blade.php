<x-navbar />
<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br 00 px-4 lg:px-20">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-8">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Register an Account') }}</h2>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name" 
                            class="input input-bordered w-full mt-1"
                            placeholder="Enter your name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Surname -->
                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-700">{{ __('Surname') }}</label>
                        <input 
                            type="text" 
                            id="surname" 
                            name="surname" 
                            value="{{ old('surname') }}" 
                            required 
                            class="input input-bordered w-full mt-1"
                            placeholder="Enter your surname"
                        />
                        <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                    </div>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">{{ __('Username') }}</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        required 
                        class="input input-bordered w-full mt-1"
                        placeholder="Choose a username"
                    />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email" 
                        class="input input-bordered w-full mt-1"
                        placeholder="Enter your email"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        autocomplete="new-password" 
                        class="input input-bordered w-full mt-1"
                        placeholder="Create a password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password" 
                        class="input input-bordered w-full mt-1"
                        placeholder="Confirm your password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit Section -->
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class="btn btn-primary w-auto">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-footer />
