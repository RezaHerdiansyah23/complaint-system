@php
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => false],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Detail Feedback">

    {{-- 1. Tampilkan kembali detail keluhan --}}
    <x-molecules.complaint.detail-card :complaint="$feedback->complaint" />

    {{-- 2. Tampilkan feedback yang sudah kamu berikan --}}
    <div class="mt-6">
        <x-atoms.card>
            <x-atoms.heading level="4">Feedback Anda</x-atoms.heading>

            <div class="mt-4 space-y-4">
                {{-- Rating Bintang --}}
                <div>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-300">Rating:</h5>
                    <div class="flex items-center mt-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-6 h-6 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        @endfor
                        <span class="ml-2 text-gray-600 dark:text-gray-300">({{ $feedback->rating }} dari 5 bintang)</span>
                    </div>
                </div>

                {{-- Komentar --}}
                <div>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-300">Komentar:</h5>
                    <p class="mt-1 text-gray-800 dark:text-gray-100 whitespace-pre-wrap">
                        {{ $feedback->comment ?? 'Tidak ada komentar.' }}
                    </p>
                </div>
            </div>
        </x-atoms.card>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="text-sm text-indigo-500 hover:underline">
            &larr; Kembali ke Riwayat Keluhan
        </a>
    </div>

</x-templates.navigation-template>