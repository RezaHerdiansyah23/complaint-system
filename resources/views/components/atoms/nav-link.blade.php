@props(['active' => false, 'href'])

@php
    $classes = $active
        ? 'block px-4 py-2 rounded-md bg-teal-100 text-teal-800 dark:bg-teal-900 dark:text-teal-200'
        : 'block px-4 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
