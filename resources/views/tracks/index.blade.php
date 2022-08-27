<x-app-layout>
    <div class="max-w-3xl mx-auto sm:my-6 lg:my-8">
        <div class="pb-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Tracks</h3>
            <p class="mt-2 max-w-4xl text-sm text-gray-500">
                <strong>{{ $userCount }}</strong> people contributed.
                There are <strong>{{ $trackCount }}</strong> tracks with a total playtime of <strong>{{ $duration }}</strong>.
            </p>
        </div>
        <livewire:tracks />
    </div>
</x-app-layout>

