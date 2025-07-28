@php
    // Logika untuk menentukan menu mana yang harus ditampilkan berdasarkan role
    $menuItems = [];
    if (Auth::user()->role === 'admin') {
        $menuItems = [
            ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => false],
            ['href' => route('admin.statistics.index'), 'label' => 'Statistik', 'active' => false],
            ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => false],
        ];
    } elseif (Auth::user()->role === 'noc') {
        $menuItems = [
            ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => false],
        ];
    } else {
        $menuItems = [
            ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => false],
            ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => false],
            ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => false],
        ];
    }
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Profil Akun">

    <div class="space-y-6">
        {{-- Gunakan atom card untuk setiap bagian --}}
        <x-atoms.card>
            @include('profile.partials.update-profile-information-form')
        </x-atoms.card>

        <x-atoms.card>
            @include('profile.partials.update-password-form')
        </x-atoms.card>

        <x-atoms.card>
            @include('profile.partials.delete-user-form')
        </x-atoms.card>
    </div>

</x-templates.navigation-template>