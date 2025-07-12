<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manage User
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-4 text-red-600">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Full Name -->
                    <div class="mb-4">
                        <x-input-label value="Full Name" />
                        <x-text-input name="full_name" type="text" value="{{ old('full_name', $user->full_name) }}" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label value="Email" />
                        <x-text-input name="email" type="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Role (editable hanya kalau bukan customer) -->
                    @if ($user->role !== 'customer')
                        <div class="mb-4">
                            <x-input-label value="Role" />
                            <select name="role" class="mt-1 block w-full rounded">
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="noc" {{ $user->role === 'noc' ? 'selected' : '' }}>NOC</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-1" />
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-300 mb-4">
                            <strong>Note:</strong> Role for customer cannot be edited.
                        </p>
                    @endif

                    <x-primary-button>Update User</x-primary-button>
                </form>

                <!-- Delete User -->
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="mt-6">
                    @csrf
                    @method('DELETE')

                    <x-danger-button
                        onclick="return confirm('Are you sure you want to delete this user?')">
                        Delete User
                    </x-danger-button>
                </form>
            </div>

            <a href="{{ route('admin.users.index') }}" class="text-indigo-500 text-sm hover:underline">← Back to user list</a>
        </div>
    </div>
</x-app-layout>
