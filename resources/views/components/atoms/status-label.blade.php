@props(['status'])

@php
    $color = match($status) {
        'pending' => 'text-yellow-500',
        'in_progress' => 'text-blue-500',
        'resolved' => 'text-green-500',
        default => 'text-gray-500'
    };
@endphp

<span class="font-semibold {{ $color }}">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>
