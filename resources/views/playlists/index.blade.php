<x-app-layout>
    <div class="max-w-3xl mx-auto sm:my-6 lg:my-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($playlists as $playlist)
                    <li>
                        <a href="{{ route('playlists.show', $playlist) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <img class="inline-block h-14 w-14 rounded-md mr-4" src={{ $playlist->image_url }} alt="">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div class="truncate">
                                        <div class="flex text-sm">
                                            <p class="font-medium text-indigo-600 truncate">{{ $playlist->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-5 flex-shrink-0">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
       <div class="mt-4">
           {{ $playlists->links() }}
       </div>
    </div>
</x-app-layout>
