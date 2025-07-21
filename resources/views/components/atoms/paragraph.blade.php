@php
    $size = $size ?? 'base';

    $sizeClass = match($size) {
        'sm' => 'text-sm',
        'base' => 'text-base',
        'lg' => 'text-lg',
        default => 'text-base',
    };
@endphp

<p {{ $attributes->merge([
    'class' => "$sizeClass text-gray-700 dark:text-gray-300 leading-relaxed"
]) }}>
    {{ $slot }}
</p>
