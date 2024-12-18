<section class="bg-white p-6 rounded-lg">
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

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

            <!-- Profile Picture -->
            <div class="space-y-4">
                <!-- Profile Picture Label -->
                <x-input-label for="profile_picture" :value="__('Profile Picture')" class="font-medium text-gray-700" />

                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Display Current Picture -->
                    <div class="relative">
                        <img id="profilePicturePreview" 
                            src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" 
                            alt="Profile Picture" 
                            class="w-24 h-24 rounded-full object-cover border-2 border-gray-300 shadow-md">
                        <!-- Edit Icon -->
                        <div class="absolute bottom-0 right-0 w-7 h-7 bg-indigo-600 rounded-full flex items-center justify-center cursor-pointer">
                            <i class="fas fa-pen text-white text-sm"></i>
                        </div>
                    </div>

                    <!-- File Upload Input -->
                    <div class="flex flex-col w-full">
                        <label for="profile_picture" class="flex items-center justify-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md shadow-sm hover:bg-indigo-600 hover:text-white cursor-pointer transition duration-200">
                            <i class="fas fa-upload mr-2"></i> {{ __('Upload New Picture') }}
                        </label>
                        <input 
                            type="file" 
                            id="profile_picture" 
                            name="profile_picture" 
                            accept="image/jpeg,image/png,image/jpg" 
                            class="hidden" 
                            onchange="previewProfilePicture(event)" 
                        />
                        <!-- Input Error Message -->
                        @if ($errors->has('profile_picture'))
                            <p class="text-sm text-red-600 mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $errors->first('profile_picture') }}
                            </p>
                        @else
                            <p class="text-sm text-gray-500 mt-2">
                                {{ __('Only JPEG, JPG, and PNG files are allowed. Maximum size: 2MB.') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- JavaScript for Live Preview -->
            <script>
                function previewProfilePicture(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('profilePicturePreview').src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            </script>
            
        <!-- Name Field -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Name')" class="font-medium text-gray-700" />
            <x-text-input id="name" name="name" type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="text-sm text-red-600 mt-1" :messages="$errors->get('name')" />
        </div>

        <!-- Surname Field -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $user->surname)" required />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Username Field -->
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
        </div>

        <!-- About Me Field -->
        <div class="mt-4">
            <x-input-label for="about_me" :value="__('About Me')" />
            <textarea id="about_me" name="about_me" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('about_me', $user->about_me) }}</textarea>
            <x-input-error :messages="$errors->get('about_me')" class="mt-2" />
        </div>

        <!-- Save Button -->
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
