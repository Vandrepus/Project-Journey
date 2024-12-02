<section class="bg-white p-6 rounded-lg ">
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Verification Form (hidden) -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Name')" class="font-medium text-gray-700" />
            <x-text-input id="name" name="name" type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="text-sm text-red-600 mt-1" :messages="$errors->get('name')" />
        </div>

        <!--Surname Field -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $user->surname)" required />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!--Username Field -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', $user->username)" required />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Field -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700" />
            <x-text-input id="email" name="email" type="email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="text-sm text-red-600 mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-600">
                    <p>
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- About me Field -->
        <div class="mt-4">
            <x-input-label for="about_me" :value="__('About Me')" />
            <textarea id="about_me" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" name="about_me" rows="4">{{ old('about_me', $user->about_me) }}</textarea>
            <x-input-error :messages="$errors->get('about_me')" class="mt-2" />
        </div>

        <!-- Save Button and Success Message -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
