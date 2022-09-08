@aware([
    'error',
])

@props([
    'value',
    'name',
    'for',
])

<input
    {{ $attributes->class([
        'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md',
        'border-red-500' => $error
    ]) }}
    @isset($name) name="{{ $name }}" @endif
    type="password"
    @isset($value) value="{{ $value }}" @endif
    {{ $attributes }}
/>
