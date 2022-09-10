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
                <div class="flex-shrink-0">
                    <a href="{{ route('playlists.create') }}" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                        Add playlist
                    </a>
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
    </div>
</nav>
