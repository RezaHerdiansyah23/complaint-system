<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="antialiased transition-colors duration-200 bg-gray-50 dark:bg-zinc-950 text-gray-900 dark:text-zinc-100">
    <x-organisms.navigation-layout :menu-items="$menuItems" :title="$title">
        {{ $slot }}
    </x-organisms.navigation-layout>
</body>
</html>
