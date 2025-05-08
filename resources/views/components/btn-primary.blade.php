@props(['type' => 'submit'])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
