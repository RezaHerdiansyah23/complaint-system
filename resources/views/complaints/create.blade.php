<x-templates.navigation-template
    title="Buat Keluhan Baru"
    :menu-items="[
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => true],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => request()->routeIs('feedback.*')],
    ]">

    <div class="max-w-2xl mx-auto">
        <x-atoms.card>
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-zinc-100 tracking-tight">Form Keluhan</h2>
                <p class="text-sm text-gray-500 dark:text-zinc-400 mt-0.5">Isi semua field yang wajib diisi dengan benar.</p>
            </div>

            <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data" class="space-y-5" id="create-complaint-form">
                @csrf

                {{-- Title --}}
                <div>
                    <x-atoms.input
                        name="title"
                        label="Judul Keluhan"
                        type="text"
                        :required="true"
                        :variant="$errors->has('title') ? 'error' : 'default'"
                        placeholder="Contoh: Internet tidak bisa diakses"
                        autofocus
                    />
                    @error('title')
                        <x-atoms.info-box variant="error" class="mt-1.5">{{ $message }}</x-atoms.info-box>
                    @enderror
                </div>

                {{-- Company Name --}}
                <div>
                    <x-atoms.input
                        name="company_name"
                        label="Nama Perusahaan"
                        :required="true"
                        :variant="$errors->has('company_name') ? 'error' : 'default'"
                        placeholder="Nama perusahaan Anda"
                    />
                    @error('company_name')
                        <x-atoms.info-box variant="error" class="mt-1.5">{{ $message }}</x-atoms.info-box>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <x-atoms.textarea
                        name="description"
                        label="Deskripsi Lengkap"
                        rows="5"
                        :required="true"
                        :variant="$errors->has('description') ? 'error' : 'default'"
                        placeholder="Jelaskan keluhan Anda secara detail..."
                    />
                    @error('description')
                        <x-atoms.info-box variant="error" class="mt-1.5">{{ $message }}</x-atoms.info-box>
                    @enderror
                </div>

                {{-- Attachment --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                        Lampiran <span class="normal-case text-gray-400 dark:text-zinc-500">(Opsional)</span>
                    </label>
                    <label class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800/60 cursor-pointer hover:border-blue-500 dark:hover:border-blue-500/70 transition-all duration-200 group">
                        <svg class="w-4 h-4 text-gray-400 dark:text-zinc-500 group-hover:text-blue-500 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-zinc-400 group-hover:text-gray-700 dark:group-hover:text-zinc-200 transition-colors" id="file-label">Pilih file gambar...</span>
                        <input id="attachment" name="attachment" type="file" accept="image/*" class="hidden"
                               onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Pilih file gambar...'">
                    </label>
                    @error('attachment')
                        <x-atoms.info-box variant="error" class="mt-1.5">{{ $message }}</x-atoms.info-box>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                    <x-molecules.confirmation-modal variant="success" confirm-text="Ya, Kirim">
                        <x-slot name="trigger">
                            <x-atoms.button variant="success" type="button">
                                Kirim Keluhan
                            </x-atoms.button>
                        </x-slot>
                        <x-slot name="title">Konfirmasi Pengiriman Keluhan</x-slot>
                        Pastikan data yang dimasukkan sudah benar sebelum mengirim keluhan ini.
                        <x-slot name="confirmAction">
                            <x-atoms.button variant="success" type="button" onclick="document.getElementById('create-complaint-form').submit();">
                                Ya, Kirim
                            </x-atoms.button>
                        </x-slot>
                    </x-molecules.confirmation-modal>
                </div>
            </form>
        </x-atoms.card>
    </div>

</x-templates.navigation-template>
