@php
    $menuItems = [
        ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="NOC Dashboard">

    {{-- Bagian Statistik --}}
    <div class="mb-6">
        <x-atoms.heading level="3" class="mb-4">Ringkasan Tugas</x-atoms.heading>
        {{-- Molekul baru untuk statistik NOC --}}
        <x-molecules.noc.stats-overview :stats="$stats" />
    </div>

    {{-- Bagian Tabel --}}
    <x-atoms.card>
        <div class="flex justify-between items-center mb-6">
            <x-atoms.heading level="4" class="mb-0">Keluhan yang Ditugaskan</x-atoms.heading>
            <div class="w-2/3">
                <x-molecules.filter-bar :action="route('noc.dashboard')" />
            </div>
        </div>

        <x-molecules.noc.complaint-table :complaints="$complaints" />
        
        <div class="mt-4">
            <x-atoms.pagination :paginator="$complaints" />
        </div>
    </x-atoms.card>

</x-templates.navigation-template>