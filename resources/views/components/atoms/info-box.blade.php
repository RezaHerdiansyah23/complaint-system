@props(['variant' => 'info'])

@php
$colors = match($variant) {
    'success' => 'bg-emerald-500/10 text-emerald-300 border-l-2 border-emerald-500/50',
    'warning' => 'bg-amber-500/10 text-amber-300 border-l-2 border-amber-500/50',
    'error'   => 'bg-rose-500/10 text-rose-300 border-l-2 border-rose-500/50',
    default   => 'bg-blue-500/10 text-blue-300 border-l-2 border-blue-500/50',
};
@endphp

<div {{ $attributes->merge(['class' => "px-4 py-3 text-sm rounded-r-xl $colors"]) }}>
    {{ $slot }}
</div>
