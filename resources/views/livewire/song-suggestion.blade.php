<div class="inline-flex items-center">
    @if($answer)
        <div class="mr-4">
            <a
                href="{{ $link }}"
                class="text-blue-700 hover:underline text-sm"
                target="_blank"
            >{{ $answer }}</a>
        </div>
    @endif
    <button
        class="relative inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500 disabled:opacity-25 disabled:cursor-not-allowed"
        wire:click="getSuggestions"
        wire:loading.attr="disabled"
    >
        <span wire:loading>Doing AI Stuff</span>
        <span wire:loading.remove>Song suggestion</span>
    </button>
</div>
