@props([
    'label'   => '',
    'name',
    'value'   => '',
    'required' => false,
    'variant'  => 'default',
])

@php
$base = 'w-full pl-4 pr-11 py-2.5 rounded-xl border bg-white dark:bg-zinc-800/60 text-gray-900 dark:text-zinc-100 placeholder-gray-400 dark:placeholder-zinc-500 text-sm outline-none transition-all duration-200 focus:ring-2';

$variantClass = match($variant) {
    'error'   => 'border-rose-500/50 focus:border-rose-500 focus:ring-rose-500/20',
    default   => 'border-gray-300 dark:border-zinc-700 focus:border-blue-500 dark:focus:border-blue-500/70 focus:ring-blue-500/20',
};
@endphp

<div class="space-y-1.5" x-data="{ show: false }">
    @if ($label)
        <label for="{{ $name }}" class="block text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
            {{ $label }}@if($required)<span class="text-rose-400 ml-0.5">*</span>@endif
        </label>
    @endif

    <div class="relative">
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            x-bind:type="show ? 'text' : 'password'"
            value="{{ old($name, $value) }}"
            placeholder=""
            {{ $required ? 'required' : '' }}
            autocomplete="{{ $name }}"
            {{ $attributes->merge(['class' => "$base $variantClass"]) }}
        />
        <button
            type="button"
            @click="show = !show"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-zinc-500 hover:text-gray-600 dark:hover:text-zinc-300 transition-colors"
        >
            <svg x-show="!show" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <svg x-show="show" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.2-3.592m2.958-2.292A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-1.357 2.592M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
            </svg>
        </button>
    </div>

    <x-atoms.error :messages="$errors->get($name)" class="mt-1" />
</div>
