<header class="flex justify-between items-center px-5 py-4 bg-white dark:bg-zinc-950 border-b border-gray-200 dark:border-zinc-800/60 shrink-0 transition-colors duration-200" x-data>
    <h1 class="text-base font-semibold text-gray-800 dark:text-zinc-100 tracking-tight">{{ $title ?? 'Dashboard' }}</h1>

    <div class="flex items-center gap-3">

        {{-- Dark/Light Toggle --}}
        <button
            @click="$store.theme.toggle()"
            class="w-8 h-8 rounded-lg flex items-center justify-center border transition-all duration-200
                   bg-gray-100 dark:bg-zinc-800 border-gray-200 dark:border-zinc-700
                   hover:bg-gray-200 dark:hover:bg-zinc-700"
        >
            <svg x-show="$store.theme.dark" class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
            </svg>
            <svg x-show="!$store.theme.dark" class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>

        {{-- User dropdown --}}
        <x-dropdown align="right" width="44">
            <x-slot name="trigger">
                <button class="flex items-center gap-2.5 text-sm font-medium text-gray-500 dark:text-zinc-400 hover:text-gray-800 dark:hover:text-zinc-100 focus:outline-none transition-colors duration-150 group">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-zinc-300 transition-colors">
                        {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                    </div>
                    <span>{{ Auth::user()->full_name }}</span>
                    <svg class="w-3.5 h-3.5 text-gray-400 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    Profil Akun
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
