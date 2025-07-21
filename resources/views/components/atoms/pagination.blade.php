@props(['paginator'])

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        {{-- Bagian Kiri: Menampilkan informasi "Showing X to Y of Z results" --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-400 leading-5">
                    Showing
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            {{-- Bagian Kanan: Link Halaman --}}
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Tombol "Previous" --}}
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 {{ $paginator->onFirstPage() ? 'cursor-not-allowed opacity-50' : '' }}">
                        &laquo; Previous
                    </a>

                    {{-- Tombol "Next" --}}
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative -ml-px inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 {{ !$paginator->hasMorePages() ? 'cursor-not-allowed opacity-50' : '' }}">
                        Next &raquo;
                    </a>
                </span>
            </div>
        </div>
    </nav>
@endif