<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">NOC Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Assigned Complaints</h3>

                <ul>
                    @forelse ($responses as $res)
                        <li class="mb-4">
                            <a href="{{ route('noc.complaints.show', $res->complaint->id) }}"
                               class="text-indigo-600 hover:underline">
                                {{ $res->complaint->title }}
                            </a>
                            <div class="text-sm text-gray-500">
                                From: {{ $res->complaint->user->full_name }} • Status: 
                                <span class="font-semibold">{{ ucfirst($res->complaint->status) }}</span>
                            </div>
                        </li>
                    @empty
                        <p class="text-sm text-gray-500">No complaints assigned yet.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
