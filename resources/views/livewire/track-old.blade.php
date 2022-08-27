<li
    x-data="{ expanded: false }"
    class="border-b border-b-gray-200 cursor-pointer hover:bg-gray-50"
    @click="expanded = ! expanded"
>
    <div class="px-4 py-4 sm:px-6 flex justify-between  items-center group">
        <div class="flex items-center">
            <div class="mr-4">
                <span
                    :class="track.is_current ? 'inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800 hover:bg-green-400' : 'inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-50 opacity-100 text-gray-800 hover:bg-gray-50'"
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
