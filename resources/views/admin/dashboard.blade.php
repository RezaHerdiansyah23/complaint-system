@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => true],
        ['href' => route('admin.statistics.index'), 'label' => 'Statistik', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => request()->routeIs('admin.users.*')],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Admin Dashboard">

    <div class="section-content">
        <section>
            <div class="section-heading flex items-end justify-between gap-4">
                <div>
                    <x-atoms.heading level="3" class="mb-1">Verifikasi keluhan</x-atoms.heading>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-2xl">Saring, verifikasi, dan distribusikan keluhan yang masuk dengan tampilan yang lebih fokus.</p>
                </div>
            </div>
            <x-molecules.admin.stats-overview :stats="$stats" />
        </section>

        <section>
            <x-atoms.card>
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-6">
                    <div>
                        <x-atoms.heading level="4" class="mb-1">Daftar semua keluhan</x-atoms.heading>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Keluhan baru tampil di atas sesuai urutan masuk.</p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        <x-molecules.filter-bar :action="route('admin.dashboard')" :showVerificationFilter="true" />
                    </div>
                </div>

                <x-molecules.admin.complaint-table :complaints="$complaints" />
                <div class="mt-6">
                    <x-atoms.pagination :paginator="$complaints" />
                </div>
            </x-atoms.card>
        </section>
    </div>

</x-templates.navigation-template>