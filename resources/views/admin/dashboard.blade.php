@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => true],
        ['href' => '#', 'label' => 'Statistik Pengguna', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => request()->routeIs('admin.users.*')],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Admin Dashboard">

    <x-atoms.card>
        <div class="flex justify-between items-center mb-6">
            <x-atoms.heading level="4" class="mb-0">Daftar Semua Keluhan</x-atoms.heading>
            <div class="w-2/3">
                <x-molecules.filter-bar :action="route('admin.dashboard')" />
            </div>
        </div>

        {{-- Ganti seluruh blok tabel manual dengan komponen baru ini --}}
        <x-molecules.admin.complaint-table :complaints="$complaints" />
        
        <div class="mt-4">
            <x-atoms.pagination :paginator="$complaints" />
        </div>

    </x-atoms.card>

</x-templates.navigation-template>