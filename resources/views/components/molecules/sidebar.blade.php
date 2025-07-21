@props(['items' => []])

<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
    <div class="p-4">
        <x-atoms.heading level="3" class="mb-2">Menu</x-atoms.heading>
    </div>
    <nav class="space-y-2 px-4">
        @foreach ($items as $item)
            <x-atoms.nav-link :href="$item['href']" :active="$item['active']">
                {{ $item['label'] }}
            </x-atoms.nav-link>
        @endforeach
    </nav>
</aside>
