@props([
    'type' => 'button',
    'small' => false,
    'large' => false,
])

<x-button
    {{ $attributes->merge(['class' => 'border-gray-300 shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:ring-indigo-500']) }}>
    {{ $slot }}
</x-button>

