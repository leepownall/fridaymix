@props([
    'method',
    'action',
    'hasFiles' => false,
])

<form
    @isset($method)
        method="{{ $method !== 'GET' ? 'POST' : 'GET' }}"
    @endisset
    @isset($action)
        action="{{ $action }}"
    @endisset
    {!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!}
    {{ $attributes }}
>
    @csrf
    @isset($method)
        @method($method)
    @endisset

    {{ $slot }}
</form>
