@props([
    'menuItems' => [],
    'title'     => 'Dashboard',
])

<div class="flex min-h-screen bg-gray-50 dark:bg-zinc-950 transition-colors duration-200" x-data>

    {{-- Sidebar --}}
    <x-molecules.sidebar :items="$menuItems" />

    {{-- Main --}}
    <div class="flex-1 flex flex-col min-w-0 transition-all duration-300">
        <x-molecules.topbar :title="$title" />

        <main class="flex-1 p-6 overflow-y-auto bg-gray-50 dark:bg-zinc-950 transition-colors duration-200">
            {{ $slot }}
        </main>
    </div>
</div>
