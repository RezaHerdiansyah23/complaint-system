@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => true],
        ['href' => route('admin.statistics.index'), 'label' => 'Statistik', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => request()->routeIs('admin.users.*')],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Admin Dashboard">

     <div class="mb-6">
        <x-molecules.admin.stats-overview :stats="$stats" />
    </div>



    <x-atoms.card>
        <div class="flex justify-between items-center mb-6">
            <x-atoms.heading level="4" class="mb-0">Daftar Semua Keluhan</x-atoms.heading>
            <div class="w-2/3">
                <x-molecules.filter-bar
                 :action="route('admin.dashboard')"
                 :showVerificationFilter="true" 
 
                 />
            </div>
        </div>

        <x-molecules.admin.complaint-table :complaints="$complaints" />
        
        <div class="mt-4">
            <x-atoms.pagination :paginator="$complaints" />
        </div>

    </x-atoms.card>

</x-templates.navigation-template>