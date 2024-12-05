<x-navbar />
<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br px-4 sm:px-6 lg:px-8 mt-40">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">{{ __('Reset Your Password') }}</h2>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Password -->
                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text font-medium text-gray-700">{{ __('New Password') }}</span>
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Enter a new password"
                        class="input input-bordered w-full"
                    />
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-control">
                    <label for="password_confirmation" class="label">
                        <span class="label-text font-medium text-gray-700">{{ __('Confirm New Password') }}</span>
                    </label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your new password"
                        class="input input-bordered w-full"
                    />
                    @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button
                        type="submit"
                        class="btn btn-primary btn-block"
                    >
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-footer />
