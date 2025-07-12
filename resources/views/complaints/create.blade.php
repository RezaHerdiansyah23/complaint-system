<x-app-layout>
    <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submit Complaint') }}
        </h2>
    </x-slot>



      <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Attachment -->
                    <div class="mb-4">
                        <x-input-label for="attachment" :value="__('Attachment (optional)')" />
                        <input id="attachment" name="attachment" type="file" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>