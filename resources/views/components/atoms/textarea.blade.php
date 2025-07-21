@props([
    'label' => '',
    'name',
    'id' => $name,
    'value' => '',
    'required' => false,
    'rows' => 3,
    'variant' => 'default',
    'placeholder' => '',
])

@php
    // Samakan base class dengan komponen input, tambahkan padding
    $baseInput = 'peer text-black dark:text-white h-auto px-0 py-2 rounded-md border text-base w-full outline-none focus:ring-4 resize-y';
    
    $variantClass = match($variant) {
        'success' => 'border-green-600 focus:border-green-600 focus:ring-green-100 dark:focus:ring-green-200',
        'error' => 'border-red-600 focus:border-red-600 focus:ring-red-100 dark:focus:ring-red-200',
        'disabled' => 'bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 cursor-not-allowed',
        default => 'border-gray-300 bg-white dark:bg-zinc-800 focus:border-teal-500 focus:ring-[#71717a2e] dark:focus:ring-[#14b8a61a]'
    };
@endphp

<div class="relative">
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder ?: ' ' }}" 
        {{ $required ? 'required' : '' }}
        {{ $variant === 'disabled' ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => "$baseInput $variantClass"]) }}
    >{{ old($name, $value) }}</textarea>

    @if ($label)
        <label 
            for="{{ $id }}" 
            class="absolute left-2 -top-2.5 text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-zinc-800 px-1 
                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-base 
                   peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-teal-500
                   transition-all"
        >
            {{ $label }}
        </label>
    @endif
</div>