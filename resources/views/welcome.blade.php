<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Keluhan Pelanggan MTM.">
    <title>Sistem Informasi Keluhan Pelanggan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body { font-family: 'Outfit', sans-serif; }

        /* Light mode */
        .page-bg {
            background: radial-gradient(ellipse at 20% 50%, rgba(219, 234, 254, 0.6) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 50%, rgba(219, 234, 254, 0.4) 0%, transparent 60%),
                        linear-gradient(135deg, #f0f4ff 0%, #e8effe 30%, #f5f7ff 60%, #eef2ff 100%);
            min-height: 100dvh;
        }

        /* Dark mode */
        .dark .page-bg {
            background: radial-gradient(ellipse at 20% 50%, rgba(29, 78, 216, 0.12) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 50%, rgba(29, 78, 216, 0.08) 0%, transparent 60%),
                        #09090b;
            min-height: 100dvh;
        }

        /* Pill */
        .pill-left {
            position: fixed;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 160px;
            background: #2563eb;
            border-radius: 0 2rem 2rem 0;
            box-shadow: 4px 0 24px rgba(37,99,235,0.35);
        }
        .pill-right {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 160px;
            background: #2563eb;
            border-radius: 2rem 0 0 2rem;
            box-shadow: -4px 0 24px rgba(37,99,235,0.35);
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden selection:bg-blue-500/30">

<div class="page-bg flex flex-col min-h-[100dvh]">

    {{-- Pill decorations --}}
    <div class="pill-left pointer-events-none z-0"></div>
    <div class="pill-right pointer-events-none z-0"></div>

    {{-- Header --}}
    <header class="relative z-10 w-full px-6 md:px-10 py-5 flex items-center justify-between">
        {{-- Logo MTM --}}
        <img src="{{ asset('logo-mtm.png') }}" alt="Logo MTM" class="h-14 md:h-16 w-auto object-contain drop-shadow-sm">

        {{-- Dark mode toggle --}}
        <button
            @click="$store.theme.toggle()"
            class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-200 border
                   bg-white/70 dark:bg-zinc-800/70 border-blue-100 dark:border-zinc-700
                   hover:bg-white dark:hover:bg-zinc-700 backdrop-blur-sm shadow-sm"
            :title="$store.theme.dark ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
        >
            <svg x-show="$store.theme.dark" class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
            </svg>
            <svg x-show="!$store.theme.dark" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
    </header>

    {{-- Hero --}}
    <main class="relative z-10 flex-1 flex flex-col items-center justify-center px-6 py-10 text-center">

        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-tight text-blue-700 dark:text-blue-400">
            SISTEM INFORMASI<br>KELUHAN PELANGGAN
        </h1>

        <p class="mt-6 max-w-xl text-sm sm:text-base text-gray-500 dark:text-zinc-400 leading-relaxed font-medium">
            Sampaikan keluhan, masukan, dan pengaduan layanan Anda secara cepat, transparan, dan terpercaya.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="inline-flex items-center gap-2.5 px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 active:scale-[0.97] transition-all duration-200">
                    Buka Dashboard
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2.5 px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 active:scale-[0.97] transition-all duration-200">
                    Masuk Ke Aplikasi
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl border-2 border-gray-300 dark:border-zinc-600 hover:border-blue-400 dark:hover:border-blue-500 bg-white/60 dark:bg-zinc-800/60 hover:bg-white dark:hover:bg-zinc-800 text-gray-700 dark:text-zinc-200 text-sm font-bold backdrop-blur-sm hover:-translate-y-0.5 active:scale-[0.97] transition-all duration-200 shadow-sm">
                        Daftar Akun Baru
                    </a>
                @endif
            @endauth
        </div>

    </main>

    {{-- Footer --}}
    <footer class="relative z-10 w-full py-5 text-center border-t border-blue-100/60 dark:border-zinc-800/60">
        <p class="text-xs text-gray-400 dark:text-zinc-600">
            &copy; {{ date('Y') }} MTM. Hak Cipta Dilindungi Undang-Undang.
        </p>
    </footer>

</div>

</body>
</html>
