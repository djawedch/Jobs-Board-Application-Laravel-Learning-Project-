@php
    $method = strtoupper($attributes->get('method', 'GET'));
    $htmlMethod = $method === 'GET' ? 'GET' : 'POST';
    $attributes = $attributes->except('method');
@endphp

<form {{ $attributes->merge(['class' => 'max-w-2xl mx-auto space-y-6']) }} 
    method="{{ $htmlMethod }}"
    enctype="{{ $attributes->get('enctype', 'application/x-www-form-urlencoded') }}">
    
    @if ($method !== 'GET')
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>