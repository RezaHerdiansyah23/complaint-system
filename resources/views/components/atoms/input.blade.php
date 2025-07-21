@props([
    'label' => '',
    'type' => 'text',
    'name',
    'id' => $name,
    'value' => '',
    'required' => false,
    'variant' => 'default',
    'placeholder' => '',
])

@php
$baseInput = 'peer text-black dark:text-white pl-4 h-[40px] pr-4 rounded-md border text-base w-full outline-none focus:ring-4';
$variantClass = match($variant) {
    'success' => 'border-green-600 focus:border-green-600 focus:ring-green-100 dark:focus:ring-green-200',
    'error' => 'border-red-600 focus:border-red-600 focus:ring-red-100 dark:focus:ring-red-200',
    'disabled' => 'bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 cursor-not-allowed',
    default => 'border-gray-300 bg-white dark:bg-zinc-800 focus:border-teal-500 focus:ring-[#71717a2e] dark:focus:ring-[#14b8a61a]'
};
@endphp

<div class="relative">
    <input
        id="{{ $id }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder ?: ' ' }}"
        {{ $required ? 'required' : '' }}
        {{ $variant === 'disabled' ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => "$baseInput $variantClass"]) }}
    />

    @if ($label)
        <label for="{{ $id }}" class="absolute left-2 top-[-12px] text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 px-1">
            {{ $label }}
        </label>
    @endif
</div>
