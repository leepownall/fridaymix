@props([
    'label' => null,
    'for' => null,
    'help' => null,
    'error' => null,
])

<label
    {{ $attributes->class(['block text-sm font-medium text-gray-700']) }}
    for="{{ $for }}"
    {{ $attributes }}
>
        <span
            @class([
                'text-gray-700 inline-block mb-1',
                'text-red-500' => $error
            ])
        >{{ $label ?? '' }}</span>
    <div class="mt-1">
        {{ $slot }}
    </div>
    @if($help)
        <p class="mt-2 text-sm text-gray-500" id="{{ $for }}">{{ $help }}</p>
    @endif
    @if($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif
</label>
