@props([
    'type' => 'button',
    'small' => false,
    'large' => false,
])

<x-button
    {{ $attributes->merge(['class' => 'border-transparent text-indigo-700 bg-indigo-100 hover:bg-indigo-200']) }}>
    {{ $slot }}
</x-button>
