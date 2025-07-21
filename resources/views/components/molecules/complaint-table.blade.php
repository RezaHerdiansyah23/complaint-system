@props(['complaints'])

<div class="overflow-x-auto">
    @if(request('search'))
        <div class="text-sm text-gray-400 dark:text-gray-300 mb-2">
            Hasil pencarian: "<strong>{{ request('search') }}</strong>" <br>
            Jumlah hasil: {{ $complaints->count() }}
        </div>
    @endif

    @if($complaints->isEmpty())
        <div class="text-sm text-red-400 mt-4">
            Tidak ditemukan keluhan dengan judul "<strong>{{ request('search') }}</strong>".
        </div>
    @else
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
            <thead>
                <tr>
                     <x-atoms.sortable-heading sort_by="title">Title</x-atoms.sortable-heading>
                     <x-atoms.sortable-heading sort_by="created_at">Date</x-atoms.sortable-heading>
                     <x-atoms.sortable-heading sort_by="status">Status</x-atoms.sortable-heading>
                     <x-atoms.table-heading>Attachment</x-atoms.table-heading>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                @foreach ($complaints as $complaint)
                    <tr>
                        <x-atoms.table-cell>
                            <a href="{{ route('complaints.show', $complaint->id) }}" class="text-indigo-600 hover:underline">
                                {{ $complaint->title }}
                            </a>
                        </x-atoms.table-cell>
                        <x-atoms.table-cell>
                            {{ $complaint->created_at->format('d M Y') }}
                        </x-atoms.table-cell>
                        <x-atoms.table-cell>
                            <x-atoms.status-label :status="$complaint->status" />
                        </x-atoms.table-cell>
                        <x-atoms.table-cell>
                            @if ($complaint->attachment)
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" class="text-blue-500 hover:underline" target="_blank">View</a>
                            @else
                                -
                            @endif
                        </x-atoms.table-cell>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
