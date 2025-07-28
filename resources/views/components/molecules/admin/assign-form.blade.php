@props(['complaint', 'nocs' => []])

@php
    // Ubah format $nocs agar sesuai dengan komponen select
    $nocOptions = $nocs->mapWithKeys(function ($noc) {
        return [$noc->id => $noc->full_name . ' (' . $noc->email . ')'];
    })->all();
@endphp

<x-atoms.card>
    <x-atoms.heading level="4" class="mb-4">Distribusikan ke NOC</x-atoms.heading>

    {{-- 1. BERI ID PADA FORM --}}
    <form method="POST" action="{{ route('admin.complaints.assign', $complaint->id) }}" class="space-y-4" id="assign-form">
        @csrf

        {{-- Dropdown NOC --}}
        <x-atoms.select
            name="noc_id"
            label="Pilih Teknisi (NOC)"
            :options="$nocOptions"
            placeholder="-- Pilih Teknisi --"
            :required="true"
            :variant="$errors->has('noc_id') ? 'error' : 'default'"
        />

        {{-- Catatan Admin --}}
        <x-atoms.textarea
            name="notes"
            label="Catatan Admin (Opsional)"
            rows="3"
        />

        {{-- 2. GANTI TOMBOL BIASA DENGAN MODAL KONFIRMASI --}}
        <x-molecules.confirmation-modal variant="primary" confirm-text="Ya, Assign">
            {{-- Tombol Pemicu Modal --}}
            <x-slot name="trigger">
                <x-atoms.button variant="primary" type="button">
                    Assign Tugas
                </x-atoms.button>
            </x-slot>

            {{-- Judul Modal --}}
            <x-slot name="title">Konfirmasi Penugasan</x-slot>

            {{-- Pesan Konfirmasi (Default Slot) --}}
            Anda yakin ingin menugaskan keluhan ini? Keluhan akan diteruskan ke teknisi yang dipilih.

            {{-- Tombol Aksi di Dalam Modal --}}
            <x-slot name="confirmAction">
                <x-atoms.button variant="primary" type="button" onclick="document.getElementById('assign-form').submit();">
                    Ya, Assign
                </x-atoms.button>
            </x-slot>
        </x-molecules.confirmation-modal>

    </form>
</x-atoms.card>