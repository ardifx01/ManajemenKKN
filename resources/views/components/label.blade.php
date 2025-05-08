@props(['required' => false, 'value' => null])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 mb-1']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span class="text-red-500">*</span>
    @endif
</label>
