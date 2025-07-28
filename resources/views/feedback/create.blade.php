@php
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => false],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => true],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => false],
    ];
@endphp

Tentu, mari kita terapkan modal konfirmasi pada tombol "Kirim Feedback".

Karena tombol ini adalah tombol submit untuk sebuah form, kita perlu sedikit trik JavaScript agar modal bisa mengirimkan form utama.

Kode feedback/create.blade.php yang Diperbarui
Ini adalah kode lengkap untuk file tersebut setelah modal konfirmasi diterapkan.

PHP

@php
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => false],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => true],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => false],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Beri Feedback">

    <x-atoms.card>
        <x-atoms.heading level="4">Feedback untuk Keluhan: "{{ $complaint->title }}"</x-atoms.heading>
        <p class="text-sm text-gray-500 mt-1 mb-6">
            Keluhan ini telah diselesaikan. Mohon berikan penilaian Anda terhadap penanganan yang telah dilakukan.
        </p>

        {{-- BERI ID PADA FORM --}}
        <form method="POST" action="{{ route('feedback.store', $complaint->id) }}" class="space-y-6" id="feedback-form">
            @csrf

            {{-- Rating Bintang --}}
            <div>
                <x-input-label for="rating" value="Rating (1-5)" />
                <div class="flex items-center mt-2" id="rating-container">
                    @for ($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer">
                            <input type="radio" name="rating" value="{{ $i }}" class="sr-only" {{ old('rating') == $i ? 'checked' : '' }}>
                            <svg class="star-icon w-8 h-8 {{ old('rating', 0) >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" data-rating-value="{{ $i }}">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        </label>
                    @endfor
                </div>
                <x-input-error :messages="$errors->get('rating')" class="mt-2" />
            </div>

            {{-- Komentar --}}
            <div>
                <x-atoms.textarea name="comment" label="Komentar (Opsional)" rows="4" :variant="$errors->has('comment') ? 'error' : 'default'">{{ old('comment') }}</x-atoms.textarea>
                <x-input-error :messages="$errors->get('comment')" class="mt-2" />
            </div>
            
            {{-- UBAH BAGIAN TOMBOL MENJADI MODAL --}}
            <div class="flex items-center gap-4">
                <x-molecules.confirmation-modal variant="success" confirm-text="Ya, Kirim">
                    {{-- 1. Tombol Pemicu Modal --}}
                    <x-slot name="trigger">
                        <x-atoms.button variant="success" type="button">
                            Kirim Feedback
                        </x-atoms.button>
                    </x-slot>

                    {{-- 2. Judul Modal --}}
                    <x-slot name="title">Konfirmasi Pengiriman Feedback</x-slot>

                    {{-- 3. Pesan Konfirmasi --}}
                    Anda yakin ingin mengirimkan feedback ini? Anda tidak akan bisa mengubahnya lagi nanti.

                    {{-- 4. Tombol Aksi di Dalam Modal --}}
                    <x-slot name="confirmAction">
                        {{-- Tombol ini akan men-submit form utama menggunakan JavaScript --}}
                        <x-atoms.button variant="success" type="button" onclick="document.getElementById('feedback-form').submit();">
                            Ya, Kirim
                        </x-atoms.button>
                    </x-slot>
                </x-molecules.confirmation-modal>
            </div>
        </form>
    </x-atoms.card>

</x-templates.navigation-template>
{{-- SCRIPT BARU UNTUK INTERAKSI BINTANG --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ratingContainer = document.getElementById('rating-container');
        const stars = ratingContainer.querySelectorAll('.star-icon');

        // Event listener pada container untuk efisiensi
        ratingContainer.addEventListener('change', function (e) {
            // Pastikan yang berubah adalah input rating
            if (e.target.name === 'rating') {
                const selectedRating = parseInt(e.target.value);
                
                // Ubah warna semua bintang berdasarkan rating yang dipilih
                stars.forEach(star => {
                    const ratingValue = parseInt(star.dataset.ratingValue);
                    if (ratingValue <= selectedRating) {
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                    } else {
                        star.classList.add('text-gray-300');
                        star.classList.remove('text-yellow-400');
                    }
                });
            }
        });
    });
</script>