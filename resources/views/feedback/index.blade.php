@php
    $menuItems = [
        ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => false],
        ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
        ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => true],
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Feedback Keluhan">

    <x-atoms.card>
        <div class="mb-6">
            <x-atoms.heading level="4">Keluhan yang Telah Selesai</x-atoms.heading>
            <p class="text-sm text-gray-500 mt-1">
                Berikut adalah daftar keluhan Anda yang telah ditangani. Silakan berikan penilaian untuk membantu kami meningkatkan layanan.
            </p>
        </div>

        {{-- Gunakan komponen tabel feedback yang baru --}}
        <x-molecules.feedback-table :complaints="$complaints" />
        
        <div class="mt-4">
            <x-atoms.pagination :paginator="$complaints" />
        </div>
    </x-atoms.card>

</x-templates.navigation-template>