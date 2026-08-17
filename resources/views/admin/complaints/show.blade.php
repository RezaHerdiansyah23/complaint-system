@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => true],
        ['href' => route('admin.statistics.index'), 'label' => 'Statistik', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => request()->routeIs('admin.users.*')],
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

    {{-- Tampilkan Detail Keluhan --}}
    <x-molecules.complaint.detail-card :complaint="$complaint" />

    {{-- Tampilkan Info Verifikasi --}}
    <div class="mt-6">
        @if ($complaint->verification_status === 'accepted')
            <x-atoms.info-box variant="success">Keluhan ini sudah diterima.</x-atoms.info-box>
        @elseif ($complaint->verification_status === 'rejected')
            <x-atoms.info-box variant="error">Keluhan ini telah ditolak.</x-atoms.info-box>
        @else
            <x-atoms.info-box variant="warning">Keluhan ini sedang menunggu verifikasi.</x-atoms.info-box>
        @endif
    </div>

    {{-- Tampilkan Form/Info Aksi Berdasarkan KONDISI BARU --}}
    <div class="mt-6">
        @if ($complaint->verification_status === 'pending')
            <x-atoms.card>
                <x-atoms.heading level="4">Aksi Verifikasi</x-atoms.heading>
                <p class="text-sm text-gray-500 mt-2 mb-4">Terima keluhan untuk meneruskannya ke tim teknis, atau Tolak jika tidak sesuai.</p>
                <div class="flex items-center gap-4">
                    
                    {{-- Tombol Terima dengan Modal --}}
                    <form method="POST" action="{{ route('admin.complaints.accept', $complaint->id) }}" id="accept-form">
                        @csrf
                        <x-molecules.confirmation-modal variant="success" confirm-text="Ya, Terima">
                            <x-slot name="trigger">
                                <x-atoms.button variant="success" type="button">Terima Keluhan</x-atoms.button>
                            </x-slot>
                            <x-slot name="title">Konfirmasi Penerimaan</x-slot>
                            Anda yakin ingin MENERIMA keluhan ini?
                            <x-slot name="confirmAction">
                                <x-atoms.button variant="success" type="button" onclick="document.getElementById('accept-form').submit();">
                                    Ya, Terima
                                </x-atoms.button>
                            </x-slot>
                        </x-molecules.confirmation-modal>
                    </form>

                    {{-- Tombol Tolak dengan Modal --}}
                    <form method="POST" action="{{ route('admin.complaints.reject', $complaint->id) }}" id="reject-form">
                        @csrf
                        <x-molecules.confirmation-modal variant="danger" confirm-text="Ya, Tolak">
                            <x-slot name="trigger">
                                <x-atoms.button variant="danger" type="button">Tolak Keluhan</x-atoms.button>
                            </x-slot>
                            <x-slot name="title">Konfirmasi Penolakan</x-slot>
                            Anda yakin ingin MENOLAK keluhan ini?
                            <x-slot name="confirmAction">
                                <x-atoms.button variant="danger" type="button" onclick="document.getElementById('reject-form').submit();">
                                    Ya, Tolak
                                </x-atoms.button>
                            </x-slot>
                        </x-molecules.confirmation-modal>
                    </form>

                </div>
            </x-atoms.card>
            
        @elseif ($complaint->verification_status === 'accepted' && $complaint->status === 'pending' && !$complaint->response)
            <x-molecules.admin.assign-form :complaint="$complaint" :nocs="$nocs" />
        @elseif ($complaint->response)
            <x-atoms.info-box variant="info">
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