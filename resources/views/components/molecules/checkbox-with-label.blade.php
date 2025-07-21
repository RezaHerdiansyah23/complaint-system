@props(['name', 'label'])

<div class="block mt-4">
    <label for="{{ $name }}" class="inline-flex items-center">
        <input id="{{ $name }}" type="checkbox" name="{{ $name }}" class="mr-2">
        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $label }}</span>
    </label>
</div>