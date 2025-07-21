@php
    $level = $level ?? 1;
    $tag = 'h' . $level;

    $baseClass = match($level) {
        1 => 'text-3xl font-bold text-gray-900 dark:text-white',
        2 => 'text-2xl font-semibold text-gray-800 dark:text-gray-100',
        3 => 'text-xl font-semibold text-gray-700 dark:text-gray-200',
        4 => 'text-lg font-medium text-gray-700 dark:text-gray-300',
        5 => 'text-base font-medium text-gray-600 dark:text-gray-400',
        6 => 'text-sm font-medium text-gray-500 dark:text-gray-400',
        default => 'text-base font-medium text-gray-600',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $baseClass]) }}>
    {{ $slot }}
</{{ $tag }}>
