
@props([
    'name',
    'id' => $name,
    'label' => '',
    'required' => false,
    'variant' => 'default',
    'options' => [],
    'placeholder' => '-- Select an option --',
    'selectedValue' => '' 
])

@php
$borderClass = match($variant) {
    'success' => 'border-green-500 focus:border-green-500 focus:ring-green-100',
    'error' => 'border-red-500 focus:border-red-500 focus:ring-red-100',
    'disabled' => 'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed',
    default => 'border-gray-400 focus:border-blue-500 focus:ring-blue-100'
};
@endphp

<div class="w-full max-w-xs">
    @if ($label)
        <label for="{{ $id }}" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $id }}"
            {{ $required ? 'required' : '' }}
            {{ $variant === 'disabled' ? 'disabled' : '' }}
            {{ $attributes->merge([
                'class' => "appearance-none text-sm font-semibold rounded-lg w-full px-4 py-2 border $borderClass bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 transition"
            ]) }}
        >
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $key => $val)
                {{-- UBAH BAGIAN INI untuk mengecek value yang aktif --}}
                <option value="{{ $key }}" {{ $key == $selectedValue ? 'selected' : '' }}>
                    {{ $val }}
                </option>
            @endforeach
        </select>

        {{-- Chevron Icon --}}
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6"></path>
            </svg>
        </div>
    </div>
</div>