<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="antialiased bg-gray-50 dark:bg-zinc-950 text-gray-900 dark:text-zinc-100 transition-colors duration-200">

<div class="min-h-[100dvh] flex flex-col justify-center items-center px-6 py-12 relative">

    {{-- Dark mode toggle --}}
    <div class="absolute top-5 right-6" x-data>
        <button
            @click="$store.theme.toggle()"
            class="w-9 h-9 rounded-xl flex items-center justify-center border transition-all duration-200
                   bg-white dark:bg-zinc-800 border-gray-200 dark:border-zinc-700
                   hover:bg-gray-100 dark:hover:bg-zinc-700 shadow-sm"
        >
            <svg x-show="$store.theme.dark" class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
            </svg>
            <svg x-show="!$store.theme.dark" class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
    </div>

    {{-- Form container --}}
    <div class="w-full max-w-sm">
        {{ $slot }}
    </div>

</div>

</body>
</html>
