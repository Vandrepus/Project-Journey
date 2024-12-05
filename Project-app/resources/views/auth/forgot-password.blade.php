<x-navbar />
<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br  px-4 sm:px-6 lg:px-8 mt-20">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <!-- Information Text -->
            <div class="mb-4 text-sm text-center text-gray-700">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="form-control">
                    <label for="email" class="label">
                        <span class="label-text font-medium text-gray-700">{{ __('Email') }}</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Enter your email"
                        class="input input-bordered w-full"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Centered Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="btn btn-primary btn-block"
                    >
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-footer />
