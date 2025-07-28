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

<div x-data="{ open: false }" @keydown.escape.window="open = false">
    {{-- Tombol Pemicu (Trigger) --}}
    <div @click="open = true">
        {{ $trigger }}
    </div>

    {{-- Overlay & Modal --}}
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        x-cloak
    >
        {{-- Card Konten Modal --}}
        <x-atoms.card @click.outside="open = false" class="w-full max-w-md">
            {{-- Judul --}}
            <x-atoms.heading level="4">{{ $title }}</x-atoms.heading>

            {{-- Pesan/Deskripsi --}}
            <div class="mt-2">
                <x-atoms.paragraph>{{ $slot }}</x-atoms.paragraph>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex justify-end gap-4">
                {{-- Tombol Batal --}}
                <x-atoms.button variant="secondary" type="button" @click="open = false">
                    {{ $cancelText }}
                </x-atoms.button>
                
                {{-- Tombol Konfirmasi (slot) --}}
                {{ $confirmAction }}
            </div>
        </x-atoms.card>
    </div>
</div>