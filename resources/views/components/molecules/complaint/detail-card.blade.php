@props(['complaint'])

<x-atoms.card>
    {{-- Judul dan Tanggal --}}
    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ $complaint->title }}
        </h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Dibuat pada {{ $complaint->created_at->format('d M Y, H:i') }}
        </p>
    </div>

    {{-- Grid untuk detail --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        
        {{-- Detail Pelanggan --}}
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-300">Pelanggan:</h4>
            <p class="mt-1 text-gray-800 dark:text-gray-100">
                {{ $complaint->user->full_name ?? '-' }} <br>
                <span class="text-sm text-gray-500">{{ $complaint->user->email }}</span>
            </p>
        </div>

        {{-- TAMBAHKAN NAMA PERUSAHAAN DI SINI --}}
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-300">Perusahaan:</h4>
            <p class="mt-1 text-gray-800 dark:text-gray-100">
                {{ $complaint->company_name }}
            </p>
        </div>

        {{-- Status --}}
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-300">Status:</h4>
            <div class="mt-1">
                <x-atoms.status-label :status="$complaint->status" />
            </div>
        </div>
        
        {{-- Lampiran --}}
        @if ($complaint->attachment)
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-300">Lampiran:</h4>
            <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="mt-1 text-indigo-500 hover:underline">
                Lihat Lampiran
            </a>
        </div>
        @endif

    </div>

    {{-- Deskripsi --}}
    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Deskripsi:</h4>
        <p class="mt-1 text-gray-800 dark:text-gray-100 whitespace-pre-wrap">
            {{ $complaint->description }}
        </p>
    </div>
</x-atoms.card>