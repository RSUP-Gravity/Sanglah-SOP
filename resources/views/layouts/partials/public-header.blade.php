<header class="nav-sticky bg-white shadow-sm fixed top-0 left-0 right-0 z-50 h-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex items-center justify-between h-full">
            <!-- Logo Section -->
            <a href="{{ route('public.index') }}" class="flex items-center space-x-4">
                <div class="relative">
                    <img src="/logo/logo_sanglah.jpg" alt="Logo Sanglah" class="h-14 w-auto rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 leading-tight">RSUP Sanglah</h1>
                    <p class="text-xs text-gray-600 font-medium">Portal SOP Digital</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('public.index') }}#beranda" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                    Beranda
                </a>
                <a href="{{ route('public.index') }}#about" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                    Tentang
                </a>
                <a href="{{ route('public.index') }}#features" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                    Fitur
                </a>
                <a href="{{ route('public.index') }}#statistics" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                    Statistik
                </a>
                <a href="{{ route('public.index') }}#search-section" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                    Cari SOP
                </a>
                <a href="{{ route('public.index') }}#faq" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                    FAQ
                </a>
                <a href="{{ route('guides.list') }}" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium {{ request()->routeIs('guides.*') ? 'bg-green-50 text-green-700 font-bold' : '' }}">
                    Panduan
                </a>
            </nav>

            <!-- CTA Buttons -->
            <div class="hidden lg:flex items-center space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-xl hover:from-green-700 hover:to-teal-700 transition-all shadow-lg hover:shadow-xl font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-5 py-2.5 text-green-600 hover:text-green-700 font-semibold transition-colors">
                        Daftar
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-xl hover:from-green-700 hover:to-teal-700 transition-all shadow-lg hover:shadow-xl font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 shadow-lg absolute top-20 left-0 right-0">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('public.index') }}#beranda" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Beranda</a>
            <a href="{{ route('public.index') }}#about" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Tentang</a>
            <a href="{{ route('public.index') }}#features" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Fitur</a>
            <a href="{{ route('public.index') }}#statistics" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Statistik</a>
            <a href="{{ route('public.index') }}#search-section" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Cari SOP</a>
            <a href="{{ route('public.index') }}#faq" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">FAQ</a>
            <a href="{{ route('guides.list') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium {{ request()->routeIs('guides.*') ? 'bg-green-50 text-green-700' : '' }}">Panduan</a>
            <div class="pt-4 border-t border-gray-200 space-y-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-lg text-center font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="block px-4 py-3 text-green-600 border-2 border-green-600 rounded-lg text-center font-semibold">Daftar</a>
                    <a href="{{ route('login') }}" class="block px-4 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-lg text-center font-semibold">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</header>
