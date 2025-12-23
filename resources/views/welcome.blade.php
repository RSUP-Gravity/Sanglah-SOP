<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIM SOP RS Sanglah') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- AOS - Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #16a34a 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .dark .navbar-scrolled {
            background-color: rgba(17, 24, 39, 0.95) !important;
        }
        
        .counter {
            font-variant-numeric: tabular-nums;
        }
        
        .feature-card {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        #backToTop {
            bottom: -60px;
            transition: bottom 0.3s ease;
        }
        
        #backToTop.show {
            bottom: 30px;
        }
    </style>
</head>
<body class="h-full bg-white transition-colors duration-200">
    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full bg-white/80 bg-gray-50/80 backdrop-blur-md z-50 border-b border-gray-200 dark:border-gray-800 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="#hero" class="flex items-center smooth-scroll">
                        <div class="flex-shrink-0">
                            <img src="/logo/logo_sanglah.jpg" alt="Logo Sanglah" class="h-10 w-10 rounded-lg object-cover">
                        </div>
                        <div class="ml-3">
                            <h1 class="text-lg font-semibold text-gray-900 text-gray-900">SIM SOP</h1>
                            <p class="text-xs text-gray-500 text-gray-400">RS Sanglah</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#hero" class="smooth-scroll text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">Beranda</a>
                    <a href="#about" class="smooth-scroll text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">Tentang</a>
                    <a href="#features" class="smooth-scroll text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">Fitur</a>
                    <a href="#statistics" class="smooth-scroll text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">Statistik</a>
                    <a href="#how-it-works" class="smooth-scroll text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">Cara Kerja</a>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button type="button" id="theme-toggle" class="p-2 text-gray-500 hover:text-gray-700 text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 text-gray-300 hover:text-green-600 dark:hover:text-blue-400 transition-colors">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all transform hover:scale-105">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="relative isolate pt-14 min-h-screen flex items-center">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-green-600 to-teal-400 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="w-full py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
                    <div class="mb-8 inline-flex items-center rounded-full px-4 py-1.5 text-sm font-medium bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-blue-300 ring-1 ring-inset ring-green-700/10 dark:ring-blue-300/10" data-aos="fade-down" data-aos-delay="100">
                        <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Sistem Manajemen SOP Digital Terpadu
                    </div>
                    
                    <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 text-gray-900 sm:text-7xl mb-6" data-aos="fade-up" data-aos-delay="200">
                        Kelola SOP Rumah Sakit <span class="gradient-text">Lebih Mudah</span>
                    </h1>
                    
                    <p class="mt-6 text-xl leading-8 text-gray-600 text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                        Platform manajemen Standar Operasional Prosedur yang modern, terintegrasi, dan efisien untuk RS Sanglah. Tingkatkan produktivitas dan compliance dengan workflow digital.
                    </p>
                    
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
                        @guest
                            <a href="{{ route('register') }}" class="w-full sm:w-auto rounded-lg bg-gradient-to-r from-green-600 to-teal-600 px-8 py-4 text-base font-semibold text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                <span class="flex items-center justify-center">
                                    Mulai Gratis
                                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </span>
                            </a>
                            <a href="#how-it-works" class="smooth-scroll w-full sm:w-auto rounded-lg border-2 border-gray-300 dark:border-gray-700 px-8 py-4 text-base font-semibold text-gray-900 text-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200">
                                Pelajari Lebih Lanjut
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto rounded-lg bg-gradient-to-r from-green-600 to-teal-600 px-8 py-4 text-base font-semibold text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                Ke Dashboard
                            </a>
                        @endguest
                    </div>

                    <!-- Trust Indicators -->
                    <div class="mt-16 flex flex-wrap justify-center gap-8 text-sm text-gray-600 text-gray-400" data-aos="fade-up" data-aos-delay="500">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium">Aman & Terpercaya</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium">24/7 Support</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium">Real-time Updates</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 sm:py-32 bg-gray-50 dark:bg-gray-800/50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-blue-300 mb-4">
                        Tentang Sistem
                    </div>
                    <h2 class="text-4xl font-bold tracking-tight text-gray-900 text-gray-900 sm:text-5xl mb-6">
                        Digitalisasi SOP untuk Rumah Sakit Modern
                    </h2>
                    <p class="text-lg text-gray-600 text-gray-300 mb-6">
                        SIM SOP RS Sanglah adalah platform manajemen digital yang dirancang khusus untuk mengelola Standar Operasional Prosedur di lingkungan rumah sakit dengan cara yang lebih efisien, terstruktur, dan paperless.
                    </p>
                    <p class="text-lg text-gray-600 text-gray-300 mb-8">
                        Dengan workflow approval yang jelas, versioning otomatis, dan sistem notifikasi real-time, kami membantu meningkatkan compliance dan produktivitas tim medis Anda.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-600 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 text-gray-900">Paperless & Eco-Friendly</h3>
                                <p class="text-gray-600 text-gray-400">Kurangi penggunaan kertas hingga 90% dengan sistem digital</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-600 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 text-gray-900">Cepat & Responsif</h3>
                                <p class="text-gray-600 text-gray-400">Akses SOP dari mana saja, kapan saja dengan loading time minimal</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left">
                    <div class="relative">
                        <div class="aspect-square rounded-2xl bg-gradient-to-br from-green-600 to-teal-600 p-8 shadow-2xl">
                            <div class="h-full w-full bg-white dark:bg-gray-800 rounded-xl p-8 flex flex-col justify-center items-center">
                                <svg class="h-32 w-32 text-green-600 dark:text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h3 class="text-2xl font-bold text-gray-900 text-gray-900 text-center">Semua SOP Dalam Satu Platform</h3>
                                <p class="mt-4 text-center text-gray-600 text-gray-400">Akses mudah, pencarian cepat, dan pengelolaan terpusat</p>
                            </div>
                        </div>
                        <!-- Decorative elements -->
                        <div class="absolute -top-4 -right-4 h-24 w-24 bg-yellow-400 rounded-full opacity-20 blur-2xl"></div>
                        <div class="absolute -bottom-4 -left-4 h-32 w-32 bg-purple-400 rounded-full opacity-20 blur-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistics" class="py-24 sm:py-32 bg-gradient-to-br from-green-600 to-teal-600 text-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold tracking-tight sm:text-5xl mb-4">Dipercaya oleh RS Sanglah</h2>
                <p class="text-xl text-green-100">Angka berbicara tentang efektivitas sistem kami</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-5xl font-bold mb-2 counter" data-target="150">0</div>
                    <div class="text-green-100 text-lg">SOP Aktif</div>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-5xl font-bold mb-2 counter" data-target="45">0</div>
                    <div class="text-green-100 text-lg">Unit Terdaftar</div>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                    <div class="text-5xl font-bold mb-2 counter" data-target="98">0</div>
                    <div class="text-green-100 text-lg">% Compliance Rate</div>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                    <div class="text-5xl font-bold mb-2 counter" data-target="1200">0</div>
                    <div class="text-green-100 text-lg">Pengguna Aktif</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <!-- Features Section -->
    <section id="features" class="py-24 sm:py-32 bg-white bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-blue-300 mb-4">
                    Fitur Unggulan
                </div>
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 text-gray-900 sm:text-5xl mb-4">
                    Semua yang Anda Butuhkan dalam Satu Platform
                </h2>
                <p class="text-lg text-gray-600 text-gray-300">
                    Fitur lengkap untuk mengelola SOP rumah sakit dengan efisien dan profesional
                </p>
            </div>

            <div class="grid max-w-xl mx-auto lg:max-w-none grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card relative p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-green-500 to-teal-500 text-white mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-gray-900 mb-3">Manajemen SOP Terpusat</h3>
                    <p class="text-gray-600 text-gray-400">
                        Kelola semua SOP dalam satu platform dengan sistem terorganisir dan mudah diakses kapan saja, di mana saja.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card relative p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 text-white mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-gray-900 mb-3">Workflow Validasi</h3>
                    <p class="text-gray-600 text-gray-400">
                        Proses validasi SOP yang terstruktur dengan approval bertingkat dari validator yang berwenang sesuai unit.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card relative p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 text-white mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-gray-900 mb-3">Versioning & History</h3>
                    <p class="text-gray-600 text-gray-400">
                        Lacak setiap perubahan SOP dengan sistem versioning otomatis dan history yang lengkap dan detail.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card relative p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-500 text-white mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-gray-900 mb-3">Notifikasi Real-time</h3>
                    <p class="text-gray-600 text-gray-400">
                        Dapatkan notifikasi langsung untuk setiap perubahan status dan aktivitas SOP melalui sistem dan email.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card relative p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="500">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-red-500 to-pink-500 text-white mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-gray-900 mb-3">Role-based Access</h3>
                    <p class="text-gray-600 text-gray-400">
                        Kontrol akses berdasarkan role: Super Admin, Validator, dan User dengan hak akses yang berbeda.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card relative p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-indigo-500 to-green-500 text-white mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-gray-900 mb-3">Audit Trail Lengkap</h3>
                    <p class="text-gray-600 text-gray-400">
                        Semua aktivitas tercatat dengan detail lengkap untuk keperluan audit, monitoring, dan compliance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 sm:py-32 bg-gray-50 dark:bg-gray-800/50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-blue-300 mb-4">
                    Cara Kerja
                </div>
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 text-gray-900 sm:text-5xl mb-4">
                    Mudah Digunakan dalam 4 Langkah
                </h2>
                <p class="text-lg text-gray-600 text-gray-300">
                    Proses yang sederhana dan intuitif dari pembuatan hingga approval SOP
                </p>
            </div>

            <div class="relative">
                <!-- Vertical Line (Desktop) -->
                <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-green-600 to-teal-600"></div>

                <div class="space-y-12">
                    <!-- Step 1 -->
                    <div class="relative" data-aos="fade-right">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                            <div class="lg:text-right">
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-green-600 text-white text-2xl font-bold mb-4 lg:mb-0">1</div>
                                <h3 class="text-2xl font-bold text-gray-900 text-gray-900 mb-2">Buat SOP Baru</h3>
                                <p class="text-gray-600 text-gray-400 text-lg">User membuat SOP baru dengan mengisi form dan upload dokumen PDF sesuai template yang tersedia.</p>
                            </div>
                            <div class="hidden lg:block"></div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative" data-aos="fade-left">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                            <div class="hidden lg:block"></div>
                            <div>
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-green-600 text-white text-2xl font-bold mb-4 lg:mb-0">2</div>
                                <h3 class="text-2xl font-bold text-gray-900 text-gray-900 mb-2">Submit untuk Review</h3>
                                <p class="text-gray-600 text-gray-400 text-lg">SOP yang sudah dibuat akan masuk ke workflow validation dan diteruskan ke Validator unit terkait.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative" data-aos="fade-right">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                            <div class="lg:text-right">
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-purple-600 text-white text-2xl font-bold mb-4 lg:mb-0">3</div>
                                <h3 class="text-2xl font-bold text-gray-900 text-gray-900 mb-2">Proses Validasi</h3>
                                <p class="text-gray-600 text-gray-400 text-lg">Validator mereview SOP dan memberikan approval atau reject dengan catatan revisi yang jelas.</p>
                            </div>
                            <div class="hidden lg:block"></div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative" data-aos="fade-left">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                            <div class="hidden lg:block"></div>
                            <div>
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-teal-600 text-white text-2xl font-bold mb-4 lg:mb-0">4</div>
                                <h3 class="text-2xl font-bold text-gray-900 text-gray-900 mb-2">SOP Aktif & Publikasi</h3>
                                <p class="text-gray-600 text-gray-400 text-lg">Setelah disetujui, SOP akan aktif dan dapat diakses oleh seluruh user yang memiliki hak akses.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 sm:py-32 bg-gradient-to-br from-green-600 to-teal-600">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center" data-aos="zoom-in">
                <h2 class="text-4xl font-bold tracking-tight text-white sm:text-5xl mb-6">
                    Siap Meningkatkan Efisiensi SOP Anda?
                </h2>
                <p class="text-xl text-green-100 mb-10">
                    Bergabunglah dengan RS Sanglah dalam transformasi digital manajemen SOP
                </p>
                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-green-600 bg-white rounded-lg hover:bg-gray-50 transform hover:scale-105 transition-all duration-200 shadow-xl">
                            Mulai Sekarang - Gratis
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-lg hover:bg-white hover:text-green-600 transition-all duration-200">
                            Sudah Punya Akun? Login
                        </a>
                    </div>
                @else
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-green-600 bg-white rounded-lg hover:bg-gray-50 transform hover:scale-105 transition-all duration-200 shadow-xl">
                        Ke Dashboard
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <svg class="h-10 w-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-xl font-bold text-white">SIM SOP RS Sanglah</h3>
                            <p class="text-sm text-gray-400">Sistem Informasi Manajemen SOP</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Platform digital terpadu untuk pengelolaan Standar Operasional Prosedur di Rumah Sakit Umum Pusat Sanglah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#hero" class="smooth-scroll hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#about" class="smooth-scroll hover:text-white transition-colors">Tentang</a></li>
                        <li><a href="#features" class="smooth-scroll hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#how-it-works" class="smooth-scroll hover:text-white transition-colors">Cara Kerja</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm">Jl. Diponegoro, Denpasar, Bali</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">info@sanglah.go.id</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-sm">(0361) 227911-15</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400 mb-4 md:mb-0">
                        &copy; {{ date('Y') }} Rumah Sakit Umum Pusat Sanglah. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed right-8 z-40 p-3 bg-green-600 hover:bg-green-700 text-white rounded-full shadow-lg transition-all duration-300">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });

            // Smooth Scroll for navigation links
            $('.smooth-scroll').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');
                
                if ($(target).length) {
                    $('html, body').animate({
                        scrollTop: $(target).offset().top - 80
                    }, 800, 'swing');
                }
            });

            // Navbar scroll effect
            let lastScroll = 0;
            $(window).on('scroll', function() {
                const currentScroll = $(this).scrollTop();
                
                if (currentScroll > 100) {
                    $('#navbar').addClass('navbar-scrolled');
                } else {
                    $('#navbar').removeClass('navbar-scrolled');
                }

                // Back to top button
                if (currentScroll > 300) {
                    $('#backToTop').addClass('show');
                } else {
                    $('#backToTop').removeClass('show');
                }

                lastScroll = currentScroll;
            });

            // Back to top button click
            $('#backToTop').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 800, 'swing');
            });

            // Counter animation
            let counterAnimated = false;
            
            $(window).on('scroll', function() {
                const statisticsSection = $('#statistics');
                
                if (statisticsSection.length && !counterAnimated) {
                    const sectionTop = statisticsSection.offset().top;
                    const sectionBottom = sectionTop + statisticsSection.outerHeight();
                    const scrollTop = $(window).scrollTop();
                    const windowHeight = $(window).height();
                    
                    if (scrollTop + windowHeight > sectionTop + 100) {
                        counterAnimated = true;
                        
                        $('.counter').each(function() {
                            const $this = $(this);
                            const countTo = $this.attr('data-target');
                            
                            $({ countNum: 0 }).animate({
                                countNum: countTo
                            }, {
                                duration: 2000,
                                easing: 'swing',
                                step: function() {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function() {
                                    $this.text(this.countNum);
                                }
                            });
                        });
                    }
                }
            });

            // Feature cards hover effect
            $('.feature-card').hover(
                function() {
                    $(this).addClass('shadow-2xl');
                },
                function() {
                    $(this).removeClass('shadow-2xl');
                }
            );

            // Dark Mode Toggle
            const themeToggleBtn = $('#theme-toggle');
            const themeToggleDarkIcon = $('#theme-toggle-dark-icon');
            const themeToggleLightIcon = $('#theme-toggle-light-icon');

            // Check for saved theme preference or default to system preference
            if (localStorage.getItem('color-theme') === 'dark' || 
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.removeClass('hidden');
                $('html').addClass('dark');
            } else {
                themeToggleDarkIcon.removeClass('hidden');
            }

            themeToggleBtn.on('click', function() {
                // Toggle icons
                themeToggleDarkIcon.toggleClass('hidden');
                themeToggleLightIcon.toggleClass('hidden');

                // Toggle dark mode
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        $('html').addClass('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        $('html').removeClass('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if ($('html').hasClass('dark')) {
                        $('html').removeClass('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        $('html').addClass('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });

            // Parallax effect for hero section
            $(window).on('scroll', function() {
                const scrolled = $(window).scrollTop();
                $('#hero').css('transform', 'translateY(' + (scrolled * 0.5) + 'px)');
            });
        });
    </script>
</body>
</html>

