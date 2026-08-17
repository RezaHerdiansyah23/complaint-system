@php
    $level = (int) ($level ?? 1);
    $tag = 'h' . $level;

    $classes = match($level) {
        1 => 'text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-50 leading-tight tracking-tight',
        2 => 'text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-100 leading-snug tracking-tight',
        3 => 'text-xl md:text-2xl font-semibold text-gray-700 dark:text-gray-200 leading-normal tracking-tight',
        4 => 'text-lg md:text-xl font-medium text-gray-700 dark:text-gray-300 leading-normal',
        5 => 'text-base md:text-lg font-medium text-gray-600 dark:text-gray-400',
        6 => 'text-sm md:text-base font-medium text-gray-500 dark:text-gray-400',
        default => 'text-base font-medium text-gray-600',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $tag }}>
