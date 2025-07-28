@props(['complaints'])

<div class="overflow-x-auto">
    @if(request('search'))
        <div class="text-sm text-gray-400 dark:text-gray-300 mb-2">
            Hasil pencarian: "<strong>{{ request('search') }}</strong>" | Total Hasil: {{ $complaints->total() }}
        </div>
    @endif

    @if($complaints->isEmpty())
        <div class="text-sm text-gray-500 mt-4 p-4 text-center bg-gray-50 dark:bg-gray-800 rounded-lg">
            Tidak ditemukan keluhan dengan kriteria yang dicari.
        </div>
    @else
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
            <thead>
                <tr>
                    <x-atoms.sortable-heading sort_by="title">Title</x-atoms.sortable-heading>
                    <x-atoms.sortable-heading sort_by="created_at">Date</x-atoms.sortable-heading>
                    <x-atoms.sortable-heading sort_by="status">Status</x-atoms.sortable-heading>
                    <x-atoms.sortable-heading sort_by="verified_at">Verifikasi</x-atoms.sortable-heading>
                    <x-atoms.table-heading>Action</x-atoms.table-heading>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                @foreach ($complaints as $complaint)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->title }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                        <x-atoms.status-label :status="$complaint->status" />
                    </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                        @php
                            $verificationBadge = match($complaint->verification_status) {
                                'accepted' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                default => 'bg-yellow-100 text-yellow-800',
                            };
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $verificationBadge }}">
                            {{ Str::title($complaint->verification_status) }}
                        </span>
                    </td>
                        <td class="px-4 py-2 whitespace-nowrap text-indigo-500 hover:underline">
                            {{-- LOGIKA BARU UNTUK TOMBOL AKSI --}}
                            @if ($complaint->status === 'resolved')
                                @if ($complaint->feedback)
                                    {{-- Jika solved & ada feedback, tampilkan link Lihat Feedback --}}
                                    <a href="{{ route('feedback.show', $complaint->feedback->id) }}">
                                        Lihat Feedback
                                    </a>
                                @else
                                    {{-- Jika solved tapi BELUM ada feedback, tampilkan link Beri Feedback --}}
                                    <a href="{{ route('feedback.create', $complaint->id) }}">
                                        Beri Feedback
                                    </a>
                                @endif
                            @else
                                {{-- Jika belum solved, tampilkan link View detail biasa --}}
                                <a href="{{ route('complaints.show', $complaint->id) }}">
                                    View Detail
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>