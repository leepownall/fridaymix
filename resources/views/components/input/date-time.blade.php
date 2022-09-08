@aware([
    'error',
])

@props([
    'name',
    'value' => null,
    'error' => null,
])

<input
    {{ $attributes->class([
        'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md',
        'border-red-500' => $error
    ]) }}
    name="{{ $name }}"
    type="datetime-local"
    @if($value)
        value="{{ $value }}"
    @endif
    {{ $attributes }}
/>
