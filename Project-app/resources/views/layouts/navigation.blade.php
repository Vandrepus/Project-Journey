<nav x-data="{ open: false, profileOpen: false }" class="bg-indigo-600 text-white">
    <!-- Desktop Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ auth()->check() && Auth::user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-8 w-auto" />
                    <span class="text-lg font-bold">JourneyHub</span>
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-6">
                @auth
                    @if (Auth::user()->usertype === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300 {{ request()->routeIs('admin.dashboard') ? 'underline' : '' }}">Admin Dashboard</a>
                        <a href="{{ route('admin.contact-messages.index') }}" class="hover:text-gray-300 {{ request()->routeIs('admin.contact-messages.index') ? 'underline' : '' }}">Check Messages</a>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-gray-300 {{ request()->routeIs('admin.users.index') ? 'underline' : '' }}">User Management</a>
                        <a href="{{ route('admin.sights.index') }}" class="hover:text-gray-300 {{ request()->routeIs('admin.sights.index') ? 'underline' : '' }}">Review Locations</a>
                        <a href="{{ route('admin.countries.index') }}" class="hover:text-gray-300 {{ request()->routeIs('admin.countries.index') ? 'underline' : '' }}">Review Countries</a>
                        <a href="{{ route('admin.tickets.index') }}" class="hover:text-gray-300 {{ request()->routeIs('admin.tickets.index') ? 'underline' : '' }}">Manage Tickets</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-300 {{ request()->routeIs('dashboard') ? 'underline' : '' }}">Dashboard</a>
                        <a href="{{ route('countries.index') }}" class="hover:text-gray-300 {{ request()->routeIs('countries.index') ? 'underline' : '' }}">Countries</a>
                        <a href="{{ route('forum.index') }}" class="hover:text-gray-300 {{ request()->routeIs('forum.index') ? 'underline' : '' }}">Forum</a>
                        <a href="{{ route('location.propose') }}" class="hover:text-gray-300 {{ request()->routeIs('location.propose') ? 'underline' : '' }}">Propose Location</a>
                        <a href="{{ route('countries.propose') }}" class="hover:text-gray-300 {{ request()->routeIs('countries.propose') ? 'underline' : '' }}">Propose Country</a>
                        <a href="{{ route('support.index') }}" class="hover:text-gray-300 {{ request()->routeIs('support.index') ? 'underline' : '' }}">Support Tickets</a>
                    @endif
                @endauth
            </div>

            <!-- Profile and Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Profile Dropdown for Desktop -->
                    <div class="relative hidden md:block">
                        <button @click="profileOpen = !profileOpen" class="focus:outline-none">
                            <div class="flex items-center">
                                <span>{{ Auth::user()->username ?? Auth::user()->name }}</span>
                                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute right-0 mt-2 w-48 bg-white text-black shadow-lg rounded-md py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left block px-4 py-2 text-sm hover:bg-gray-100">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="open = ! open" class="md:hidden text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" class="md:hidden bg-white">
        <div class="py-4 px-2 space-y-2">
            @auth
                @if (Auth::user()->usertype === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Admin Dashboard</a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Check Messages</a>
                    <a href="{{ route('admin.users.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">User Management</a>
                    <a href="{{ route('admin.sights.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Review Locations</a>
                    <a href="{{ route('admin.countries.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Review Countries</a>
                    <a href="{{ route('admin.tickets.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Manage Tickets</a>
                @else
                    <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Dashboard</a>
                    <a href="{{ route('countries.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Countries</a>
                    <a href="{{ route('forum.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Forum</a>
                    <a href="{{ route('location.propose') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Propose Location</a>
                    <a href="{{ route('countries.propose') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Propose Country</a>
                    <a href="{{ route('support.index') }}" class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">Support Tickets</a>
                @endif

                <!-- Profile Dropdown for Mobile -->
                <div>
                    <button @click="profileOpen = !profileOpen" class="block w-full text-left text-gray-700 px-3 py-2 hover:bg-gray-200 rounded-md">
                        {{ Auth::user()->username ?? Auth::user()->name }}
                        <svg class="ml-2 h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="profileOpen" class="mt-2 space-y-1 bg-white text-gray-700 rounded-md shadow-md px-3 py-2">
                        <a href="{{ route('profile.edit') }}" class="block hover:bg-gray-200 rounded-md px-2 py-1">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="block w-full text-left hover:bg-gray-200 rounded-md px-2 py-1">Log Out</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
