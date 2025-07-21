@props(['sort_by'])

@php
    $currentSortBy = request('sort_by', 'created_at');
    $currentSortDir = request('sort_dir', 'desc');
    $nextSortDir = ($currentSortBy == $sort_by && $currentSortDir == 'asc') ? 'desc' : 'asc';
    $url = url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort_by' => $sort_by, 'sort_dir' => $nextSortDir]));
@endphp

<th {{ $attributes->merge(['scope' => 'col', 'class' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider']) }}>
    <a href="{{ $url }}" class="flex items-center gap-2">
        {{ $slot }}
        @if ($currentSortBy == $sort_by)
            @if ($currentSortDir == 'asc') <span>▲</span> @else <span>▼</span> @endif
        @endif
    </a>
</th>