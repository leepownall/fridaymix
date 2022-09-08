@props([
    'type' => 'button',
    'small' => false,
    'large' => false,
])

<x-button
    {{ $attributes->merge(['class' => 'border-transparent shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 justify-center']) }}>
    {{ $slot }}
</x-button>

