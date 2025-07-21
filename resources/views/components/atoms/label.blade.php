@props([
  'for' => null,
  'variant' => 'default',
  'value' => null,
])

@php
  $classes = match($variant) {
    'accent' => 'text-sm font-semibold text-teal-600 dark:text-teal-400',
    'disabled' => 'text-sm font-medium text-gray-400 cursor-not-allowed',
    default => 'text-sm font-medium text-gray-700 dark:text-gray-300',
  };
@endphp

<label @if($for) for="{{ $for }}" @endif {{ $attributes->merge(['class' => 'block ' . $classes]) }}>
  {{ $value ?? $slot }}
</label>
