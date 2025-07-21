@props([
    'id',
    'name',
    'label' => '',
    'variant' => 'teal', // teal, blue, red, green, etc.
    'value' => '',
    'checked' => false,
])

@php
$colors = [
    'teal' => '#008080',
    'blue' => '#3b82f6',
    'red' => '#ef4444',
    'green' => '#22c55e',
    'purple' => '#8b5cf6',
    'orange' => '#f97316',
];

$color = $colors[$variant] ?? '#008080';
@endphp

<label
    for="{{ $id }}"
    class="relative inline-flex items-center cursor-pointer gap-3 select-none"
    style="--clr: {{ $color }}"
>
    <input
        type="radio"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if ($checked) checked @endif
        class="peer appearance-none w-[1.25rem] h-[1.25rem] border-[2px] border-[--clr] rounded-full
               relative before:content-[''] before:absolute before:top-1/2 before:left-1/2 before:w-2 before:h-2
               before:rounded-full before:bg-[--clr] before:scale-0 peer-checked:before:scale-100
               before:translate-x-[-50%] before:translate-y-[-50%] transition-all duration-200 ease-in-out"
    />
    @if ($label)
        <span class="text-base font-medium">{{ $label }}</span>
    @endif
</label>
