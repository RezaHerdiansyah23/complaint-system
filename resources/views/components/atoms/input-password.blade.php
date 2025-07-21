@props([
    'label',
    'name',
    'value' => '',
    'required' => false,
])

<div class="mb-4" x-data="{ show: false }">
    <x-atoms.label :for="$name">{{ $label }}</x-atoms.label>

    <div class="relative">
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            :type="show ? 'text' : 'password'"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            autocomplete="{{ $name }}"
            {{ $attributes->merge(['class' => 'peer text-black dark:text-white pl-2 h-[40px] min-h-[40px] pr-10 leading-normal appearance-none resize-none box-border text-base w-full border border-gray-300 bg-white dark:bg-zinc-800 rounded-[10px] outline-none focus-visible:ring-4 focus-visible:border-teal-500 focus-visible:ring-[#71717a2e] dark:focus-visible:ring-[#14b8a61a]']) }}
        />

        <!-- Toggle Icon -->
        <div 
            class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500"
            @click="show = !show"
        >
            <!-- Eye -->
            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            <!-- Eye Off -->
            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.2-3.592m2.958-2.292A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-1.357 2.592M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
            </svg>
        </div>
    </div>

    <x-atoms.error :messages="$errors->get($name)" class="mt-2" />
</div>
