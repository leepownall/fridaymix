<div class="bg-white overflow-hidden shadow sm:rounded-lg max-w-3xl mx-auto sm:my-6 lg:my-8 p-6">
    <button
        class="relative inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500 disabled:opacity-25 disabled:cursor-not-allowed"
        wire:click="getSuggestions"
        wire:loading.attr="disabled"
    >
        Get song suggestions for the theme <span class="font-bold ml-1">{{ $theme  }}</span>
    </button>

    <div wire:loading.block class="mt-4">Getting song suggestions</div>

    @if($answer)
        <div class="mt-4">
            <a href="{{ $link }}" class="text-blue-700 hover:underline">{{ $answer }}</a>
        </div>
    @endif
</div>
