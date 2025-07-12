<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
    {{ __('User Management') }}
</x-nav-link>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">All Complaints</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Title</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Customer</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Date</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Status</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse ($complaints as $complaint)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $complaint->title }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $complaint->user->full_name ?? '-' }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $complaint->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-2">
                                        @php
                                            $statusColor = match($complaint->status) {
                                                'pending' => 'text-yellow-500',
                                                'in_progress' => 'text-blue-500',
                                                'resolved' => 'text-green-500',
                                            };
                                        @endphp
                                        <span class="font-semibold {{ $statusColor }}">
                                            {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-blue-500 hover:underline">
                                        <a href="{{ route('admin.complaints.show', $complaint->id) }}">View</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-gray-500">No complaints found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
