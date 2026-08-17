@php
    $menuItems = [
        ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="NOC Dashboard">

    <div class="section-content">
        <section>
            <div class="section-heading flex items-end justify-between gap-4">
                <div>
                    <x-atoms.heading level="3" class="mb-1">Ringkasan tugas</x-atoms.heading>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-2xl">Keluhan yang sudah didistribusikan ke tim NOC dan perlu ditangani lebih dulu.</p>
                </div>
            </div>
            <x-molecules.noc.stats-overview :stats="$stats" />
        </section>

        <section>
            <x-atoms.card>
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-6">
                    <div>
                        <x-atoms.heading level="4" class="mb-1">Keluhan yang ditugaskan</x-atoms.heading>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan filter untuk mencari tiket yang sedang aktif ditangani.</p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        <x-molecules.filter-bar :action="route('noc.dashboard')" />
                    </div>
                </div>

                <x-molecules.noc.complaint-table :complaints="$complaints" />
                <div class="mt-6">
                    <x-atoms.pagination :paginator="$complaints" />
                </div>
            </x-atoms.card>
        </section>
    </div>

</x-templates.navigation-template>