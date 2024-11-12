<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <!-- Message -->
            <div class="mb-4 text-sm text-gray-600 text-center">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-between space-x-4">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="px-4 py-2">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </form>

                <!-- Log Out -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
