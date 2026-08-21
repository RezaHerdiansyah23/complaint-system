@php
    $menuItems = [
        ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Detail Keluhan">

    {{-- Notifikasi Sukses/Error --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 dark:bg-green-900/30 p-4 text-sm font-semibold text-green-800 dark:text-green-200 border border-green-200 dark:border-green-800">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 rounded-lg bg-red-50 dark:bg-red-900/30 p-4 text-sm font-semibold text-red-800 dark:text-red-200 border border-red-200 dark:border-red-800">
            {{ session('error') }}
        </div>
    @endif

    {{-- 1. Gunakan kembali komponen detail card dari admin --}}
    <x-molecules.complaint.detail-card :complaint="$complaint" />

    {{-- 2. Tampilkan form aksi khusus untuk NOC --}}
    <div class="mt-6">
        <x-molecules.noc.response-form :complaint="$complaint" />
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6">
        <a href="{{ route('noc.dashboard') }}" class="text-sm text-indigo-500 hover:underline">
            &larr; Kembali ke Dashboard NOC
        </a>
    </div>

</x-templates.navigation-template>