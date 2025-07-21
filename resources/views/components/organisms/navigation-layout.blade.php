@props([
    'menuItems' => [],
    'title' => 'Dashboard',
])

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <x-molecules.sidebar :items="$menuItems" />

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">
        {{-- Topbar --}}
        <x-molecules.topbar :title="$title" />

        {{-- Page Content --}}
        <main class="p-6 bg-gray-100 dark:bg-gray-900 flex-1">
            {{ $slot }}
        </main>
    </div>
</div>
