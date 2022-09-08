@aware([
    'error',
])

@props([
    'name',
    'for',
    'optional' => false,
    'options' => [],
    'hasKeyValues' => false,
    'selected',
    'defaultLabel' => 'Please select',
])

<select
    {{ $attributes->class([
        'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md',
        'border-red-500' => $error
    ]) }}
    @isset($name) name="{{ $name }}" @endif
>
    @if($optional)
        <option selected value>{{ $defaultLabel }}</option>
    @endif
    @isset($options)
        @foreach($options as $key => $label)
            <option
                value="{{ $hasKeyValues ? $key : $label }}"
                @isset($selected)
                    @if ($selected === $hasKeyValues ? $key : $label)
                        selected
                   @endif
                @endisset
            >{{ $label }}</option>
        @endforeach
    @endisset
</select>
