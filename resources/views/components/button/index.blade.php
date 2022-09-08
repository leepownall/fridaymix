@aware([
    'type',
    'small' => false,
    'large' => false,
    'leadingIcon',
    'trailingIcon',
])

<button
    type="{{ $type }}"
    {{ $attributes->class([
        'inline-flex items-center text-center border font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2',
        'text-sm px-4 py-2' => $small === false && $large === false,
        'text-xs px-2.5 py-1.5' => $small,
        'text-base px-6 py-3' => $large,
    ]) }}
>
    @isset($leadingIcon)
        <div
            @class([
                '-ml-1 mr-2' => $small === false && $large === false,
                '-ml-0.5 mr-2' => $small,
                '-ml-1 mr-3' => $large,
           ])
        >
            {{ $leadingIcon }}
        </div>
    @endif
    {{ $slot }}
    @isset($trailingIcon)
        <div
            @class([
                'ml-2 -mr-1' => $small === false && $large === false,
                'ml-2 -mr-0.5' => $small,
                'ml-3 -mr-1' => $large,
            ])
        >
            {{ $trailingIcon }}
        </div>
    @endisset
</button>
