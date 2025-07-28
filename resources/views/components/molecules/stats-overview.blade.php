@props(['stats'])

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <x-atoms.stat-card 
        label="Aktif" 
        :value="$stats['aktif']" 
        color="bg-blue-600" 
    />
    <x-atoms.stat-card 
        label="Selesai (Resolved)" 
        :value="$stats['selesai']" 
        color="bg-green-600" 
    />
    <x-atoms.stat-card 
        label="Ditolak" 
        :value="$stats['ditolak']" 
        color="bg-red-600" 
    />
</div>