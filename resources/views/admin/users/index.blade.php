<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">All Users</h3>

                <div class="flex justify-end mb-4">
    <a href="{{ route('admin.users.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Create User
            </a>
        </div>


                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Name</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Email</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Role</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-indigo-600 hover:underline">
                                                {{ $user->full_name }}
                                            </a>

                                    </td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white">{{ $user->email }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white capitalize">{{ $user->role }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-white">{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
