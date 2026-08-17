@php
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => false],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Beri Feedback">

    <div class="max-w-4xl mx-auto">
        <x-atoms.card>
            <div class="mb-6">
                <x-atoms.heading level="4">Feedback untuk keluhan: "{{ $complaint->title }}"</x-atoms.heading>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 max-w-2xl">
                    Keluhan ini sudah selesai. Beri penilaian yang jujur agar tim tahu bagian mana yang perlu diperbaiki.
                </p>
            </div>

            <form method="POST" action="{{ route('feedback.store', $complaint->id) }}" class="space-y-6" id="feedback-form">
                @csrf

                <div>
                    <x-input-label for="rating" value="Rating (1-5)" />
                    <div class="flex items-center mt-3 gap-1.5" id="rating-container">
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

                <div>
                    <x-atoms.textarea name="comment" label="Komentar (Opsional)" rows="4" :variant="$errors->has('comment') ? 'error' : 'default'">{{ old('comment') }}</x-atoms.textarea>
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <x-molecules.confirmation-modal variant="success" confirm-text="Ya, Kirim">
                        <x-slot name="trigger">
                            <x-atoms.button variant="success" type="button">
                                Kirim Feedback
                            </x-atoms.button>
                        </x-slot>

                        <x-slot name="title">Konfirmasi pengiriman feedback</x-slot>

                        Anda yakin ingin mengirimkan feedback ini? Anda tidak akan bisa mengubahnya lagi nanti.

                        <x-slot name="confirmAction">
                            <x-atoms.button variant="success" type="button" onclick="document.getElementById('feedback-form').submit();">
                                Ya, Kirim
                            </x-atoms.button>
                        </x-slot>
                    </x-molecules.confirmation-modal>
                </div>
            </form>
        </x-atoms.card>
    </div>

</x-templates.navigation-template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ratingContainer = document.getElementById('rating-container');
        const stars = ratingContainer.querySelectorAll('.star-icon');

        ratingContainer.addEventListener('change', function (e) {
            if (e.target.name === 'rating') {
                const selectedRating = parseInt(e.target.value);

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