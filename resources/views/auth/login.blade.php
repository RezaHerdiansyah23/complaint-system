<x-templates.guest-template>
    <!-- Optional Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <x-organisms.login-form />
</x-templates.guest-template>