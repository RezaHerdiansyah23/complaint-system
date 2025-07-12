<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Complaint Detail (NOC)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded p-6">
                <h3 class="text-lg font-bold">{{ $response->complaint->title }}</h3>
                <p class="text-sm text-gray-600">From: {{ $response->complaint->user->full_name }}</p>
                <p class="mt-2">{{ $response->complaint->description }}</p>
                @if ($response->complaint->attachment)
                    <p class="mt-2">
                        <a href="{{ asset('storage/' . $response->complaint->attachment) }}" target="_blank" class="text-blue-500 underline">View Attachment</a>
                    </p>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded p-6">
                <form method="POST" action="{{ route('noc.complaints.updateStatus', $response->complaint->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Update Status</label>
                        <select name="status" class="mt-1 block w-full rounded">
                            <option value="in_progress" {{ $response->complaint->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $response->complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Technical Notes</label>
                        <textarea name="notes" rows="3" class="block w-full rounded">{{ $response->notes }}</textarea>
                    </div>

                    <x-primary-button>Update Complaint</x-primary-button>
                </form>
            </div>

            <a href="{{ route('noc.dashboard') }}" class="text-indigo-600 text-sm hover:underline">← Back to Dashboard</a>
        </div>
    </div>
</x-app-layout>
