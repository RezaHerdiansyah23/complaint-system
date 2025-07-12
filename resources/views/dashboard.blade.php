@if (session('success'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('success') }}
    </div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Welcome, {{ Auth::user()->full_name }} 👋
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                    You can submit a new complaint or track your existing issues here.
                </p>
            </div>

            <!-- Submit Complaint Button -->
            <div class="mb-4">
                <a href="{{ route('complaints.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">
                        Submit New Complaint
                 </a>

            </div>

            <!-- (Placeholder) Complaint History List -->
            <!-- Complaint History -->
@if ($complaints->count())
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Your Complaint History</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Title</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Date</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Status</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Attachment</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    <a href="{{ route('complaints.show', $complaint->id) }}" class="text-indigo-600 hover:underline">
                                        {{ $complaint->title }}
                                    </a>
                                </td>

                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                {{ $complaint->created_at->format('d M Y') }}
                            </td>
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
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                @if ($complaint->attachment)
                                    <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="text-blue-500 hover:underline">View</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
        You haven’t submitted any complaints yet.
    </div>
@endif

        </div>
    </div>
</x-app-layout>
