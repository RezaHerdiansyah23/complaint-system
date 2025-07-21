<x-templates.navigation-template 
    title="Buat Keluhan Baru" 
    :menu-items="[
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => true],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => '#', 'label' => 'Feedback', 'active' => false],
    ]">

    <x-atoms.card>
        <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <x-atoms.input
                    name="title"
                    label="Judul Keluhan"
                    type="text"
                    :required="true"
                    autofocus
                />
                {{-- Komponen error tetap dipertahankan karena atom input tidak menanganinya --}}
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div>
                <x-atoms.textarea
                    name="description"
                    label="Deskripsi Lengkap"
                    rows="5"
                    :required="true"
                    :variant="$errors->has('description') ? 'error' : 'default'"
                />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            {{-- Attachment --}}
            <div>
                <x-input-label for="attachment" :value="__('Lampiran (Opsional)')" />
                <input id="attachment" name="attachment" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200"/>
                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-atoms.button variant="success" type="submit">
                    {{ __('Kirim Keluhan') }}
                </x-atoms.button>
            </div>
        </form>
    </x-atoms.card>

</x-templates.navigation-template>s