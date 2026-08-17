@props(['stats'])

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <x-atoms.stat-card label="Tugas Aktif"  :value="$stats['aktif']"   color="bg-blue-600" />
    <x-atoms.stat-card label="Tugas Selesai" :value="$stats['selesai']" color="bg-green-600" />
</div>
