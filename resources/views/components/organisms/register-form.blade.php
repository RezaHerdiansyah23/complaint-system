 <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Full Name --}}
        <x-molecules.form-input-group 
            label="Full Name" 
            name="full_name" 
            type="text" 
            :value="old('full_name')" 
            required 
        />

        
        {{-- Email Address --}}
        <x-molecules.form-input-group 
            label="Email" 
            name="email" 
            type="email" 
            :value="old('email')" 
            required 
        />

        {{-- Phone Number --}}
        <x-molecules.form-input-group 
            label="Phone Number" 
            name="phone_number" 
            type="text" 
            :value="old('phone_number')" 
        />

        {{-- Password --}}
        <x-atoms.input-password 
            label="Password"
            name="password"
            required
        />

        {{-- Confirm Password --}}
        <x-atoms.input-password 
            label="Confirm Password"
            name="password_confirmation"
            required
        />

        {{-- Submit Button & Link --}}
        <div class="flex flex-col items-center justify-center mt-6 space-y-3">
            <x-atoms.button>
                {{ __('Register') }}
            </x-atoms.button>

            <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
