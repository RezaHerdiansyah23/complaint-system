@props(['sort_by'])

@php
    $currentSortBy = request('sort_by', 'created_at');
    $currentSortDir = request('sort_dir', 'asc');
    $nextSortDir = ($currentSortBy == $sort_by && $currentSortDir == 'asc') ? 'desc' : 'asc';
    $url = url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort_by' => $sort_by, 'sort_dir' => $nextSortDir]));
@endphp

<th {{ $attributes->merge(['scope' => 'col', 'class' => 'px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700 dark:hover:text-gray-200 transition-colors']) }}>
    <a href="{{ $url }}" class="flex items-center gap-1">
        {{ $slot }}
        @if ($currentSortBy == $sort_by)
            @if ($currentSortDir == 'asc')
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
            @else
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            @endif
        @endif
    </a>
</th>