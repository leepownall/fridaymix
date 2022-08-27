<x-app-layout>
    <div class="max-w-3xl mx-auto sm:my-6 lg:my-8">
        <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $playlist->name }}</h3>
                <p class="mt-2 max-w-4xl text-sm text-gray-500">
                    <strong>{{ $contributors }}</strong> people contributed.
                    There are <strong>{{ $playlist->tracks_count }}</strong> tracks with a total playtime of <strong>{{ $duration }}</strong>.
                </p>
            </div>
        </div>
        <div class="mt-5">
            <livewire:playlist.tracks :playlist="$playlist" />
        </div>
    </div>
</x-app-layout>
