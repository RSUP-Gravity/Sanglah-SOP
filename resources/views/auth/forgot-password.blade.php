<x-guest-layout>
    <!-- Header Section -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Lupa Password?</h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link reset password.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
