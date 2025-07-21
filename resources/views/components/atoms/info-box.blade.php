@props(['variant' => 'info'])

@php
    $colors = match($variant) {
        'success' => 'bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 border-green-300 dark:border-green-700',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300 border-yellow-300 dark:border-yellow-700',
        'error' => 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 border-red-300 dark:border-red-700',
        default => 'bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 border-blue-300 dark:border-blue-700',
    };
@endphp

<div {{ $attributes->merge(['class' => "p-4 border-l-4 text-sm rounded-r-lg $colors"]) }}>
    {{ $slot }}
</div>