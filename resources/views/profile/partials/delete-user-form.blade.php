<section class="space-y-6">
    <header>
        <x-atoms.heading level="3">
            {{ __('Hapus Akun') }}
        </x-atoms.heading>
        <x-atoms.paragraph class="mt-1">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.') }}
        </x-atoms.paragraph>
    </header>

    <x-molecules.confirmation-modal>
        <x-slot name="trigger">
            <x-atoms.button variant="danger" type="button">
                {{ __('Hapus Akun') }}
            </x-atoms.button>
        </x-slot>

        <x-slot name="title">Konfirmasi Hapus Akun</x-slot>

        <form method="post" action="{{ route('profile.destroy') }}" id="delete-user-form">
            @csrf
            @method('delete')

            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Masukkan password Anda untuk mengkonfirmasi penghapusan akun secara permanen.') }}
            </p>

            <div class="mt-6">
                <x-atoms.input-password
                    name="password"
                    label="Password"
                    :variant="$errors->userDeletion->has('password') ? 'error' : 'default'"
                />
                @if($errors->userDeletion->has('password'))
                    <x-atoms.info-box variant="error" class="mt-2">{{ $errors->userDeletion->first('password') }}</x-atoms.info-box>
                @endif
            </div>
        </form>

        <x-slot name="confirmAction">
            <x-atoms.button variant="danger" type="button" onclick="document.getElementById('delete-user-form').submit();">
                {{ __('Hapus Akun') }}
            </x-atoms.button>
        </x-slot>
    </x-molecules.confirmation-modal>

</section>