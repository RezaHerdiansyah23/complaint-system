@php
    $menuItems = [
        ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="NOC Dashboard">

    <x-atoms.card>
        <div class="flex justify-between items-center mb-6">
            <x-atoms.heading level="4" class="mb-0">Keluhan yang Ditugaskan</x-atoms.heading>
            <div class="w-2/3">
                <x-molecules.filter-bar :action="route('noc.dashboard')" />
            </div>
        </div>

        {{-- Gunakan komponen tabel NOC yang baru --}}
        <x-molecules.noc.complaint-table :complaints="$complaints" />
        
        <div class="mt-4">
            <x-atoms.pagination :paginator="$complaints" />
        </div>

    </x-atoms.card>

</x-templates.navigation-template>