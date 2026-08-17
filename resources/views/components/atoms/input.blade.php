@props([
    'label'       => '',
    'type'        => 'text',
    'name',
    'id'          => $name,
    'value'       => '',
    'required'    => false,
    'variant'     => 'default',
    'placeholder' => '',
])

@php
$base = 'w-full px-4 py-2.5 rounded-xl border bg-white dark:bg-zinc-800/60 text-gray-900 dark:text-zinc-100 placeholder-gray-400 dark:placeholder-zinc-500 text-sm outline-none transition-all duration-200 focus:ring-2';

$variantClass = match($variant) {
    'success'  => 'border-emerald-500/50 focus:border-emerald-500 focus:ring-emerald-500/20',
    'error'    => 'border-rose-500/50 focus:border-rose-500 focus:ring-rose-500/20',
    'disabled' => 'border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-800/30 text-gray-400 dark:text-zinc-500 cursor-not-allowed',
    default    => 'border-gray-300 dark:border-zinc-700 focus:border-blue-500 dark:focus:border-blue-500/70 focus:ring-blue-500/20',
};
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
            {{ $label }}@if($required)<span class="text-rose-400 ml-0.5">*</span>@endif
        </label>
    @endif
    <input
        id="{{ $id }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $variant === 'disabled' ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => "$base $variantClass"]) }}
    />
</div>
