@props([
    'name',
    'id'            => $name,
    'label'         => '',
    'required'      => false,
    'variant'       => 'default',
    'options'       => [],
    'placeholder'   => '-- Pilih --',
    'selectedValue' => '',
])

@php
$base = 'appearance-none w-full px-4 py-2.5 pr-9 rounded-xl border bg-white dark:bg-zinc-800/60 text-gray-900 dark:text-zinc-100 text-sm outline-none transition-all duration-200 focus:ring-2';

$variantClass = match($variant) {
    'error'    => 'border-rose-500/50 focus:border-rose-500 focus:ring-rose-500/20',
    'disabled' => 'border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-800/30 text-gray-400 cursor-not-allowed',
    default    => 'border-gray-300 dark:border-zinc-700 focus:border-blue-500 dark:focus:border-blue-500/70 focus:ring-blue-500/20',
};
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
            {{ $label }}@if($required)<span class="text-rose-400 ml-0.5">*</span>@endif
        </label>
    @endif
    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $id }}"
            {{ $required ? 'required' : '' }}
            {{ $variant === 'disabled' ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => "$base $variantClass"]) }}
        >
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $key => $val)
                <option value="{{ $key }}" {{ $key == $selectedValue ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400 dark:text-zinc-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
            </svg>
        </div>
    </div>
</div>
