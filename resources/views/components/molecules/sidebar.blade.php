@props(['items' => []])

<aside
    x-data
    x-bind:class="$store.sidebar.open ? 'w-56' : 'w-14'"
    class="shrink-0 bg-white dark:bg-zinc-950 border-r border-gray-200 dark:border-zinc-800/60 flex flex-col transition-all duration-300 overflow-hidden"
>
    {{-- Header: Logo + Toggle Button --}}
    <div class="flex items-center justify-between border-b border-gray-200 dark:border-zinc-800/60 h-[57px] px-3 shrink-0">
        <div class="flex items-center gap-2.5 min-w-0">
            {{-- Icon --}}
            <div class="w-7 h-7 rounded-lg bg-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>

            {{-- Label --}}
            <span
                x-show="$store.sidebar.open"
                x-transition:enter="transition-all duration-200 delay-100"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-all duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="text-sm font-semibold text-gray-800 dark:text-zinc-100 tracking-tight whitespace-nowrap"
            >Complaint System</span>
        </div>

        {{-- Toggle button --}}
        <button
            @click="$store.sidebar.toggle()"
            class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 text-gray-400 dark:text-zinc-500
                   hover:bg-gray-100 dark:hover:bg-zinc-800 hover:text-gray-600 dark:hover:text-zinc-300
                   transition-all duration-150"
            title="Toggle Sidebar"
        >
            {{-- Arrow left saat open --}}
            <svg x-show="$store.sidebar.open" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7M18 19l-7-7 7-7"/>
            </svg>
            {{-- Arrow right saat collapsed --}}
            <svg x-show="!$store.sidebar.open" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M6 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-2 py-3 space-y-0.5 overflow-hidden">
        @foreach ($items as $item)
            <a
                href="{{ $item['href'] }}"
                title="{{ $item['label'] }}"
                class="{{ $item['active']
                    ? 'flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-sm font-medium bg-blue-50 dark:bg-zinc-800 text-blue-700 dark:text-zinc-100'
                    : 'flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-sm font-medium text-gray-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800/60 hover:text-gray-800 dark:hover:text-zinc-200' }} transition-all duration-150"
            >
                <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $item['active'] ? 'bg-blue-500' : 'bg-gray-300 dark:bg-zinc-600' }}"></span>
                <span
                    x-show="$store.sidebar.open"
                    x-transition:enter="transition-all duration-200 delay-100"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-all duration-100"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="whitespace-nowrap overflow-hidden"
                >{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>
