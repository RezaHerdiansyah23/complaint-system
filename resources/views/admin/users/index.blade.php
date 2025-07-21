@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => false],
        ['href' => '#', 'label' => 'Statistik Pengguna', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Kelola Pengguna">

    <x-atoms.card>
        <div class="flex justify-between items-center mb-6">
            <x-atoms.heading level="4" class="mb-0">Daftar Semua Pengguna</x-atoms.heading>

            <a href="{{ route('admin.users.create') }}">
                <x-atoms.button variant="primary">
                    + Buat Pengguna Baru
                </x-atoms.button>
            </a>
        </div>

        {{-- UBAH BAGIAN FORM PENCARIAN DI SINI --}}
        <div class="mb-4 max-w-md">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-x-2">
                <div class="flex-grow">
                    <x-atoms.input name="search" :value="request('search')" placeholder="Cari nama atau email pengguna..." />
                </div>
                <x-atoms.button type="submit" variant="primary">
                    Cari
                </x-atoms.button>
            </form>
        </div>

        {{-- Komponen tabel --}}
        <x-molecules.admin.user-table :users="$users" />
        
        {{-- Pagination --}}
        <div class="mt-4">
            <x-atoms.pagination :paginator="$users" />
        </div>

    </x-atoms.card>

</x-templates.navigation-template>