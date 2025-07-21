@props(['complaint', 'nocs' => []])

@php
    // Ubah format $nocs agar sesuai dengan komponen select
    $nocOptions = $nocs->mapWithKeys(function ($noc) {
        return [$noc->id => $noc->full_name . ' (' . $noc->email . ')'];
    })->all();
@endphp

<x-atoms.card>
    <x-atoms.heading level="4" class="mb-4">Distribusikan ke NOC</x-atoms.heading>

    <form method="POST" action="{{ route('admin.complaints.assign', $complaint->id) }}" class="space-y-4">
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

        <x-atoms.button variant="primary" type="submit">
            Assign Tugas
        </x-atoms.button>
    </form>
</x-atoms.card>