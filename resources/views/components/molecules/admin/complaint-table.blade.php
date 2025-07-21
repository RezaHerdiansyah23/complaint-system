@props(['complaints'])

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
        <thead>
            <tr>
                <x-atoms.sortable-heading sort_by="title">Title</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="user_id">Customer</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="created_at">Date</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="status">Status</x-atoms.sortable-heading>
                <x-atoms.table-heading>Action</x-atoms.table-heading>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
            @forelse ($complaints as $complaint)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->title }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->user->full_name ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <x-atoms.status-label :status="$complaint->status" />
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-blue-500 hover:underline">
                        <a href="{{ route('admin.complaints.show', $complaint->id) }}">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">No complaints found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>