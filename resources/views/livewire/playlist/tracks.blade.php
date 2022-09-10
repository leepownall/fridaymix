<div>
    <header class="bg-white shadow">
        <div class="max-w-3xl mx-auto py-6 px-4 sm:px-0">
            <div class="flex justify-between items-center">
                <h1>{{ $playlist->name }}</h1>
                <div>
                    <div>
                        @if($batchId)
                            <div
                                wire:key="update-{{ $batchId }}"
                                wire:poll="updateBatchProgress"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                {{ $batchProgress }}% updated
                            </div>
                        @endif
                    </div>
                    <div>
                        @if($batchId === null)
                            <button
                                wire:key="refresh-{{ $batchId }}"
                                wire:click="refreshPlaylist"
                                type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Refresh
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="max-w-3xl mx-auto mt-4 sm:my-6 lg:my-8">
        @if($batchId === null)
            <div>
                <div class="grid grid-cols-12 gap-y-2 sm:gap-x-4 w-full justify-between items-center px-4 sm:px-0">
                    <x-input.group label="Search" class="col-span-full md:col-span-5">
                        <x-input.text wire:model.debounce="search" placeholder="By track, album or artist" />
                    </x-input.group>
                    <x-input.group for="added_by" label="Tracks added by" class="col-span-full md:col-span-4">
                        <x-input.select
                            id="added_by"
                            wire:model="addedBy"
                            hasKeyValues
                            optional
                            :options="$users"
                            default-label="All"
                        />
                    </x-input.group>
                    <div
                        @class([
                            'col-span-full md:col-span-3 flex flex-col',
                            'place-content-end h-full' => $hasDuplicates,
                            'mt-4 md:mt-6 ' => !$hasDuplicates,
                        ])
                        class="col-span-full md:col-span-3 flex flex-col place-content-end h-full">
                        <x-input.group for="only_upcoming" hide-label>
                            <x-input.checkbox
                                id="only_upcoming"
                                wire:model="onlyUpcoming"
                                label="Only upcoming"
                                :disabled="!$isCurrentlyPlaying"
                            />
                        </x-input.group>
                        @if($hasDuplicates)
                            <x-input.group for="only_duplicates" hide-label>
                                <x-input.checkbox
                                    id="only_duplicates"
                                    wire:model="onlyDuplicates"
                                    label="Only duplicates"
                                />
                            </x-input.group>
                        @endif
                    </div>
                </div>
                <div class="overflow-hidden sm:rounded-lg mt-8" >
                    <div>
                        <ul
                            x-data="
                            {
                                tracks: @js($tracks),
                                time: new Date(),
                                filteredTracks() {
                                    return this.tracks.map(track => {
                                        const time = new Date()

                                        track.is_current = this.isCurrent(track, time)

                                        if (track.is_current) {
                                            track.current_time = this.currentTime(track, time)
                                            document.title = track.name + ' - ' + track.current_time
                                        }

                                        return track;
                                    })
                                },
                                isCurrent(track, time) {
                                    const timestamp = parseInt(time.getTime())

                                    return timestamp >= track.starts_at_timestamp && timestamp <= track.ends_at_timestamp
                                },
                                currentTime(track, time) {
                                    let start = DateTime.fromFormat(track.starts_at, 'HH:mm:ss')

                                    return DateTime.fromFormat(time.toLocaleTimeString(), 'HH:mm:ss').diff(start).toFormat('mm:ss')
                                },
                            }
                            "
                            x-init="$interval(() => filteredTracks(), 1000)"
                            role="list"
                            wire:key="{{ rand() }}"
                        >
                            <template x-for="track in filteredTracks" :key="track.id">
                                <li
                                    x-data="{ expanded: false }"
                                    :class="track.is_current ? 'bg-white border-b border-b-gray-200 border-l-4 opacity-100 border-l-pink-400  cursor-pointer hover:bg-gray-50' : 'opacity-70 bg-white border-b border-b-gray-200 cursor-pointer hover:bg-gray-50'"
                                    @click="expanded = ! expanded"
                                >
                                    <div
                                        :class="track.is_current ? 'py-4 px-4 sm:px-6 pl-2 sm:pl-5 flex justify-between items-center group' : 'py-4 px-4 sm:px-6 flex justify-between items-center group'"
                                    >
                                        <div class="flex items-center">
                                            <div class="flex mr-4 w-20 items-center">
                                        <span
                                            x-data="{ tooltip: track.is_current ? `Started at ${track.starts_at}` : track.readable_duration }"
                                            x-tooltip="tooltip"
                                            :class="track.is_current ? 'w-full text-center items-center px-2.5 py-0.5 text-sm font-bold text-pink-400' : 'inline-flex items-center px-2.5 py-0.5 text-sm font-medium '"
                                            x-text="track.is_current ? track.current_time : track.starts_at"
                                        >
                                        </span>
                                            </div>
                                            <div :class="track.is_current ? 'flex items-center space-x-4' : 'flex items-center space-x-4'">
                                                <div class="flex-shrink-0">
                                                    <img class="h-14 w-14 rounded" :src="track.image_url" alt="" />
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-indigo-600 truncate" x-text="track.name"></p>
                                                    <p class="text-sm font-medium text-gray-900 truncate" x-text="track.artists"></p>
                                                    <p class="text-sm text-gray-500 truncate" x-text="track.album"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden group-hover:block">
                                            <button x-show="!expanded">
                                                <x-icon.chevron-down />
                                            </button>
                                            <button x-show="expanded">
                                                <x-icon.chevron-up />
                                            </button>
                                        </div>
                                    </div>
                                    <div x-show="expanded" class="py-4 px-8 grid grid-cols-12 gap-4 md: gap-2 border-t border-gray-200">
                                        <div class="col-span-6 md:col-span-4 flex flex-col">
                                            <span class="text-sm font-medium text-gray-500">Added by</span>
                                            <p class="mt-1 text-sm text-gray-900" x-text="track.added_by"></p>
                                        </div>
                                        <div class="col-span-6 md:col-span-4 flex flex-col">
                                            <span class="text-sm font-medium text-gray-500">Added at</span>
                                            <p class="mt-1 text-sm text-gray-900" x-text="track.added_at"></p>
                                        </div>
                                        <div x-data="{ related: track.related }" x-show="related.length > 0" class="col-span-6 md:col-span-4 flex flex-col">
                                            <span class="text-sm font-medium text-gray-500">Also appears on</span>
                                            <ul>
                                                <template x-for="relatedTrack in related">
                                                    <li>
                                                        <a class="mt-1 text-sm text-gray-900 hover:text-blue-400" x-bind:href="`/playlists/show/${relatedTrack.spotify_playlist_id}`" x-text="relatedTrack.name"></a>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
