<x-app-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <!-- Main Content Area -->
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information Section -->
            <section class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <!-- Update Password Section -->
            <section class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <!-- Delete Account Section -->
            <section class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
