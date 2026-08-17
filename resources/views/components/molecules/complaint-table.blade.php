@props(['complaints'])

<div class="space-y-4">
    @if(request('search'))
        <div class="card-flat p-4 text-sm text-gray-600 dark:text-gray-300">
            Hasil pencarian: "<strong>{{ request('search') }}</strong>" | Total hasil: {{ $complaints->total() }}
        </div>
    @endif

    @if($complaints->isEmpty())
        <div class="card-flat p-8 text-sm text-gray-500 dark:text-gray-400 text-center">
            Tidak ditemukan keluhan dengan kriteria yang dicari.
        </div>
    @else
        <div class="table-container">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <x-atoms.table-heading>No. Tiket</x-atoms.table-heading>
                        <x-atoms.sortable-heading sort_by="title">Title</x-atoms.sortable-heading>
                        <x-atoms.sortable-heading sort_by="created_at">Date</x-atoms.sortable-heading>
                        <x-atoms.sortable-heading sort_by="status">Status</x-atoms.sortable-heading>
                        <x-atoms.sortable-heading sort_by="verified_at">Verifikasi</x-atoms.sortable-heading>
                        <x-atoms.table-heading>Action</x-atoms.table-heading>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($complaints as $complaint)
                        <tr class="table-row">
                            <td class="px-6 py-3.5 whitespace-nowrap text-gray-800 dark:text-white font-semibold">
                                @if ($complaint->verification_status === 'accepted')
                                    <span class="badge badge-info">TKT-{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span>
                                @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-gray-800 dark:text-white">
                                {{ $complaint->title }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-gray-600 dark:text-gray-400 text-sm">
                                {{ $complaint->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                @if ($complaint->verification_status === 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <x-atoms.status-label :status="$complaint->status" />
                                @endif
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                @php
                                    $verificationBadge = match($complaint->verification_status) {
                                        'accepted' => 'badge-success',
                                        'rejected' => 'badge-danger',
                                        default => 'badge-warning',
                                    };
                                @endphp
                                @if ($complaint->verification_status === 'rejected')
                                    <span class="{{ $verificationBadge }}">Ditolak</span>
                                @elseif($complaint->verification_status === 'pending')
                                    <span class="{{ $verificationBadge }}">Pending</span>
                                @else
                                    <span class="{{ $verificationBadge }}">{{ Str::title($complaint->verification_status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <a href="{{ $complaint->status === 'resolved'
                                    ? ($complaint->feedback ? route('feedback.show', $complaint->feedback->id) : route('feedback.create', $complaint->id))
                                    : route('complaints.show', $complaint->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium text-sm transition-colors">
                                    {{ $complaint->status === 'resolved'
                                        ? ($complaint->feedback ? 'Lihat Feedback' : 'Beri Feedback')
                                        : 'View Detail' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>