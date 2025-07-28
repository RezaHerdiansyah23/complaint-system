<section>
    <header>
        <x-atoms.heading level="3">
            {{ __('Update Password') }}
        </x-atoms.heading>

        <x-atoms.paragraph class="mt-1">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </x-atoms.paragraph>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" id="password-update-form">
        @csrf
        @method('put')

        <div>
            <x-atoms.input-password name="current_password" label="Password Saat Ini" :required="true" :variant="$errors->updatePassword->has('current_password') ? 'error' : 'default'" />
            @if($errors->updatePassword->has('current_password'))
                <x-atoms.info-box variant="error" class="mt-2">{{ $errors->updatePassword->first('current_password') }}</x-atoms.info-box>
            @endif
        </div>

        <div>
            <x-atoms.input-password name="password" label="Password Baru" :required="true" :variant="$errors->updatePassword->has('password') ? 'error' : 'default'" />
            @if($errors->updatePassword->has('password'))
                <x-atoms.info-box variant="error" class="mt-2">{{ $errors->updatePassword->first('password') }}</x-atoms.info-box>
            @endif
        </div>

        <div>
            <x-atoms.input-password name="password_confirmation" label="Konfirmasi Password Baru" :required="true" />
        </div>

        <div class="flex items-center gap-4">
            <x-molecules.confirmation-modal variant="primary" confirm-text="Ya, Simpan">
                <x-slot name="trigger">
                    <x-atoms.button variant="primary" type="button">{{ __('Simpan') }}</x-atoms.button>
                </x-slot>
                <x-slot name="title">Konfirmasi Update Password</x-slot>
                Anda yakin ingin mengubah password Anda? Anda akan perlu login kembali setelahnya.
                <x-slot name="confirmAction">
                    <x-atoms.button variant="primary" type="button" onclick="document.getElementById('password-update-form').submit();">
                        Ya, Simpan
                    </x-atoms.button>
                </x-slot>
            </x-molecules.confirmation-modal>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>