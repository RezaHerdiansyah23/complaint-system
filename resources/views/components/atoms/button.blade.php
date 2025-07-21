@props([
    'variant' => 'primary'
])

@php
    $base = 'cursor-pointer transition-all text-white px-6 py-2 rounded-lg border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]';

    $colors = [
        'primary' => 'bg-blue-500 border-blue-600',
        'secondary' => 'bg-gray-400 border-gray-500',
        'success' => 'bg-green-500 border-green-600',
        'danger' => 'bg-red-500 border-red-600',
        'warning' => 'bg-yellow-400 text-black border-yellow-500',
    ];

    $classes = $base . ' ' . ($colors[$variant] ?? $colors['primary']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
