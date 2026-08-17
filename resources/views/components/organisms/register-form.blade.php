<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-zinc-100 tracking-tight">Buat akun baru</h1>
        <p class="text-sm text-gray-500 dark:text-zinc-500 mt-1">Isi data di bawah untuk mendaftar sebagai pelanggan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ loading: false }" @submit="loading = true">
        @csrf

        <x-atoms.input name="full_name" label="Nama Lengkap" :value="old('full_name')" placeholder="Nama lengkap Anda" required />
        @error('full_name')
            <x-atoms.info-box variant="error">{{ $message }}</x-atoms.info-box>
        @enderror

        <x-atoms.input name="email" type="email" label="Email" :value="old('email')" placeholder="nama@email.com" required />
        @error('email')
            <x-atoms.info-box variant="error">{{ $message }}</x-atoms.info-box>
        @enderror

        <x-atoms.input name="phone_number" label="Nomor Telepon" :value="old('phone_number')" placeholder="08xx-xxxx-xxxx" />

        <x-atoms.input-password label="Password" name="password" required />
        @error('password')
            <x-atoms.info-box variant="error">{{ $message }}</x-atoms.info-box>
        @enderror

        <x-atoms.input-password label="Konfirmasi Password" name="password_confirmation" required />

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
            <span x-show="!loading">Daftar</span>
        </button>
    </form>

    <p class="text-center text-sm text-zinc-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
            Masuk di sini
        </a>
    </p>
</div>
