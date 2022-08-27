@aware([
    'error',
])

@props([
    'value',
    'name',
    'for',
])

<div class="mt-1">
    <input
        {{ $attributes->class([
            'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md',
            'border-red-500' => $error
        ]) }}
        @isset($name) name="{{ $name }}" @endif
        type="email"
        @isset($value) value="{{ $value }}" @endif
        {{ $attributes }}
    />
</div>
