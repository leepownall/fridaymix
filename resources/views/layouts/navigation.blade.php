<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-gray-800" x-data="{ open: false }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="-ml-2 mr-2 flex items-center md:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                        <span class="sr-only">Open main menu</span>
                        <svg x-description="Icon when menu is closed.

Heroicon name: outline/bars-3" x-state:on="Menu open" x-state:off="Menu closed" class="h-6 w-6 block" :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                        </svg>
                        <svg x-description="Icon when menu is open.

Heroicon name: outline/x-mark" x-state:on="Menu open" x-state:off="Menu closed" class="h-6 w-6 hidden" :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div
                    x-data="{ tooltip: `<a href='https://www.youtube.com/watch?v=ULQu8uoYLIg' target='_blank'>unce unce unce</a>` }"
                    x-tooltip.interactive.html="tooltip"
                    class="flex-shrink-0 flex items-center"
                >
                    <img class="hidden md:block h-8 w-auto" src="{{ asset('partyparrot.gif') }}" alt="Part Parrot">
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                    <x-nav-link href="{{ route('playlists.index') }}" :active="request()->routeIs('playlists.index', 'playlists.show')">Playlists</x-nav-link>
                    <x-nav-link href="{{ route('tracks.index') }}" :active="request()->routeIs('tracks.index', 'tracks.show')">Tracks</x-nav-link>
                </div>
            </div>
            <div class="flex items-center">
                @auth()
                    <div class="flex-shrink-0">
                        <a href="{{ route('playlists.create') }}" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                            Add playlist
                        </a>
                    </div>
                @endauth
                <div class="hidden md:ml-4 md:flex-shrink-0 md:flex md:items-center">
                    @auth()
                        <div x-data="{ open: false }" @keydown.escape.stop="open = false; focusButton()" @click.away="open = false" class="ml-3 relative">
                            <div>
                                <button
                                    type="button"
                                    class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button"
                                    x-ref="button"
                                    @click="open = true"
                                    @keyup.space.prevent="open = true"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    x-bind:aria-expanded="open.toString()"
                                >
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="{{ $user->avatar }}" alt="{{ $user->name }} profile image.">
                                </button>
                            </div>

                            <div
                                x-show="open"
                                x-trap="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                x-ref="menu-items"
                                x-description="Dropdown menu, show/hide based on menu state."
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1"
                                style="display: none;"
                            >
                                <livewire:signout class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" />
                            </div>

                        </div>
                    @else
                        <a class="bg-[#1DB954] hover:bg-[#1ed760] rounded-lg text-white px-4 py-2 text-sm" href="{{ route('login') }}">Login with Spotify</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-description="Mobile menu, show/hide based on menu state." class="md:hidden" id="mobile-menu" x-show="open" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <x-responsive-nav-link href="{{ route('playlists.index') }}" :active="request()->routeIs('playlists.index', 'playlists.show')">Playlists</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('tracks.index') }}" :active="request()->routeIs('tracks.index', 'tracks.show')">Tracks</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-700">
            @auth()
                <div class="flex items-center px-5 sm:px-6">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->avatar }}" alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1 sm:px-3">
                    <livewire:signout class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700" />
                </div>
            @else
                <div class="flex items-center px-5 sm:px-6">
                    <a class="inline-block w-full text-center bg-[#1DB954] hover:bg-[#1ed760] rounded-lg text-white hover:underline px-4 py-2 text-sm" href="{{ route('login') }}">Login with Spotify</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
