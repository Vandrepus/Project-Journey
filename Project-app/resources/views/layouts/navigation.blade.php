<nav x-data="{ open: false, profileOpen: false }" class="bg-primary text-primary-content shadow-lg">
    <!-- Desktop Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ auth()->check() && Auth::user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-8 w-auto" />
                    <span class="text-xl font-bold">JourneyHub</span>
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex flex-wrap gap-2 overflow-x-auto justify-center ">
                @auth
                    @if (Auth::user()->usertype === 'admin')
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('admin.contact-messages.index') ? 'btn-active' : '' }}">Check Messages</a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('admin.users.index') ? 'btn-active' : '' }}">User Management</a>
                        <a href="{{ route('admin.sights.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('admin.sights.index') ? 'btn-active' : '' }}">Review Locations</a>
                        <a href="{{ route('admin.countries.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('admin.countries.index') ? 'btn-active' : '' }}">Review Countries</a>
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('admin.tickets.index') ? 'btn-active' : '' }}">Manage Tickets</a>
                    @else
                        <a href="{{ route('countries.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('countries.index') ? 'btn-active' : '' }}">Countries</a>
                        <a href="{{ route('forum.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('forum.index') ? 'btn-active' : '' }}">Forum</a>
                        <a href="{{ route('location.propose') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('location.propose') ? 'btn-active' : '' }}">Propose Location</a>
                        <a href="{{ route('countries.propose') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('countries.propose') ? 'btn-active' : '' }}">Propose Country</a>
                        <a href="{{ route('support.index') }}" class="btn btn-ghost btn-sm {{ request()->routeIs('support.index') ? 'btn-active' : '' }}">Support Tickets</a>
                    @endif
                @endauth
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden md:block relative">
                @auth
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn bg-primary text-white btn-sm flex items-center space-x-2 rounded-md shadow-md hover:bg-blue-600 transition duration-150 h-10">
                            <span class="font-medium">{{ Auth::user()->username ?? Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </label>
                        <ul tabindex="0" class="dropdown-content bg-white text-black shadow-lg rounded-md p-2 w-36 space-y-2">
                            <li>
                                <a 
                                    href="{{ route('profile.edit') }}" 
                                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-150"
                                >
                                    <i class="fa-solid fa-gear mr-2"></i> <span>Settings</span>
                                </a>
                            </li>
                            <li>
                                <a 
                                    href="{{ route('profile.edit') }}" 
                                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-150"
                                >
                                    <i class="fa-solid fa-gear mr-2"></i> <span>Settings</span>
                                </a>
                            </li>
                            <li>
                                <a 
                                    href="{{ route('profile.edit') }}" 
                                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-150"
                                >
                                    <i class="fa-solid fa-gear mr-2"></i> <span>Settings</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="flex items-center w-full px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600 transition duration-150"
                                    >
                                        <i class="fa-solid fa-right-from-bracket mr-2"></i> <span>Log Out</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>


            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden btn btn-ghost btn-circle">
                <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" class="md:hidden bg-white text-black">
        <div class="py-4 px-4 space-y-3">
            @auth
                @if (Auth::user()->usertype === 'admin')
                <a href="{{ route('admin.contact-messages.index') }}" 
                class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150 break-words whitespace-normal">
                Check Messages
                </a>
                <a href="{{ route('admin.users.index') }}" 
                class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150 break-words whitespace-normal">
                User Management
                </a>
                <a href="{{ route('admin.sights.index') }}" 
                class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150 break-words whitespace-normal">
                Review Locations
                </a>
                <a href="{{ route('admin.countries.index') }}" 
                class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150 break-words whitespace-normal">
                Review Countries
                </a>
                <a href="{{ route('admin.tickets.index') }}" 
                class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150 break-words whitespace-normal">
                Manage Tickets
                </a>

                @else
                    <a href="{{ route('countries.index') }}" 
                    class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150">
                    Countries
                    </a>
                    <a href="{{ route('forum.index') }}" 
                    class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150">
                    Forum
                    </a>
                    <a href="{{ route('location.propose') }}" 
                    class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150">
                    Propose Location
                    </a>
                    <a href="{{ route('countries.propose') }}" 
                    class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150">
                    Propose Country
                    </a>
                    <a href="{{ route('support.index') }}" 
                    class="block w-full bg-primary text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-150">
                    Support Tickets
                    </a>
                @endif
                <!-- Mobile Profile Dropdown -->
                <div class="mt-4">
                    <button 
                        @click="profileOpen = !profileOpen" 
                        class="btn bg-primary text-white btn-sm w-full flex items-center justify-center hover:bg-blue-600 transition duration-150"
                    >
                        <span class="font-medium">{{ Auth::user()->username ?? Auth::user()->name }}</span>
                        <i class="ml-2 fa-solid fa-chevron-down"></i>
                    </button>
                    <div 
                        x-show="profileOpen" 
                        @click.away="profileOpen = false" 
                        class="mt-2 bg-white text-black shadow-lg rounded-md py-2 space-y-2"
                    >
                        <a 
                            href="{{ route('profile.edit') }}" 
                            class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-150"
                        >
                            <i class="fa-solid fa-gear mr-2"></i> <span>Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button 
                                type="submit" 
                                class="flex items-center px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600 transition duration-150 w-full"
                            >
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> <span>Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
