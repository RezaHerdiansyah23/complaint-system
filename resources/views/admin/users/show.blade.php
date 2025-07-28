@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => false],
        ['href' => '#', 'label' => 'Statistik Pengguna', 'active' => false],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => true],
    ];
    $roleOptions = ['admin' => 'Admin', 'noc' => 'NOC'];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Detail Pengguna: {{ $user->full_name }}">

    <div class="space-y-6">

        {{-- BAGIAN 1: UPDATE INFORMASI PROFIL --}}
        <x-atoms.card>
            <x-atoms.heading level="4">Informasi Profil</x-atoms.heading>
            <x-atoms.paragraph class="mt-1">Perbarui informasi profil dan alamat email pengguna.</x-atoms.paragraph>
            
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="mt-6 space-y-6" id="update-info-form">
                @csrf
                @method('PUT')

                {{-- Full Name, Email, Role, etc. --}}
                <x-atoms.input name="full_name" label="Nama Lengkap" :value="old('full_name', $user->full_name)" :required="true" />
                <x-atoms.input name="email" type="email" label="Email" :value="old('email', $user->email)" :required="true" />

                @if ($user->role !== 'customer')
                    <x-atoms.select name="role" label="Role" :options="$roleOptions" :selectedValue="old('role', $user->role)" :required="true" />
                @else
                    <x-atoms.info-box>Role Pelanggan tidak dapat diubah.</x-atoms.info-box>
                @endif
                
                <div class="flex items-center gap-4">
                    <x-molecules.confirmation-modal confirm-text="Ya, Simpan">
                        <x-slot name="trigger">
                            <x-atoms.button variant="primary" type="button">Simpan Perubahan Info</x-atoms.button>
                        </x-slot>
                        <x-slot name="title">Konfirmasi Perubahan</x-slot>
                        Anda yakin ingin menyimpan perubahan pada profil pengguna ini?
                        <x-slot name="confirmAction">
                            <x-atoms.button variant="primary" type="button" onclick="document.getElementById('update-info-form').submit();">Ya, Simpan</x-atoms.button>
                        </x-slot>
                    </x-molecules.confirmation-modal>
                </div>
            </form>
        </x-atoms.card>

        {{-- BAGIAN 2: UPDATE PASSWORD --}}
        <x-atoms.card>
            <x-atoms.heading level="4">Update Password</x-atoms.heading>
            <x-atoms.paragraph class="mt-1">Kosongkan jika tidak ingin mengubah password.</x-atoms.paragraph>
            
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="mt-6 space-y-6" id="update-password-form">
                @csrf
                @method('PUT')

                <x-atoms.input-password name="password" label="Password Baru" />
                <x-atoms.input-password name="password_confirmation" label="Konfirmasi Password Baru" />

                <div class="flex items-center gap-4">
                    <x-molecules.confirmation-modal confirm-text="Ya, Update">
                        <x-slot name="trigger">
                            <x-atoms.button variant="secondary" type="button">Update Password</x-atoms.button>
                        </x-slot>
                        <x-slot name="title">Konfirmasi Update Password</x-slot>
                        Anda yakin ingin mengubah password pengguna ini?
                        <x-slot name="confirmAction">
                            <x-atoms.button variant="secondary" type="button" onclick="document.getElementById('update-password-form').submit();">Ya, Update</x-atoms.button>
                        </x-slot>
                    </x-molecules.confirmation-modal>
                </div>
            </form>
        </x-atoms.card>

        {{-- BAGIAN 3: HAPUS PENGGUNA --}}
        @if(Auth::id() !== $user->id) {{-- Admin tidak bisa hapus diri sendiri --}}
        <x-atoms.card>
            <x-atoms.heading level="4">Hapus Pengguna</x-atoms.heading>
            <x-atoms.paragraph class="mt-1">Setelah dihapus, semua data akan hilang permanen.</x-atoms.paragraph>

            <div class="mt-6">
                <x-molecules.confirmation-modal>
                    <x-slot name="trigger">
                        <x-atoms.button variant="danger" type="button">Hapus Pengguna Ini</x-atoms.button>
                    </x-slot>
                    <x-slot name="title">Konfirmasi Hapus Pengguna</x-slot>
                    Anda yakin ingin menghapus <strong>{{ $user->full_name }}</strong>? Tindakan ini tidak dapat diurungkan.
                    <x-slot name="confirmAction">
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-atoms.button variant="danger" type="submit">Ya, Hapus Permanen</x-atoms.button>
                        </form>
                    </x-slot>
                </x-molecules.confirmation-modal>
            </div>
        </x-atoms.card>
        @endif
    </div>
</x-templates.navigation-template>