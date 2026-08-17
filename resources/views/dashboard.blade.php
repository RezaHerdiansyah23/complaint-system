@php
    // Definisikan menu di sini
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => request()->routeIs('complaints.create')],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => request()->routeIs('dashboard')],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => request()->routeIs('feedback.*')],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Dashboard Pelanggan">

    @if (session('success'))
        <div class="mb-6 card-flat border-emerald-200/60 bg-emerald-50/80 dark:bg-emerald-900/20 dark:border-emerald-800/60 p-4 text-sm font-medium text-emerald-700 dark:text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="section-content">
        <section>
            <div class="section-heading flex items-end justify-between gap-4">
                <div>
                    <x-atoms.heading level="3" class="mb-1">Ringkasan keluhan</x-atoms.heading>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-2xl">Pantau status pengaduan, progres penanganan, dan keluhan yang sudah selesai di satu tempat.</p>
                </div>
            </div>
            <x-molecules.stats-overview :stats="$stats" />
        </section>

        <section>
            <x-atoms.card>
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-6">
                    <div>
                        <x-atoms.heading level="4" class="mb-1">Riwayat keluhan Anda</x-atoms.heading>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Urutkan, cari, dan buka detail keluhan dengan cepat.</p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        <x-molecules.filter-bar :action="route('dashboard')" :showVerificationFilter="true" />
                    </div>
                </div>

                <x-molecules.complaint-table :complaints="$complaints" />
                <div class="mt-6">
                    <x-atoms.pagination :paginator="$complaints" />
                </div>
            </x-atoms.card>
        </section>
    </div>

</x-templates.navigation-template>