<section class="bg-white p-6 rounded-lg ">
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password Field -->
        <div class="space-y-1">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-sm text-red-600 mt-1" />
        </div>

        <!-- New Password Field -->
        <div class="space-y-1">
            <x-input-label for="update_password_password" :value="__('New Password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_password" name="password" type="password" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="text-sm text-red-600 mt-1" />
        </div>

        <!-- Confirm Password Field -->
        <div class="space-y-1">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-sm text-red-600 mt-1" />
        </div>

        <!-- Save Button and Success Message -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
