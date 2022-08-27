<div>
    <button
        wire:click.prevent="refreshPlaylist"
        type="button"
        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
        Refresh
    </button>
    <div class="flex space-x-4 w-full justify-between items-center">
        <x-input.group label="Search" class="basis-1/2">
            <x-input.text wire:model="search" placeholder="By track name or spotify id..." />
        </x-input.group>
        <x-input.group label="Tracks added by" class="basis-1/3">
            <x-input.select
                wire:model="addedBy"
                hasKeyValues
                optional
                :options="$users"
                default-label="All"
            />
        </x-input.group>
        <x-input.group class="basis-1/3">
            <x-input.checkbox
                wire:model="onlyUpcoming"
                label="Only upcoming"
                :disabled="!$isCurrentlyPlaying"
            />
        </x-input.group>
    </div>
    <div class="bg-white overflow-hidden shadow sm:rounded-lg mt-8" >
        <ul
            x-data="
            {
                tracks: @entangle('tracks'),
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
            wire:ignore
        >
            <template x-for="track in filteredTracks" :key="track.id">
                <li
                    x-data="{ expanded: false }"
                    class="border-b border-b-gray-200 cursor-pointer hover:bg-gray-50"
                    @click="expanded = ! expanded"
                >
                    <div class="px-4 py-4 sm:px-6 flex justify-between  items-center group">
                        <div class="flex items-center">
                            <div class="flex mr-4 w-20 items-center">
                                <span
                                    x-data="{ tooltip: track.is_current ? `Started at ${track.starts_at}` : track.readable_duration }"
                                    x-tooltip="tooltip"
                                    :class="track.is_current ? 'w-full text-center items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-400 text-green-800 hover:bg-green-400 group-hover:bg-green-400' : 'inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-50 opacity-100 text-gray-800 hover:bg-gray-50 group-hover:bg-gray-100'"
                                    x-text="track.is_current ? track.current_time : track.starts_at"
                                >
                                </span>
                            </div>
                            <div
                                :class="track.is_current ? 'flex items-center space-x-4' : 'flex items-center space-x-4 opacity-50'">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded" :src="track.image_url" alt="" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate" x-text="track.name"></p>
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
                    <div x-show="expanded" class="py-4 px-8  flex flex-row space-x-4 border-t border-gray-200">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Added by</span>
                            <p class="mt-1 text-sm text-gray-900" x-text="track.added_by"></p>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Added at</span>
                            <p class="mt-1 text-sm text-gray-900" x-text="track.added_at"></p>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Appears on</span>
                            <ul x-data="{ related: track.related }">
                                <template x-for="relatedTrack in related">
                                    <li>
                                        <a class="mt-1 text-sm text-gray-900 hover:text-blue-400" x-bind:href="`/playlist/show/${relatedTrack.spotify_playlist_id}`" x-text="relatedTrack.name"></a>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Duration</span>
                            <p class="mt-1 text-sm text-gray-900" x-text="track.duration"></p>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</div>
