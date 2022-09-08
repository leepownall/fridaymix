@aware([
    'error',
])

@props([
    'id' => null,
    'label' => null,
    'error' => null,
])

<div {{ $attributes->merge(['class' => 'relative flex items-start']) }}>
    <div class="flex items-center h-5">
        <input
            @if($id)
                id="{{ $id }}"
            @endif
            aria-describedby="comments-description"
            type="checkbox"
            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded disabled:opacity-50"
            {{ $attributes }}
        >
    </div>
    @if($label)
        <div class="ml-3 text-sm">
            <label
                @if($id)
                    for="{{ $id }}"
                @endif
                @if(!$attributes->get('disabled'))
                    disabled
                @endif
                class="font-medium text-gray-700 disabled:text-opacity-50"
            >
                {{ $label }}
            </label>
        </div>
    @endif
</div>
