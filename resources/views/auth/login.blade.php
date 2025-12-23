<x-guest-layout>
    <!-- Header Section -->
    <!-- Header Section -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h2>
        <p class="mt-2 text-sm text-gray-600">
            Masuk ke akun Anda untuk melanjutkan
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@sanglah.go.id" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-green-600 hover:text-green-700 transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="space-y-4">
            <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white font-semibold rounded-lg hover:from-green-700 hover:to-teal-700 transition-all shadow-lg">
                Masuk
            </button>

            @if (Route::has('register'))
                <p class="text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-700 transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            @endif
        </div>
    </form>

    <!-- Demo Accounts -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex items-center justify-center mb-4">
            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-xs text-gray-500 font-medium">
                Akun Demo untuk Testing
            </p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4 space-y-3">
            <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="col-span-2 pb-2 border-b border-gray-200">
                    <span class="text-gray-500">Email</span>
                </div>
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="font-medium text-gray-700">Super Admin</span>
                </div>
                <div class="text-gray-600 text-right">admin@sanglah.go.id</div>
                
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                    <span class="font-medium text-gray-700">Validator</span>
                </div>
                <div class="text-gray-600 text-right">validator.igd@sanglah.go.id</div>
                
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                    <span class="font-medium text-gray-700">User</span>
                </div>
                <div class="text-gray-600 text-right">pegawai.igd@sanglah.go.id</div>
            </div>
            <div class="pt-3 border-t border-gray-200 text-center">
                <span class="text-gray-500 text-xs">Password: </span>
                <code class="text-green-600 font-mono font-semibold text-xs bg-green-50 px-3 py-1 rounded">password</code>
            </div>
        </div>
    </div>
</x-guest-layout>
