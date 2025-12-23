<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP RS Sanglah - Portal Publik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
        .gradient-animated {
            background: linear-gradient(270deg, #059669, #0d9488, #10b981);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hover-scale { transition: all 0.3s ease; }
        .hover-scale:hover { transform: scale(1.05); }
        .counter { font-size: 2.5rem; font-weight: bold; }
        .feature-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .feature-card:hover { transform: translateY(-10px) scale(1.02); }
        .nav-sticky { transition: all 0.3s ease; }
        .scrolled { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-gray-50 overflow-x-hidden">
    <!-- Header with Mega Menu -->
    <header class="nav-sticky bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo Section -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <img src="/logo/logo_sanglah.jpg" alt="Logo Sanglah" class="h-14 w-auto rounded-xl shadow-md hover:shadow-lg transition-shadow">
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 leading-tight">RSUP Sanglah</h1>
                        <p class="text-xs text-gray-600 font-medium">Portal SOP Digital</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="#beranda" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                        Beranda
                    </a>
                    <a href="#about" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                        Tentang
                    </a>
                    <a href="#features" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                        Fitur
                    </a>
                    <a href="#statistics" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                        Statistik
                    </a>
                    <a href="#search-section" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                        Cari SOP
                    </a>
                    <a href="#faq" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
                        FAQ
                    </a>
                    <a href="{{ route('guides.list') }}" class="nav-link px-4 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all font-medium">
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
                <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="px-4 py-4 space-y-2">
                <a href="#beranda" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Beranda</a>
                <a href="#about" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Tentang</a>
                <a href="#features" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Fitur</a>
                <a href="#statistics" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Statistik</a>
                <a href="#search-section" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Cari SOP</a>
                <a href="#faq" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">FAQ</a>
                <a href="{{ route('guides.list') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-all font-medium">Panduan</a>
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

    <!-- Spacer for Fixed Header -->
    <div class="h-20"></div>

    <!-- Hero Section - Modern & Clean -->
    <section id="beranda" class="relative min-h-screen gradient-animated text-white overflow-hidden flex items-center">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 right-10 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-teal-400/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-green-400/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 relative z-10 w-full">
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <!-- Content -->
                <div class="space-y-8" data-aos="fade-up" data-aos-duration="800">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 glass-effect text-white rounded-full text-sm font-semibold mx-auto">
                        <div class="w-2 h-2 bg-green-300 rounded-full mr-2 animate-pulse"></div>
                        RSUP Sanglah Denpasar
                    </div>
                    
                    <!-- Main Title -->
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight tracking-tight">
                        <span class="block mb-2">Standar</span>
                        <span class="block text-green-200 mb-2">Operasional</span>
                        <span class="block">Prosedur</span>
                    </h1>

                    <!-- Subtitle -->
                    <div class="space-y-4 max-w-2xl mx-auto">
                        <p class="text-xl sm:text-2xl text-green-100 font-medium">
                            Sistem Informasi Manajemen SOP Digital
                        </p>
                        <p class="text-base sm:text-lg text-green-50/90 leading-relaxed">
                            Akses mudah, cepat, dan aman ke dokumen SOP tervalidasi untuk meningkatkan kualitas pelayanan kesehatan yang prima dan profesional.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4">
                        <a href="#search-section" class="group inline-flex items-center justify-center px-8 py-4 bg-white text-green-600 rounded-xl hover:bg-green-50 transition-all font-bold shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span class="text-base">Cari SOP Sekarang</span>
                        </a>
                        <a href="#about" class="group inline-flex items-center justify-center px-8 py-4 glass-effect text-white rounded-xl hover:bg-white/20 transition-all font-bold border-2 border-white/30">
                            <span class="text-base">Pelajari Lebih Lanjut</span>
                            <svg class="ml-2 w-4 h-4 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4 max-w-lg mx-auto pt-8 border-t border-white/10 mt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-1">{{ App\Models\Sop::where('status', 'approved')->count() }}</div>
                            <div class="text-xs text-green-200 uppercase tracking-wider">SOP Aktif</div>
                        </div>
                        <div class="text-center border-l border-r border-white/10">
                            <div class="text-3xl font-bold mb-1">{{ App\Models\Unit::count() }}</div>
                            <div class="text-xs text-green-200 uppercase tracking-wider">Unit Kerja</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-1">24/7</div>
                            <div class="text-xs text-green-200 uppercase tracking-wider">Online</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce hidden md:block">
            <a href="#about" class="flex flex-col items-center text-white/70 hover:text-white transition-colors">
                <span class="text-xs mb-1">Scroll</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="space-y-6">
                    <div>
                        <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            Tentang SIM SOP
                        </span>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-bold text-gray-900">Sistem Manajemen SOP Digital Terintegrasi</h3>
                    <div class="space-y-4 text-gray-600">
                        <p class="text-base sm:text-lg leading-relaxed">
                            Sistem Informasi Manajemen Standar Operasional Prosedur (SIM SOP) adalah platform digital yang dirancang khusus untuk memudahkan pengelolaan, akses, dan distribusi dokumen SOP di lingkungan RSUP Sanglah.
                        </p>
                        <p class="text-base leading-relaxed">
                            Dengan sistem ini, setiap pegawai dapat dengan mudah mengakses SOP yang relevan dengan tugas dan tanggung jawabnya, memastikan standar pelayanan yang konsisten dan berkualitas tinggi.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-start space-x-4 p-4 bg-gradient-to-br from-green-50 to-teal-50 rounded-xl hover:shadow-lg transition-all">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-green-500 to-teal-500 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Akses Mudah</h4>
                                <p class="text-gray-600 text-sm">Tersedia 24/7 dari mana saja dengan koneksi internet</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-gradient-to-br from-teal-50 to-green-50 rounded-xl hover:shadow-lg transition-all">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-teal-500 to-green-500 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Terverifikasi</h4>
                                <p class="text-gray-600 text-sm">Setiap SOP divalidasi oleh validator ahli di bidangnya</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-gradient-to-br from-green-50 to-teal-50 rounded-xl hover:shadow-lg transition-all">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-green-500 to-teal-500 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Update Real-time</h4>
                                <p class="text-gray-600 text-sm">Dapatkan informasi terkini setiap saat tanpa delay</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-gradient-to-br from-teal-50 to-green-50 rounded-xl hover:shadow-lg transition-all">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-teal-500 to-green-500 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Riwayat Lengkap</h4>
                                <p class="text-gray-600 text-sm">Tracking dan audit trail yang komprehensif</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-gradient-to-br from-green-500 to-teal-500 rounded-3xl p-8 shadow-2xl">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-2xl p-6 mb-6 hover:shadow-xl transition-shadow">
                            <div class="flex items-center mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-lg">Dokumen SOP</h4>
                                    <p class="text-sm text-gray-600">Format PDF Terstruktur</p>
                                </div>
                            </div>
                            <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-teal-500 rounded-full animate-pulse" style="width: 95%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">95% Dokumen Terdigitalisasi</p>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="bg-white rounded-2xl p-6 mb-6 hover:shadow-xl transition-shadow">
                            <div class="flex items-center mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-lg">Multi-role System</h4>
                                    <p class="text-sm text-gray-600">Admin, Validator & User</p>
                                </div>
                            </div>
                            <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-teal-500 to-green-500 rounded-full animate-pulse" style="width: 88%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">88% Pengguna Aktif</p>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="bg-white rounded-2xl p-6 hover:shadow-xl transition-shadow">
                            <div class="flex items-center mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-lg">Statistik Lengkap</h4>
                                    <p class="text-sm text-gray-600">Dashboard Analytics</p>
                                </div>
                            </div>
                            <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-teal-500 rounded-full animate-pulse" style="width: 92%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">92% Data Terintegrasi</p>
                        </div>
                    </div>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Reporting</h4>
                                    <p class="text-sm text-gray-600">Dashboard & Analytics</p>
                                </div>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-teal-500 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section - Enhanced -->
    <section id="statistics" class="py-20 bg-gradient-to-br from-green-600 via-teal-600 to-green-700 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-white/20 text-white rounded-full text-sm font-semibold mb-4">
                    Statistik Real-time
                </span>
                <h3 class="text-4xl md:text-5xl font-bold mb-4">Data & Pertumbuhan</h3>
                <p class="text-green-100 text-lg max-w-2xl mx-auto">
                    Sistem yang terus berkembang untuk melayani kebutuhan SOP di RSUP Sanglah
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="glass-effect rounded-2xl p-8 text-center hover-scale" data-aos="zoom-in" data-aos-delay="100">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="counter text-5xl font-extrabold mb-2" data-target="{{ \App\Models\Sop::where('status', 'approved')->count() }}">0</div>
                    <p class="text-green-100 font-medium text-lg">SOP Aktif</p>
                    <p class="text-green-200/70 text-sm mt-2">Dokumen tervalidasi</p>
                </div>

                <!-- Stat Card 2 -->
                <div class="glass-effect rounded-2xl p-8 text-center hover-scale" data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="counter text-5xl font-extrabold mb-2" data-target="{{ \App\Models\Direktorat::where('is_active', true)->count() }}">0</div>
                    <p class="text-green-100 font-medium text-lg">Direktorat</p>
                    <p class="text-green-200/70 text-sm mt-2">Struktur organisasi</p>
                </div>

                <!-- Stat Card 3 -->
                <div class="glass-effect rounded-2xl p-8 text-center hover-scale" data-aos="zoom-in" data-aos-delay="300">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                    </div>
                    <div class="counter text-5xl font-extrabold mb-2" data-target="{{ \App\Models\Unit::where('is_active', true)->count() }}">0</div>
                    <p class="text-green-100 font-medium text-lg">Unit Kerja</p>
                    <p class="text-green-200/70 text-sm mt-2">Departemen aktif</p>
                </div>

                <!-- Stat Card 4 -->
                <div class="glass-effect rounded-2xl p-8 text-center hover-scale" data-aos="zoom-in" data-aos-delay="400">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="counter text-5xl font-extrabold mb-2" data-target="{{ \App\Models\User::where('is_active', true)->count() }}">0</div>
                    <p class="text-green-100 font-medium text-lg">Pengguna</p>
                    <p class="text-green-200/70 text-sm mt-2">User terdaftar</p>
                </div>
            </div>

            <!-- Additional Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="glass-effect rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-4xl font-bold mb-2">98%</div>
                    <p class="text-green-100">Tingkat Kepuasan</p>
                </div>
                <div class="glass-effect rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <p class="text-green-100">Availability</p>
                </div>
                <div class="glass-effect rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="700">
                    <div class="text-4xl font-bold mb-2">< 2s</div>
                    <p class="text-green-100">Response Time</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-16 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16 space-y-4">
                <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    Fitur Unggulan
                </span>
                <h3 class="text-3xl sm:text-4xl font-bold text-gray-900">Mengapa Memilih SIM SOP?</h3>
                <p class="text-gray-600 max-w-2xl mx-auto text-base sm:text-lg">Sistem manajemen SOP yang mudah, cepat, dan terpercaya</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all border border-gray-100">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl mb-6 shadow-lg mx-auto">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3 text-center">Pencarian Cepat</h4>
                    <p class="text-gray-600 leading-relaxed text-center">Temukan SOP dalam hitungan detik dengan pencarian canggih berdasarkan direktorat, unit, atau kata kunci</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all border border-gray-100">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl mb-6 shadow-lg mx-auto">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Validasi Terpercaya</h4>
                    <p class="text-gray-600 leading-relaxed">Semua SOP telah melalui proses review dan validasi ketat oleh tim ahli untuk memastikan kualitas dan akurasi informasi</p>
                </div>
                <div class="feature-card bg-white p-8 rounded-xl shadow-md">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Update Berkala</h4>
                    <p class="text-gray-600 leading-relaxed">SOP selalu diperbarui mengikuti perkembangan standar pelayanan dan regulasi terkini untuk menjaga relevansi</p>
                </div>
                <div class="feature-card bg-white p-8 rounded-xl shadow-md">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Akses Aman</h4>
                    <p class="text-gray-600 leading-relaxed">Sistem keamanan berlapis dengan autentikasi user dan role-based access control untuk melindungi data sensitif</p>
                </div>
                <div class="feature-card bg-white p-8 rounded-xl shadow-md">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Tracking Lengkap</h4>
                    <p class="text-gray-600 leading-relaxed">Riwayat aktivitas dan audit trail yang komprehensif untuk monitoring dan evaluasi penggunaan SOP</p>
                </div>
                <div class="feature-card bg-white p-8 rounded-xl shadow-md">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Responsive Design</h4>
                    <p class="text-gray-600 leading-relaxed">Tampilan optimal di berbagai perangkat - desktop, tablet, dan smartphone untuk akses kapan saja, di mana saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-teal-100 text-teal-700 rounded-full text-sm font-semibold mb-4">
                    Cara Kerja
                </span>
                <h3 class="text-4xl font-bold text-gray-900 mb-4">Mudah Digunakan Dalam 3 Langkah</h3>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Proses yang simpel untuk mendapatkan akses ke SOP yang Anda butuhkan</p>
            </div>
            
            <div class="relative">
                <!-- Connection Line -->
                <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-green-200 via-teal-200 to-green-200 transform -translate-y-1/2" style="z-index: 0;"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12 relative" style="z-index: 1;">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl text-3xl font-bold mb-6 shadow-2xl relative">
                            <span>1</span>
                            <div class="absolute inset-0 bg-white rounded-2xl animate-ping opacity-20"></div>
                        </div>
                        <div class="bg-white p-8 rounded-2xl shadow-lg border-2 border-green-100 hover:border-green-300 transition-all hover:shadow-2xl">
                            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-xl mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Cari SOP</h4>
                            <p class="text-gray-600 leading-relaxed">Gunakan fitur pencarian dengan filter direktorat dan unit kerja untuk menemukan SOP yang relevan</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-full text-2xl font-bold mb-6 shadow-xl relative">
                            <span>2</span>
                            <div class="absolute inset-0 bg-white rounded-full animate-ping opacity-25" style="animation-delay: 0.5s;"></div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg border-2 border-teal-100 hover:border-teal-300 transition-colors">
                            <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Lihat Detail</h4>
                            <p class="text-gray-600">Baca informasi lengkap SOP termasuk nomor SK, tanggal efektif, dan deskripsi prosedur</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-full text-2xl font-bold mb-6 shadow-xl relative">
                            <span>3</span>
                            <div class="absolute inset-0 bg-white rounded-full animate-ping opacity-25" style="animation-delay: 1s;"></div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg border-2 border-green-100 hover:border-green-300 transition-colors">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Unduh & Terapkan</h4>
                            <p class="text-gray-600">Download dokumen SOP dalam format PDF dan terapkan sesuai prosedur yang tercantum</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <div class="inline-flex flex-col sm:flex-row gap-4 items-center bg-gradient-to-r from-green-50 to-teal-50 p-8 rounded-2xl border-2 border-green-200">
                    <div class="flex-1 text-left">
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Siap untuk Memulai?</h4>
                        <p class="text-gray-600">Akses seluruh koleksi SOP kami sekarang juga</p>
                    </div>
                    <a href="#search-section" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-lg hover:from-green-700 hover:to-teal-700 transition-all font-semibold shadow-lg whitespace-nowrap">
                        Mulai Cari SOP
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section id="search-section" class="py-12 md:py-16 bg-gradient-to-b from-gray-50 to-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 md:mb-10 space-y-3">
                <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    Pencarian SOP
                </span>
                <h3 class="text-3xl sm:text-4xl font-bold text-gray-900">Temukan SOP yang Anda Butuhkan</h3>
                <p class="text-gray-600 max-w-2xl mx-auto text-base sm:text-lg">Gunakan filter untuk mempermudah pencarian</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100">
                <form method="GET" action="{{ route('public.index') }}" class="space-y-6">
                    <!-- Search Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Kata Kunci</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Cari berdasarkan judul, nomor SK, atau deskripsi SOP..." 
                                class="w-full pl-12 pr-4 py-3.5 md:py-4 text-base md:text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                        </div>
                    </div>

                    <!-- Filters -->
                    <!-- Filters -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Filter Pencarian</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Direktorat Filter -->
                            <div>
                                <label for="direktorat_id" class="block text-xs font-medium text-gray-600 mb-2">Direktorat</label>
                                <select name="direktorat_id" id="direktorat_id" 
                                    class="w-full px-3 md:px-4 py-2.5 md:py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-sm md:text-base">
                                    <option value="">Semua Direktorat</option>
                                    @foreach($direktorats as $direktorat)
                                        <option value="{{ $direktorat->id }}" {{ request('direktorat_id') == $direktorat->id ? 'selected' : '' }}>
                                            {{ $direktorat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Unit Filter (Dynamic) -->
                            <div>
                                <label for="unit_id" class="block text-xs font-medium text-gray-600 mb-2">Unit Kerja</label>
                                <select name="unit_id" id="unit_id" 
                                    class="w-full px-3 md:px-4 py-2.5 md:py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-sm md:text-base">
                                    <option value="">Semua Unit</option>
                                    @if(request('direktorat_id') && count($selectedUnits) > 0)
                                        @foreach($selectedUnits as $unit)
                                            <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-end">
                                <button type="submit" class="w-full px-6 py-2.5 md:py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-teal-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                        Cari SOP
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    @if(request()->hasAny(['search', 'direktorat_id', 'unit_id']))
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Filter aktif:</span>
                                @if(request('search'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 ml-2">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                        </svg>
                                        "{{ request('search') }}"
                                    </span>
                                @endif
                                @if(request('direktorat_id'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700 ml-2">
                                        Direktorat
                                    </span>
                                @endif
                                @if(request('unit_id'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 ml-2">
                                        Unit
                                    </span>
                                @endif
                            </p>
                            <a href="{{ route('public.index') }}" class="text-sm text-red-600 hover:text-red-700 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>

    <!-- SOPs Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 pt-8 border-b border-gray-200">
        @if($sops->count() > 0)
            <div class="mb-6 flex items-center justify-between">
                <div>
                     <h3 class="text-2xl font-bold text-gray-900 border-l-4 border-green-500 pl-3">Hasil Pencarian</h3>
                     <p class="text-sm text-gray-500 pl-4 mt-1">Menampilkan <span class="font-bold text-gray-900">{{ $sops->count() }}</span> dari <span class="font-bold text-gray-900">{{ $sops->total() }}</span> dokumen</p>
                </div>
                <!-- Pagination Info Label for Desktop -->
                 <div class="hidden md:block text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
                    Halaman {{ $sops->currentPage() }}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($sops as $sop)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-200 group cursor-pointer relative flex flex-col h-full" onclick="window.location='{{ route('public.sop', $sop->id) }}'">
                        
                        <!-- Card Top Border -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-green-500 to-teal-500"></div>

                        <!-- Content -->
                        <div class="p-5 flex flex-col flex-grow">
                             <!-- Header -->
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center flex-shrink-0 border border-gray-100 shadow-sm overflow-hidden p-1">
                                    <img src="/logo/logo_sanglah.jpg" alt="Logo" class="w-full h-full object-contain">
                                </div>
                                <span class="px-2.5 py-1 text-[10px] font-bold tracking-wide rounded text-green-700 bg-green-50 border border-green-100 uppercase">
                                    Active
                                </span>
                            </div>

                            <!-- Title -->
                            <h4 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-green-600 transition-colors leading-snug" title="{{ $sop->title }}">
                                {{ $sop->title }}
                            </h4>

                            <!-- Meta -->
                            <div class="mt-auto space-y-3 pt-4 border-t border-dashed border-gray-100">
                                <div class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span class="truncate font-medium bg-gray-50 px-1.5 py-0.5 rounded">{{ $sop->sk_number }}</span>
                                </div>
                                <div class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    <span class="truncate">{{ $sop->unit->name ?? 'Unit Umum' }}</span>
                                </div>
                            </div>
                        </div>

                         <!-- Hover Effect Overlay -->
                        <div class="absolute inset-x-0 bottom-0 h-1 bg-green-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $sops->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-2xl">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada SOP ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda untuk menemukan SOP yang sesuai</p>
                    <a href="{{ route('public.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white font-semibold rounded-lg hover:from-green-700 hover:to-teal-700 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset Pencarian
                    </a>
                </div>
            </div>
        @endif
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 md:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16 space-y-3" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    Frequently Asked Questions
                </span>
                <h3 class="text-3xl sm:text-4xl font-bold text-gray-900">Pertanyaan yang Sering Diajukan</h3>
                <p class="text-gray-600 text-base sm:text-lg">Temukan jawaban untuk pertanyaan umum tentang SIM SOP</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="100">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Apa itu SIM SOP?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">SIM SOP (Sistem Informasi Manajemen Standar Operasional Prosedur) adalah platform digital yang dirancang khusus untuk mengelola, mengakses, dan mendistribusikan dokumen SOP di RSUP Sanglah. Sistem ini memudahkan pegawai untuk menemukan dan menggunakan SOP yang relevan dengan tugas mereka.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="200">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Bagaimana cara mengakses SOP?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">Anda dapat mengakses SOP dengan dua cara: (1) Tanpa login untuk melihat SOP yang sudah disetujui melalui halaman publik ini, atau (2) Login dengan akun yang terdaftar untuk mengakses fitur lengkap termasuk membuat, mengedit, dan memvalidasi SOP. Gunakan fitur pencarian dan filter untuk menemukan SOP yang Anda butuhkan.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="300">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Siapa yang bisa membuat SOP baru?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">Pegawai yang terdaftar di sistem dengan role yang sesuai dapat membuat SOP baru. Setiap SOP yang dibuat akan melalui proses validasi oleh validator ahli sebelum disetujui dan dipublikasikan. Sistem mendukung tiga role: Admin (pengelola sistem), Validator (pengesah SOP), dan User (pembuat SOP).</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="400">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Bagaimana proses validasi SOP?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">Setelah SOP dibuat, dokumen akan masuk ke status "pending validation". Validator yang ditunjuk akan meninjau SOP tersebut dan dapat menyetujui (approve) atau menolak (reject) dengan memberikan komentar. SOP yang disetujui akan otomatis dipublikasikan dan dapat diakses oleh semua pegawai.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="500">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Apakah SOP dapat diunduh?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">Ya, semua SOP yang telah disetujui dapat diunduh dalam format PDF. Setiap unduhan akan dicatat dalam activity log untuk keperluan audit. File SOP disimpan dengan sistem keamanan berlapis untuk memastikan integritas dan keamanan dokumen.</p>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="600">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Bagaimana cara mendapatkan akses login?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">Untuk mendapatkan akses login, pegawai dapat menghubungi administrator sistem atau bagian IT RSUP Sanglah. Admin akan membuat akun dengan role yang sesuai dengan tanggung jawab Anda. Setelah akun dibuat, Anda akan menerima email dengan detail login.</p>
                    </div>
                </div>

                <!-- FAQ Item 7 -->
                <div class="faq-item bg-gray-50 rounded-xl hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="700">
                    <button class="faq-question w-full text-left px-6 py-5 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 pr-4">Apakah sistem ini tersedia 24/7?</span>
                        <svg class="w-6 h-6 text-green-600 transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">Ya, SIM SOP dapat diakses 24 jam sehari, 7 hari seminggu. Sistem ini di-hosting dengan infrastruktur yang handal untuk memastikan ketersediaan tinggi (high availability). Anda dapat mengakses SOP kapan saja dari perangkat apa saja yang terhubung dengan internet.</p>
                    </div>
                </div>
            </div>

            <!-- CTA Box -->
            <div class="mt-12 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl p-8 text-center text-white" data-aos="zoom-in">
                <h4 class="text-2xl font-bold mb-3">Masih Punya Pertanyaan?</h4>
                <p class="text-green-100 mb-6">Tim support kami siap membantu Anda</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:support@sanglah.go.id" class="inline-flex items-center justify-center px-6 py-3 bg-white text-green-600 rounded-xl hover:bg-green-50 transition-all font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email Kami
                    </a>
                    <a href="tel:+62361227911" class="inline-flex items-center justify-center px-6 py-3 bg-green-700/50 text-white rounded-xl hover:bg-green-700 transition-all font-semibold border-2 border-white/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-16 relative overflow-hidden">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 mb-12">
                <!-- Brand Column - Larger -->
                <div class="lg:col-span-4" data-aos="fade-up">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="relative">
                            <img src="/logo/logo_sanglah.jpg" alt="Logo Sanglah" class="h-14 w-14 rounded-lg object-cover">
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">RSUP Sanglah</h3>
                            <p class="text-green-400 font-semibold text-sm">Sistem Informasi Manajemen SOP</p>
                        </div>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6">Portal terintegrasi untuk manajemen Standar Operasional Prosedur yang meningkatkan efisiensi, standardisasi, dan kualitas layanan kesehatan di RSUP Sanglah Denpasar.</p>
                    
                    <!-- Newsletter -->
                    <div class="glass-effect rounded-xl p-4 border border-gray-700">
                        <h5 class="text-sm font-semibold mb-2 text-green-400">📧 Newsletter</h5>
                        <p class="text-xs text-gray-400 mb-3">Dapatkan update SOP terbaru</p>
                        <form class="flex gap-2">
                            <input type="email" placeholder="Email Anda" class="flex-1 px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-sm focus:outline-none focus:border-green-500 transition">
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-lg text-sm font-medium hover:from-green-700 hover:to-teal-700 transition transform hover:scale-105">
                                Langganan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="lg:col-span-2" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-lg font-bold mb-6 text-white flex items-center">
                        <span class="w-1 h-6 bg-gradient-to-b from-green-500 to-teal-500 rounded mr-3"></span>
                        Tautan Cepat
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="#beranda" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Beranda
                        </a></li>
                        <li><a href="#tentang" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Tentang Kami
                        </a></li>
                        <li><a href="#fitur" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Fitur
                        </a></li>
                        <li><a href="#statistik" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Statistik
                        </a></li>
                        <li><a href="#faq" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            FAQ
                        </a></li>
                    </ul>
                </div>

                <!-- User Links -->
                <div class="lg:col-span-2" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-lg font-bold mb-6 text-white flex items-center">
                        <span class="w-1 h-6 bg-gradient-to-b from-green-500 to-teal-500 rounded mr-3"></span>
                        Akses
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="#cari-sop" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Cari SOP
                        </a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                                <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Dashboard
                            </a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                                <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Login
                            </a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                                <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Daftar
                            </a></li>
                        @endauth
                        <li><a href="https://sanglah.go.id" target="_blank" class="text-gray-300 hover:text-green-400 transition flex items-center group">
                            <svg class="w-4 h-4 mr-2 opacity-50 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Website Resmi
                        </a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="text-lg font-bold mb-6 text-white flex items-center">
                        <span class="w-1 h-6 bg-gradient-to-b from-green-500 to-teal-500 rounded mr-3"></span>
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Alamat</p>
                                <p class="text-gray-300 text-sm leading-relaxed">Jl. Diponegoro, Dauh Puri Klod, Denpasar Barat, Denpasar, Bali 80113</p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Email Support</p>
                                <a href="mailto:support@sanglah.go.id" class="text-green-400 text-sm hover:text-green-300 transition">support@sanglah.go.id</a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Telepon</p>
                                <a href="tel:+62361227911" class="text-green-400 text-sm hover:text-green-300 transition">+62 361 227 911</a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Jam Layanan</p>
                                <p class="text-gray-300 text-sm">24/7 (Sistem Online)</p>
                            </div>
                        </li>
                    </ul>

                    <!-- Social Media -->
                    <div class="mt-6">
                        <p class="text-sm text-gray-400 mb-3">Ikuti Kami</p>
                        <div class="flex space-x-3">
                            <a href="#" class="w-11 h-11 bg-gray-800 hover:bg-gradient-to-br hover:from-green-600 hover:to-teal-600 rounded-xl flex items-center justify-center transition-all transform hover:scale-110 hover:rotate-6 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-11 h-11 bg-gray-800 hover:bg-gradient-to-br hover:from-green-600 hover:to-teal-600 rounded-xl flex items-center justify-center transition-all transform hover:scale-110 hover:rotate-6 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-11 h-11 bg-gray-800 hover:bg-gradient-to-br hover:from-green-600 hover:to-teal-600 rounded-xl flex items-center justify-center transition-all transform hover:scale-110 hover:rotate-6 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                            <a href="#" class="w-11 h-11 bg-gray-800 hover:bg-gradient-to-br hover:from-green-600 hover:to-teal-600 rounded-xl flex items-center justify-center transition-all transform hover:scale-110 hover:rotate-6 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 pt-8" data-aos="fade-up" data-aos-delay="400">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        © {{ date('Y') }} <span class="text-white font-semibold">RSUP Sanglah Denpasar</span>. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6 text-sm">
                        <span class="text-gray-400">Sistem Manajemen SOP <span class="text-green-400 font-semibold">v1.0</span></span>
                        <span class="text-gray-600">|</span>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition">Privacy Policy</a>
                        <span class="text-gray-600">|</span>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize AOS (Animate On Scroll)
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });

            // Mobile Menu Toggle
            $('#mobile-menu-button').on('click', function() {
                $('#mobile-menu').slideToggle(300);
                $(this).find('svg').first().toggle();
                $(this).find('svg').last().toggle();
            });

            // Close mobile menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('nav').length) {
                    $('#mobile-menu').slideUp(300);
                }
            });

            // FAQ Accordion Toggle
            $('.faq-question').on('click', function() {
                const $item = $(this).closest('.faq-item');
                const $answer = $item.find('.faq-answer');
                const $icon = $(this).find('svg');
                
                // Close other open FAQ items
                $('.faq-item').not($item).each(function() {
                    $(this).find('.faq-answer').slideUp(300);
                    $(this).find('.faq-question svg').removeClass('rotate-180');
                });
                
                // Toggle current FAQ item
                $answer.slideToggle(300);
                $icon.toggleClass('rotate-180');
            });

            // Header Scroll Effect
            let lastScroll = 0;
            $(window).on('scroll', function() {
                const currentScroll = $(this).scrollTop();
                
                // Add scrolled class when scrolled down
                if (currentScroll > 50) {
                    $('nav').addClass('scrolled shadow-2xl');
                } else {
                    $('nav').removeClass('scrolled shadow-2xl');
                }
                
                lastScroll = currentScroll;
            });

            // Smooth scrolling for anchor links with offset for fixed header
            $('a[href^="#"]').on('click', function(e) {
                const href = $(this).attr('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = $(href);
                    if(target.length) {
                        // Close mobile menu if open
                        $('#mobile-menu').slideUp(300);
                        
                        $('html, body').stop().animate({
                            scrollTop: target.offset().top - 80
                        }, 1000, 'swing');
                    }
                }
            });

            // Counter animation
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

            // Animate elements on scroll
            $(window).on('scroll', function() {
                $('.feature-card').each(function() {
                    const elementTop = $(this).offset().top;
                    const viewportBottom = $(window).scrollTop() + $(window).height();
                    if (elementTop < viewportBottom - 100) {
                        $(this).addClass('fade-in');
                    }
                });
            });

            // Dynamic Unit Loading
            $('#direktorat_id').on('change', function() {
                const direktoratId = $(this).val();
                const $unitSelect = $('#unit_id');
                
                $unitSelect.html('<option value="">Memuat...</option>');
                
                if (direktoratId) {
                    $.ajax({
                        url: `/api/units-by-direktorat/${direktoratId}`,
                        type: 'GET',
                        success: function(units) {
                            $unitSelect.html('<option value="">Semua Unit</option>');
                            units.forEach(function(unit) {
                                $unitSelect.append(`<option value="${unit.id}">${unit.name}</option>`);
                            });
                        },
                        error: function() {
                            $unitSelect.html('<option value="">Error loading units</option>');
                        }
                    });
                } else {
                    $unitSelect.html('<option value="">Semua Unit</option>');
                    @foreach($units as $unit)
                        $unitSelect.append('<option value="{{ $unit->id }}">{{ $unit->name }}</option>');
                    @endforeach
                }
            });
        });
    </script>
</body>
</html>
