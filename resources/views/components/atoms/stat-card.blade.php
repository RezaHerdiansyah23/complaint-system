@props(['label', 'value', 'color' => 'bg-gray-700'])

<div class="{{ $color }} p-4 rounded-lg shadow-md text-white">
    <div class="text-sm font-medium text-gray-300">{{ $label }}</div>
    <div class="text-3xl font-bold mt-1">{{ $value }}</div>
</div>