@props(['label', 'value', 'color' => 'blue'])

@php
$accent = match($color) {
    'bg-blue-600', 'blue'     => ['ring' => 'ring-blue-500/20',    'text' => 'text-blue-600 dark:text-blue-400',    'bg' => 'bg-blue-500/10'],
    'bg-green-600', 'green'   => ['ring' => 'ring-emerald-500/20', 'text' => 'text-emerald-600 dark:text-emerald-400', 'bg' => 'bg-emerald-500/10'],
    'bg-indigo-600', 'indigo' => ['ring' => 'ring-indigo-500/20',  'text' => 'text-indigo-600 dark:text-indigo-400',  'bg' => 'bg-indigo-500/10'],
    'bg-red-700', 'red'       => ['ring' => 'ring-rose-500/20',    'text' => 'text-rose-600 dark:text-rose-400',    'bg' => 'bg-rose-500/10'],
    default                   => ['ring' => 'ring-gray-200 dark:ring-zinc-600/30', 'text' => 'text-gray-700 dark:text-zinc-300', 'bg' => 'bg-gray-100 dark:bg-zinc-700/30'],
};
@endphp

<div class="relative overflow-hidden rounded-2xl p-5 bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 ring-1 {{ $accent['ring'] }} transition-all duration-300 hover:-translate-y-0.5">
    <p class="text-xs font-medium text-gray-500 dark:text-zinc-500 uppercase tracking-widest">{{ $label }}</p>
    <p class="text-4xl font-bold mt-2 tracking-tight {{ $accent['text'] }}">{{ $value }}</p>
    <div class="absolute bottom-0 right-0 w-24 h-24 rounded-full {{ $accent['bg'] }} blur-2xl -translate-y-2 translate-x-2 pointer-events-none"></div>
</div>
