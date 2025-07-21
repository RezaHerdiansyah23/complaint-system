<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white">

    {{-- Organism Layout (Sidebar + Topbar + Content) --}}
    <x-organisms.navigation-layout :menu-items="$menuItems" :title="$title">
        {{ $slot }}
    </x-organisms.navigation-layout>

</body>
</html>
