@props([
    // Terima prop 'action', dengan nilai default ke route pelanggan
    'action' => route('dashboard'),
    'showVerificationFilter' => false, 
])

@php
    $statusOptions = [
        'Pending' => 'Pending',
        'In Progress' => 'In Progress',
        'Completed' => 'Completed',
    ];

     $verificationOptions = [
        'pending' => 'Menunggu Verifikasi',
        'accepted' => 'Diterima',
        'rejected' => 'Ditolak',
    ];
@endphp

{{-- Gunakan variabel $action di sini, bukan route('dashboard') --}}
<form method="GET" action="{{ $action }}" class="flex items-center gap-4" id="filter-form">
    
    {{-- Input Pencarian --}}
    <div class="flex-grow">
        <x-atoms.input
            name="search"
            :value="request('search')"
            placeholder="Cari berdasarkan judul atau nama..."
            class="w-full"
        />
    </div>

    {{-- Dropdown Status --}}
    <div>
        <x-atoms.select
            name="status"
            id="status-filter" 
            :options="$statusOptions"
            :selectedValue="request('status')"
            placeholder="Semua Status"
            onchange="this.form.submit()"
        />
    </div>

    @if($showVerificationFilter)
    <div>
        <x-atoms.select
            name="verification_status"
            :options="$verificationOptions"
            :selectedValue="request('verification_status')"
            placeholder="Semua Verifikasi"
            onchange="this.form.submit()"
        />
    </div>
    @endif

    {{-- Tombol Submit --}}
    <div>
        <x-atoms.button type="submit" id="search-button" variant="primary">
            Filter
        </x-atoms.button>
    </div>

</form>

{{-- Script ini sudah benar, tidak perlu diubah --}}
<script>
    const searchButton = document.getElementById('search-button');
    searchButton.addEventListener('click', function() {
        const statusDropdown = document.getElementById('status-filter');
        statusDropdown.value = '';
    });
</script>