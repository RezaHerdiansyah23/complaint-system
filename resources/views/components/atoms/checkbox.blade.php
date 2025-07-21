@props([
    'id',
    'name' => $id,
    'label' => '',
    'variant' => 'teal', // teal, blue, red, green, etc.
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
    class="relative flex cursor-pointer items-center gap-[1em]"
    for="{{ $id }}"
    style="--clr: {{ $color }}"
>
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="checkbox"
        class="peer appearance-none"
        {{ $attributes }}
    />

    <!-- Kotak cek -->
    <span
        class="absolute left-0 top-1/2 h-[2em] w-[2em] -translate-x-full -translate-y-1/2 rounded-[0.25em] border-[2px]"
        style="border-color: var(--clr);"
    ></span>

    <!-- SVG animasi cek -->
    <svg
        viewBox="0 0 69 89"
        class="absolute left-0 top-1/2 h-[2em] w-[2em] -translate-x-full -translate-y-1/2 duration-500 ease-out stroke-[6px]
            [stroke-dasharray:100] [stroke-dashoffset:100] peer-checked:[stroke-dashoffset:0]"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        style="stroke: var(--clr);"
    >
        <path
            d="M.93 63.984c3.436.556 7.168.347 10.147 2.45 4.521 3.19 10.198 8.458 13.647 12.596 1.374 1.65 4.181 5.922 5.598 8.048.267.4-1.31.823-1.4.35-5.744-30.636 9.258-59.906 29.743-81.18C62.29 2.486 63.104 1 68.113 1"
        ></path>
    </svg>

    <!-- Label Text -->
    @if ($label)
        <span class="text-base font-medium select-none">{{ $label }}</span>
    @endif
</label>
