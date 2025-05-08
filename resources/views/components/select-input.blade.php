@props(['disabled' => false, 'name' => null])

@php
    $hasError = $name ? $errors->has($name) : false;
@endphp

<select @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' .
            ($hasError ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''),
    ]) }}
    @if ($name) name="{{ $name }}" @endif>
    {{ $slot }}
</select>
