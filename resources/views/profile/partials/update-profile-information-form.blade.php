<section>
    <header>
        <x-atoms.heading level="3">
            {{ __('Informasi Profil') }}
        </x-atoms.heading>

        <x-atoms.paragraph class="mt-1">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </x-atoms.paragraph>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" id="profile-update-form">
        @csrf
        @method('patch')

        {{-- Nama Lengkap --}}
        <div>
            <x-atoms.input name="full_name" label="Nama Lengkap" :value="old('full_name', $user->full_name)" :required="true" :variant="$errors->has('full_name') ? 'error' : 'default'" autofocus />
            @if($errors->has('full_name'))
                <x-atoms.info-box variant="error" class="mt-2">{{ $errors->first('full_name') }}</x-atoms.info-box>
            @endif
        </div>

        {{-- Email --}}
        <div>
            <x-atoms.input name="email" type="email" label="Email" :value="old('email', $user->email)" :required="true" :variant="$errors->has('email') ? 'error' : 'default'" />
            @if($errors->has('email'))
                <x-atoms.info-box variant="error" class="mt-2">{{ $errors->first('email') }}</x-atoms.info-box>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        
        {{-- Nomor Telepon --}}
        <div>
            <x-atoms.input name="phone_number" label="Nomor Telepon" :value="old('phone_number', $user->phone_number)" :variant="$errors->has('phone_number') ? 'error' : 'default'" />
            @if($errors->has('phone_number'))
                <x-atoms.info-box variant="error" class="mt-2">{{ $errors->first('phone_number') }}</x-atoms.info-box>
            @endif
        </div>


        <div class="flex items-center gap-4">
            <x-molecules.confirmation-modal variant="primary" confirm-text="Ya, Simpan">
                <x-slot name="trigger">
                    <x-atoms.button variant="primary" type="button">{{ __('Simpan') }}</x-atoms.button>
                </x-slot>
                <x-slot name="title">Konfirmasi Perubahan Profil</x-slot>
                Anda yakin ingin menyimpan perubahan pada informasi profil Anda?
                <x-slot name="confirmAction">
                    <x-atoms.button variant="primary" type="button" onclick="document.getElementById('profile-update-form').submit();">
                        Ya, Simpan
                    </x-atoms.button>
                </x-slot>
            </x-molecules.confirmation-modal>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>