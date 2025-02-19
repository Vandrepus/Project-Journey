<x-navbar />
<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-4 sm:px-6 lg:px-8 md:mt-40">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">{{ __('Log in to your account') }}</h2>

            <!-- Session Status -->
            <x-auth-session-status class="alert alert-success mb-4" :status="session('status')" />

            <!-- Error Box (Validation or Middleware errors) -->
            <x-auth-validation-errors class="alert alert-error mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="label">
                        <span class="label-text font-medium text-gray-700">{{ __('Email') }}</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email"
                        class="input input-bordered w-full"
                    />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="label">
                        <span class="label-text font-medium text-gray-700">{{ __('Password') }}</span>
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="input input-bordered w-full"
                    />
                </div>

                <!-- Remember Me -->
                <div class="form-control">
                    <label class="cursor-pointer flex items-center">
                        <input
                            type="checkbox"
                            id="remember_me"
                            name="remember"
                            class="checkbox checkbox-primary mr-2"
                        />
                        <span class="label-text text-gray-700">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password -->
                <div class="flex justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Log in') }}
                    </button>
                </div>

                <!-- Don't have an account? -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">
                            {{ __('Register here') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-footer />
