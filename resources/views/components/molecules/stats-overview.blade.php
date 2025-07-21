@props(['stats'])

@php
    // Definisikan warna untuk setiap status
    $statusColors = [
        'Pending' => 'bg-yellow-600',
        'In Progress' => 'bg-blue-600',
        'Completed' => 'bg-green-600',
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($statusColors as $status => $color)
        <x-atoms.stat-card
            :label="$status"
            :value="$stats->get($status, 0)" 
        />
    @endforeach
</div>