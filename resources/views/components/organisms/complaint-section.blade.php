@props(['complaints' => []])

<div class="space-y-6">

    {{-- Heading & Search --}}
    <div class="flex justify-between items-center">
        <x-atoms.heading level="4" class="mb-0">Riwayat Keluhan Anda</x-atoms.heading>

      <div class="flex justify-between items-center">
    <x-atoms.heading level="4" class="mb-0">Riwayat Keluhan Anda</x-atoms.heading>

    {{-- GANTI DENGAN MOLEKUL FILTER BAR YANG BARU --}}
    <div class="w-2/3">
        <x-molecules.filter-bar />
    </div>
</div>


    </div>

    {{-- Tabel --}}
    <x-molecules.complaint-table :complaints="$complaints" />

    <div class="mt-4">
    <x-atoms.pagination :paginator="$complaints" />
</div>

</div>
