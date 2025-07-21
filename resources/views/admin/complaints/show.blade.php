@php
    // Definisikan menu untuk navigasi admin
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => true],
        ['href' => '#', 'label' => 'Statistik Pengguna', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => request()->routeIs('admin.users.*')],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Detail Keluhan">

    {{-- 1. Tampilkan Detail Keluhan (Reusable) --}}
    <x-molecules.complaint.detail-card :complaint="$complaint" />

    {{-- 2. Tampilkan Form/Info Aksi Berdasarkan Kondisi --}}
    <div class="mt-6">
        @if ($complaint->status === 'pending' && !$complaint->response)
            {{-- Jika status pending & belum di-assign, tampilkan form assign --}}
            <x-molecules.admin.assign-form :complaint="$complaint" :nocs="$nocs" />

        @elseif ($complaint->response)
            {{-- Jika sudah di-assign, tampilkan info --}}
            <x-atoms.info-box variant="success">
                Keluhan ini sudah ditugaskan kepada: <strong>{{ $complaint->response->noc->full_name ?? 'NOC' }}</strong>
            </x-atoms.info-box>
        @endif
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-500 hover:underline">
            &larr; Kembali ke Dashboard Admin
        </a>
    </div>

</x-templates.navigation-template>