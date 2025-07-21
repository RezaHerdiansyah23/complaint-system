@php
    // Definisikan menu di sini
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => request()->routeIs('complaints.create')],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => request()->routeIs('dashboard')],
        ['href' => '#', 'label' => 'Feedback', 'active' => false],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Dashboard Pelanggan">

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- BAGIAN 1: STATISTIK --}}
    <div class="mb-8">
        <x-atoms.heading level="3" class="mb-4">Ringkasan Keluhan</x-atoms.heading>
        <x-molecules.stats-overview :stats="$statusCounts" />
    </div>

    {{-- BAGIAN 2: RIWAYAT KELUHAN --}}
    <x-atoms.card>
        
        {{-- Filter dan Judul --}}
        <div class="flex justify-between items-center">
            <x-atoms.heading level="4" class="mb-0">Riwayat Keluhan Anda</x-atoms.heading>
            <div class="w-2/3">
                <x-molecules.filter-bar />
            </div>
        </div>

        {{-- Tabel Keluhan --}}
        <x-molecules.complaint-table :complaints="$complaints" />
        
        {{-- Pagination --}}
        <div class="mt-4">
            <x-atoms.pagination :paginator="$complaints" />
        </div>
    </x-atoms.card>

</x-templates.navigation-template>