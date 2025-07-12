<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New User
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-4">
                        <x-input-label value="Full Name" />
                        <x-text-input name="full_name" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label value="Email" />
                        <x-text-input name="email" type="email" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label value="Password" />
                        <x-text-input name="password" type="password" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <x-input-label value="Confirm Password" />
                        <x-text-input name="password_confirmation" type="password" class="mt-1 block w-full" required />
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <x-input-label value="Role" />
                        <select name="role" class="mt-1 block w-full rounded">
                            <option value="admin">Admin</option>
                            <option value="noc">NOC</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                    </div>

                    <x-primary-button>Create User</x-primary-button>
                </form>
            </div>

            <a href="{{ route('admin.users.index') }}" class="text-indigo-500 text-sm hover:underline">← Back to user list</a>
        </div>
    </div>
</x-app-layout>
