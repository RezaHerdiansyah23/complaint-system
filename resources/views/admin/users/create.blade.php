@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => false],
        ['href' => '#', 'label' => 'Statistik Pengguna', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => true],
    ];
    $roleOptions = ['admin' => 'Admin', 'noc' => 'NOC'];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Buat Pengguna Baru">

    <x-atoms.card>
        {{-- UBAH BAGIAN FORM INI --}}
        <form method="POST" action="{{ route('admin.users.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
            @csrf

            {{-- Full Name --}}
            <div class="md:col-span-2">
                <x-atoms.input name="full_name" label="Nama Lengkap" :required="true" :variant="$errors->has('full_name') ? 'error' : 'default'" autofocus />
                <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
            </div>

            {{-- Email --}}
            <div class="md:col-span-2">
                <x-atoms.input name="email" type="email" label="Email" :required="true" :variant="$errors->has('email') ? 'error' : 'default'" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            {{-- Password --}}
            <div>
                <x-atoms.input-password name="password" label="Password" :required="true" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Confirm Password --}}
            <div>
                <x-atoms.input-password name="password_confirmation" label="Konfirmasi Password" :required="true" />
            </div>
            
            {{-- Role --}}
            <div class="md:col-span-2">
                <x-atoms.select name="role" label="Role" :options="$roleOptions" :selectedValue="old('role')" :required="true" :variant="$errors->has('role') ? 'error' : 'default'" />
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>

            {{-- Tombol --}}
            <div class="md:col-span-2 flex items-center gap-4">
                <x-atoms.button variant="success" type="submit">
                    Buat Pengguna
                </x-atoms.button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </x-atoms.card>

</x-templates.navigation-template>