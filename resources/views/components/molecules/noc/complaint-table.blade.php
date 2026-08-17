@props(['complaints'])

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <x-atoms.table-heading>No. Tiket</x-atoms.table-heading>
                <x-atoms.sortable-heading sort_by="title">Title</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="company_name">Perusahaan</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="created_at">Date Assigned</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="status">Status</x-atoms.sortable-heading>
                <x-atoms.table-heading>Action</x-atoms.table-heading>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
            @forelse ($complaints as $complaint)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white font-semibold">
                        @if ($complaint->verification_status === 'accepted')
                            TKT-{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->title }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->company_name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if ($complaint->verification_status === 'rejected')
                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Ditolak
                            </span>
                        @else
                            <x-atoms.status-label :status="$complaint->status" />
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-blue-500 hover:underline">
                        <a href="{{ route('noc.complaints.show', $complaint->id) }}">Update</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">No complaints assigned to you.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>