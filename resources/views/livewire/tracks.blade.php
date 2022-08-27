<div>
    <x-input.text wire:model="search" placeholder="Search by track name or spotify id..." />
    <div class="bg-white overflow-hidden shadow sm:rounded-lg max-w-3xl mx-auto sm:my-6 lg:my-8">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach($tracks as $track)
                <li>
                    <a href="" class="block hover:bg-gray-50">
                        <div class="px-4 py-4 flex items-center sm:px-6">
                            <img class="inline-block h-14 w-14 rounded-md mr-4" src={{ $track->image_url }} alt="">
                            <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="truncate">
                                    <div class="flex text-sm">
                                        <p class="font-medium text-indigo-600 truncate">{{ $track->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    {{ $tracks->links() }}
</div>
