<div>
    <div class="grid grid-cols-12 gap-y-2 sm:gap-x-4 w-full justify-between items-center px-4 sm:px-0">
        <x-input.group label="Search" class="col-span-full md:col-span-6">
            <x-input.text wire:model="search" placeholder="Search by track name or spotify id..." />
        </x-input.group>
        <x-input.group class="col-span-full md:col-span-3">
            <x-input.checkbox
                wire:model="onlyDuplicates"
                label="Show only duplicates"
            />
        </x-input.group>
    </div>
    <div class="bg-white overflow-hidden shadow sm:rounded-lg max-w-3xl mx-auto sm:my-6 lg:my-8">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach($tracks as $track)
                <li
                    x-data="{ expanded: false }"
                    @click="expanded = ! expanded"
                >
                    <div class="block hover:bg-gray-50 group cursor-pointer flex justify-between items-center">
                        <div class="px-4 py-4 flex items-center sm:px-6">
                            <img class="inline-block h-14 w-14 rounded-md mr-4" src={{ $track->image_url }} alt="">
                            <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-indigo-600 truncate">{{ $track->name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $track->album }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden group-hover:block pr-4 sm:pr-6">
                            <button x-show="!expanded">
                                <x-icon.chevron-down />
                            </button>
                            <button x-show="expanded">
                                <x-icon.chevron-up />
                            </button>
                        </div>
                    </div>
                    <div x-show="expanded" class="py-4 px-8 grid grid-cols-12 gap-4 md: gap-2 border-t border-gray-200">
                        <div class="col-span-6 flex flex-col">
                            <span class="text-sm font-medium text-gray-500">First added by</span>
                            <p class="mt-1 text-sm text-gray-900">{{ $track->user->name }}</p>
                        </div>

                        <div class="col-span-6 flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Appears on</span>
                            <ul>
                                @foreach($track->playlists as $playlist)
                                    <li>
                                        <a
                                            class="mt-1 text-sm text-gray-900 hover:text-blue-400"
                                            href="/playlists/show/{{ $playlist->spotify_playlist_id }}"
                                        >
                                            {{ $playlist->name }} ({{ $playlist->pivot->user->name }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>
    {{ $tracks->links() }}
</div>
