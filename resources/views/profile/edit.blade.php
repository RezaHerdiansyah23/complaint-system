@php
    $menuItems = [];
    if (Auth::user()->role === 'admin') {
        $menuItems = [
            ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => request()->routeIs('admin.dashboard')],
            ['href' => route('admin.statistics.index'), 'label' => 'Statistik', 'active' => request()->routeIs('admin.statistics.*')],
            ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => request()->routeIs('admin.users.*')],
        ];
    } elseif (Auth::user()->role === 'noc') {
        $menuItems = [
            ['href' => route('noc.dashboard'), 'label' => 'Daftar Keluhan', 'active' => request()->routeIs('noc.dashboard')],
        ];
    } else {
        $menuItems = [
            ['href' => route('complaints.create'), 'label' => 'Buat Keluhan', 'active' => request()->routeIs('complaints.create')],
            ['href' => route('dashboard'), 'label' => 'Riwayat Keluhan', 'active' => request()->routeIs('dashboard')],
            ['href' => route('feedback.index'), 'label' => 'Feedback', 'active' => request()->routeIs('feedback.*')],
        ];
    }
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Profil Akun">

    <div class="space-y-6 max-w-2xl mx-auto">
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