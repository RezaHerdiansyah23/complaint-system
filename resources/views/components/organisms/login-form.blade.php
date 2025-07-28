<form method="POST" action="{{ route('login') }}">
    @csrf

    <x-atoms.heading level="2" class="text-center mb-6">
        SISTEM KELUHAN PELANGGAN
    </x-atoms.heading>

    <x-molecules.form-input-group 
        label="Email" 
        name="email" 
        type="email" 
        :value="old('email')" 
        required 
    />

    <x-atoms.input-password 
        label="Password"
        name="password"
        required
    />

    <x-molecules.checkbox-with-label 
        name="remember_me" 
        label="Remember Me" 
    />

    {{-- Tombol Login --}}
    <div class="flex justify-center mt-6">
        <x-atoms.button>
            {{ __('Log in') }}
        </x-atoms.button>
    </div>

    {{-- Link Tambahan --}}
    <div class="mt-4 text-center space-y-2">
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block text-sm text-gray-600 dark:text-gray-400 hover:underline">
                {{ __('Don\'t have an account? Register') }}
            </a>
        @endif

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="block text-sm text-gray-600 dark:text-gray-400 hover:underline">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </div>
</form>