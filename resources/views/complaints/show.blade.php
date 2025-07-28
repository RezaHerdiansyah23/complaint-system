
<x-templates.navigation-template 
    title="Detail Keluhan" 
    :menu-items="[
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => true],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => request()->routeIs('feedback.*')],
    ]">


<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Complaint Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    {{ $complaint->title }}
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Submitted on {{ $complaint->created_at->format('d M Y, H:i') }}
                </p>

                <p class="text-base text-gray-800 dark:text-gray-100 mt-4">
                    <strong>Description:</strong><br>
                    {{ $complaint->description }}
                </p>

                <p class="text-base">
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
                    <div>
                        <strong>Attachment:</strong><br>
                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                           class="text-blue-500 hover:underline">View Attachment</a>
                    </div>
                @endif

                {{-- (optional) nanti tampilkan catatan teknisi di sini --}}
            </div>

            <div class="mt-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:underline">← Back to Dashboard</a>
            </div>
        </div>
    </div>
</x-templates.navigation-template>