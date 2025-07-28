@props(['stats'])

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <x-atoms.stat-card 
        label="Terverifikasi" 
        :value="$stats['verified']" 
        color="bg-blue-600" 
    />
    <x-atoms.stat-card 
        label="Didistribusikan" 
        :value="$stats['distributed']" 
        color="bg-indigo-600" 
    />
    <x-atoms.stat-card 
        label="Selesai" 
        :value="$stats['completed']" 
        color="bg-green-600" 
    />
</div>