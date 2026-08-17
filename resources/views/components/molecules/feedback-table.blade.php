@props(['complaints'])

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul Keluhan</th>
                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Selesai</th>
                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
            @forelse ($complaints as $complaint)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->title }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-white">{{ $complaint->updated_at->format('d M Y') }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <a href="{{ route('feedback.create', $complaint->id) }}" class="text-indigo-500 hover:underline">
                            Beri Feedback
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">Tidak ada keluhan yang perlu diberi feedback.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>