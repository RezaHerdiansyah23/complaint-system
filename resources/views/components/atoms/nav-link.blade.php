@props(['active' => false, 'href'])

@php
$classes = $active
    ? 'flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium bg-blue-50 dark:bg-zinc-800 text-blue-700 dark:text-zinc-100 transition-all duration-150'
    : 'flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium text-gray-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800/60 hover:text-gray-800 dark:hover:text-zinc-200 transition-all duration-150';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
