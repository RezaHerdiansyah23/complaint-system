@props([
    'title' => 'Konfirmasi Tindakan',
    'confirmText' => 'Konfirmasi',
    'cancelText' => 'Batal',
    'variant' => 'danger', // Warna tombol konfirmasi (danger, success, etc.)
])

{{-- 
    Penggunaan:
    Wrap elemen pemicu (trigger) dengan komponen ini.
    Contoh:
    <x-molecules.confirmation-modal>
        <x-slot name="trigger">
            <x-atoms.button variant="danger">Hapus</x-atoms.button>
        </x-slot>
        <x-slot name="title">Hapus Pengguna</x-slot>
        <p>Anda yakin ingin menghapus pengguna ini?</p>
        <x-slot name="confirmAction">
            <form method="POST" action="/link-hapus">
                @csrf
                @method('DELETE')
                <x-atoms.button type="submit" variant="danger">Ya, Hapus</x-atoms.button>
            </form>
        </x-slot>
    </x-molecules.confirmation-modal>
--}}

<div x-data="{ open: false, loading: false }" @keydown.escape.window="open = false">
    <div @click.prevent="open = true">
        {{ $trigger }}
    </div>

    <template x-teleport="body">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 dark:bg-zinc-950/80 backdrop-blur-sm"
            x-cloak
        >
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.outside="!loading && (open = false)"
                class="w-full max-w-md mx-4"
            >
                <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-2xl shadow-[0_24px_48px_-12px_rgba(0,0,0,0.15)] dark:shadow-[0_24px_48px_-12px_rgba(0,0,0,0.7)] p-6">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-zinc-100 tracking-tight">{{ $title }}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-zinc-400 leading-relaxed">{{ $slot }}</p>

                    <div class="mt-6 flex justify-end gap-3">
                        <x-atoms.button variant="secondary" type="button" @click="open = false">
                            {{ $cancelText }}
                        </x-atoms.button>

                        <div @click="loading = true" class="contents">
                            <div x-show="!loading">
                                {{ $confirmAction }}
                            </div>
                            <button
                                x-show="loading"
                                disabled
                                class="btn-secondary opacity-60 cursor-not-allowed flex items-center gap-2"
                            >
                                <svg class="animate-spin w-3.5 h-3.5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                </svg>
                                <span class="text-sm">Memproses...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>