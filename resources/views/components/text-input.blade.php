@props(['disabled' => false, 'name' => null])

@php
    $hasError = $name ? $errors->has($name) : false;
@endphp

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            'rounded-md shadow-sm ' .
            ($hasError
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500'),
    ]) }}
    @if ($name) name="{{ $name }}" @endif>
