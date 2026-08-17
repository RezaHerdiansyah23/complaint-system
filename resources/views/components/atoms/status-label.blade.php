@props(['status'])

@php
$config = match($status) {
    'pending'     => ['class' => 'badge-warning', 'label' => 'Pending',      'dot' => 'bg-amber-400'],
    'in_progress' => ['class' => 'badge-info',    'label' => 'In Progress',  'dot' => 'bg-blue-400'],
    'resolved'    => ['class' => 'badge-success', 'label' => 'Resolved',     'dot' => 'bg-emerald-400'],
    default       => ['class' => 'badge-neutral', 'label' => ucfirst($status), 'dot' => 'bg-zinc-400'],
};
@endphp

<span class="{{ $config['class'] }} inline-flex items-center gap-1.5">
    <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }} {{ $status === 'in_progress' ? 'animate-pulse' : '' }}"></span>
    {{ $config['label'] }}
</span>
