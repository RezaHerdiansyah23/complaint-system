@props(['complaint'])

<x-atoms.card>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 pb-6 border-b border-gray-200 dark:border-gray-700 lg:flex-row lg:items-start lg:justify-between">
            <div class="space-y-3 flex-1">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="badge badge-neutral uppercase tracking-[0.1em] text-[10px] font-bold">Keluhan</span>
                    @if ($complaint->verification_status === 'accepted')
                        <span class="badge badge-info font-mono font-bold">TKT-{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span>
                    @endif
                </div>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white max-w-4xl leading-tight">
                    {{ $complaint->title }}
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Dibuat pada {{ $complaint->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
            <div class="space-y-2">
                <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400">Pelanggan</h4>
                <div class="text-gray-900 dark:text-gray-100">
                    <p class="font-semibold">{{ $complaint->user->full_name ?? '-' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $complaint->user->email }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400">Perusahaan</h4>
                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $complaint->company_name }}</p>
            </div>

            <div class="space-y-2">
                <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400">Status</h4>
                <div>
                    @if ($complaint->verification_status === 'rejected')
                        <span class="badge badge-danger">Ditolak</span>
                    @else
                        <x-atoms.status-label :status="$complaint->status" />
                    @endif
                </div>
            </div>
            
            @if ($complaint->attachment)
                <div class="space-y-2">
                    <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400">Lampiran</h4>
                    <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        Lihat lampiran
                    </a>
                </div>
            @endif
        </div>

        <div class="pt-6 border-t border-gray-200 dark:border-gray-700 space-y-2">
            <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400">Deskripsi keluhan</h4>
            <p class="text-gray-800 dark:text-gray-100 whitespace-pre-wrap leading-relaxed max-w-4xl">{{ $complaint->description }}</p>
        </div>

        @if ($complaint->response)
            <div class="pt-6 border-t border-gray-200 dark:border-gray-700 space-y-2">
                <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400">
                    Catatan NOC
                    @if ($complaint->status === 'resolved')
                        <span class="badge badge-success ml-2">Resolved</span>
                    @endif
                </h4>
                <p class="text-gray-800 dark:text-gray-100 whitespace-pre-wrap leading-relaxed max-w-4xl font-medium">{{ $complaint->response->notes ?? '-' }}</p>
            </div>
        @endif

        @if ($complaint->feedback)
            <div class="pt-6 border-t border-gray-200 dark:border-gray-700 space-y-2">
                <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400 flex items-center gap-2">
                    Feedback pelanggan
                    <span class="flex items-center gap-0.5 text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= (int) $complaint->feedback->rating ? 'fill-current' : 'text-gray-300 dark:text-gray-600' }}" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        @endfor
                    </span>
                </h4>
                @if ($complaint->feedback->comment)
                    <p class="text-gray-800 dark:text-gray-100 whitespace-pre-wrap leading-relaxed max-w-4xl">{{ $complaint->feedback->comment }}</p>
                @endif
            </div>
        @endif
    </div>
</x-atoms.card>