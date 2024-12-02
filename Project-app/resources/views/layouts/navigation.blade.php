<nav x-data="{ open: false }" class="bg-white shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ auth()->check() && Auth::user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-8 w-auto text-indigo-600" />
                    <span class="text-lg font-bold text-gray-900">JourneyHub</span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex space-x-8 ml-10 items-center">
                @auth
                    @if (Auth::user()->usertype === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.contact-messages.index')" :active="request()->routeIs('admin.contact-messages.index')">
                            {{ __('Check Messages') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            {{ __('User Management') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.sights.index')" :active="request()->routeIs('admin.sights.index')">
                            {{ __('Review Locations') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.countries.index')" :active="request()->routeIs('admin.countries.index')">
                            {{ __('Review Countries') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('countries.index')" :active="request()->routeIs('countries.index')">
                            {{ __('Countries') }}
                        </x-nav-link>
                        <x-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.index')">
                            {{ __('Forum') }}
                        </x-nav-link>
                        <x-nav-link :href="route('location.propose')" :active="request()->routeIs('location.propose')">
                            {{ __('Propose Location') }}
                        </x-nav-link>
                        <x-nav-link :href="route('countries.propose')" :active="request()->routeIs('countries.propose')">
                            {{ __('Propose Country') }}
                        </x-nav-link>
                    @endif
                @endauth
            </div>

            <!-- Profile Dropdown (only on desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 focus:outline-none">
                                <span>{{ Auth::user()->username ?? Auth::user()->name }}</span>
                                <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = ! open" class="md:hidden text-gray-500 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-2" aria-label="Toggle navigation menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="md:hidden bg-gray-50 border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->usertype === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.contact-messages.index')" :active="request()->routeIs('admin.contact-messages.index')">
                        {{ __('Check Messages') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                        {{ __('User Management') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.sights.index')" :active="request()->routeIs('admin.sights.index')">
                        {{ __('Review Locations') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.countries.index')" :active="request()->routeIs('admin.countries.index')">
                        {{ __('Review Countries') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('countries.index')" :active="request()->routeIs('countries.index')">
                        {{ __('Countries') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.index')">
                        {{ __('Forum') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('location.propose')" :active="request()->routeIs('location.propose')">
                        {{ __('Propose Location') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('countries.propose')" :active="request()->routeIs('countries.propose')">
                        {{ __('Propose Country') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->username ?? Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
