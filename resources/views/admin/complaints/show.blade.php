<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Complaint Detail (Admin)
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ $complaint->title }}
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Submitted on {{ $complaint->created_at->format('d M Y, H:i') }}
                </p>

                <p class="mt-3">
                    <strong class="text-gray-700 dark:text-gray-300">Customer:</strong>
                    {{ $complaint->user->full_name ?? '-' }} ({{ $complaint->user->email }})
                </p>

                <p class="mt-3 text-gray-800 dark:text-gray-100">
                    <strong>Description:</strong><br>
                    {{ $complaint->description }}
                </p>

                <p class="mt-3">
                    <strong>Status:</strong>
                    <span class="font-semibold
                        @if($complaint->status == 'pending') text-yellow-500
                        @elseif($complaint->status == 'in_progress') text-blue-500
                        @elseif($complaint->status == 'resolved') text-green-500
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                    </span>
                </p>

                @if ($complaint->attachment)
                    <div class="mt-3">
                        <strong>Attachment:</strong><br>
                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="text-blue-500 hover:underline">View Attachment</a>
                    </div>
                @endif
            </div>

            @if ($complaint->status === 'pending' && !$complaint->response)
    <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded shadow-sm">
        <h4 class="text-md font-bold text-gray-800 dark:text-white mb-4">Distribute to NOC</h4>

        <form method="POST" action="{{ route('admin.complaints.assign', $complaint->id) }}">
            @csrf

            <!-- Dropdown NOC -->
            <div class="mb-4">
                <label for="noc_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select NOC (Technician)</label>
                <select name="noc_id" id="noc_id" required class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                    <option value="">-- Choose Technician --</option>
                    @foreach ($nocs as $noc)
                        <option value="{{ $noc->id }}">{{ $noc->full_name }} ({{ $noc->email }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Catatan admin (optional) -->
            <div class="mb-4">
                  <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Admin Notes (optional)</label>
                  <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded dark:bg-gray-700 dark:text-white"></textarea>
                 </div>

              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Assign</button>
                    </form>
                </div>
            @elseif ($complaint->response)
                <div class="mt-6 text-sm text-green-600 dark:text-green-400">
                    This complaint has already been assigned to: <strong>{{ $complaint->response->noc->full_name ?? 'NOC' }}</strong>
                </div>
              @endif


            <div class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 hover:underline">← Back to Admin Dashboard</a>
            </div>
        </div>
    </div>
</x-app-layout>
