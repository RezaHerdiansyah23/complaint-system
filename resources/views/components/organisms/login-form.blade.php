<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-zinc-100 tracking-tight">Masuk ke akun</h1>
        <p class="text-sm text-gray-500 dark:text-zinc-500 mt-1">Gunakan email dan password yang terdaftar.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4" x-data="{ loading: false }" @submit="loading = true">
        @csrf

        <x-atoms.input
            name="email"
            type="email"
            label="Email"
            :value="old('email')"
            placeholder="nama@email.com"
            required
        />
        @error('email')
            <x-atoms.info-box variant="error">{{ $message }}</x-atoms.info-box>
        @enderror

        <x-atoms.input-password
            label="Password"
            name="password"
            required
        />

        <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-blue-500 focus:ring-blue-500/30 focus:ring-2">
                <span class="text-sm text-gray-500 dark:text-zinc-400">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">
                    Lupa password?
                </a>
            @endif
        </div>

        <button
            type="submit"
            x-bind:disabled="loading"
            class="btn-primary w-full mt-2"
        >
            <svg x-show="loading" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24" x-cloak>
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <span x-show="loading" x-cloak>Memproses...</span>
            <span x-show="!loading">Masuk</span>
        </button>
    </form>

    @if (Route::has('register'))
        <p class="text-center text-sm text-zinc-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                Daftar sekarang
            </a>
        </p>
    @endif
</div>
