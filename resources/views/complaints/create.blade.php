<x-templates.navigation-template 
    title="Buat Keluhan Baru" 
    :menu-items="[
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => true],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => request()->routeIs('feedback.*')],
    ]">

    <x-atoms.card>
        {{-- BERI ID PADA FORM --}}
        <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data" class="space-y-6" id="create-complaint-form">
            @csrf

            {{-- Title --}}
            <div>
                <x-atoms.input
                    name="title"
                    label="Judul Keluhan"
                    type="text"
                    :required="true"
                    :variant="$errors->has('title') ? 'error' : 'default'"
                    autofocus
                />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            
            {{-- Company Name --}}
             <div class="md:col-span-2">
                <x-atoms.input 
                    name="company_name" 
                    label="Nama Perusahaan" 
                    :required="true" 
                    :variant="$errors->has('company_name') ? 'error' : 'default'" 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
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

            {{-- UBAH BAGIAN TOMBOL MENJADI MODAL --}}
            <div class="flex items-center gap-4">
                <x-molecules.confirmation-modal variant="success" confirm-text="Ya, Kirim">
                    {{-- Tombol Pemicu Modal --}}
                    <x-slot name="trigger">
                        <x-atoms.button variant="success" type="button">
                            {{ __('Kirim Keluhan') }}
                        </x-atoms.button>
                    </x-slot>

                    {{-- Judul Modal --}}
                    <x-slot name="title">Konfirmasi Pengiriman Keluhan</x-slot>

                    {{-- Pesan Konfirmasi --}}
                    Anda yakin data yang dimasukkan sudah benar dan ingin mengirimkan keluhan ini?

                    {{-- Tombol Aksi di Dalam Modal --}}
                    <x-slot name="confirmAction">
                        <x-atoms.button variant="success" type="button" onclick="document.getElementById('create-complaint-form').submit();">
                            Ya, Kirim
                        </x-atoms.button>
                    </x-slot>
                </x-molecules.confirmation-modal>
            </div>
        </form>
    </x-atoms.card>

</x-templates.navigation-template>