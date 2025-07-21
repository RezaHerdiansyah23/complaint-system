@props(['users'])

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
        <thead>
            <tr>
                <x-atoms.sortable-heading sort_by="full_name">Name</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="email">Email</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="role">Role</x-atoms.sortable-heading>
                <x-atoms.sortable-heading sort_by="created_at">Created At</x-atoms.sortable-heading>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
            @forelse ($users as $user)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-indigo-600 hover:underline">
                            {{ $user->full_name }}
                        </a>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $user->email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white capitalize">{{ $user->role }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>