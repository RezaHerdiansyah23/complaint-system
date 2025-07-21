@php
    $menuItems = [
        ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Detail Keluhan">

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