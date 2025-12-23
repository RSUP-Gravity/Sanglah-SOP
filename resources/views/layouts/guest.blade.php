<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIM SOP RS Sanglah') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full">
        <!-- Background Image with Blur -->
        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0" style="background-image: url('/background/gedung%20sanglah.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; filter: blur(8px); transform: scale(1.05);"></div>
            <div class="absolute inset-0 bg-green-900/60 backdrop-blur-sm"></div> <!-- Overlay & Blur -->
        </div>

        <div class="min-h-screen w-full flex flex-col items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
            <!-- Decorative Elements (Optional - reduced opacity for cleaner look) -->
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/5 rounded-full blur-3xl animate-pulse pointer-events-none"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-teal-400/10 rounded-full blur-3xl animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>

            <!-- Back to Home Link -->
            <div class="w-full max-w-md mb-6 flex justify-center relative z-10">
                <a href="/" class="group inline-flex items-center text-white/90 hover:text-white transition-all bg-white/10 hover:bg-white/20 px-4 py-2 rounded-full backdrop-blur-sm text-sm font-medium">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Auth Card -->
            <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden relative z-10 transform transition-all">
                <!-- Header with Logo -->
                <div class="bg-gradient-to-r from-green-600 to-teal-600 p-8 text-center text-white relative">
                    <!-- Pattern Overlay -->
                    <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.1) 10px, rgba(255,255,255,.1) 20px);"></div>
                    
                    <div class="relative z-10">
                        <div class="flex justify-center mb-4">
                            <div class="p-1 bg-white/20 backdrop-blur-sm rounded-2xl">
                                <img src="/logo/logo_sanglah.jpg" alt="Logo Sanglah" class="h-16 w-16 rounded-xl shadow-lg bg-white object-contain p-1">
                            </div>
                        </div>
                        <h1 class="text-2xl font-bold tracking-tight">SIM SOP</h1>
                        <p class="text-green-50 text-sm mt-1 font-medium tracking-wide opacity-90">RSUP Sanglah Denpasar</p>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    {{ $slot }}
                </div>
            </div>

            <!-- Copyright footer -->
            <div class="mt-8 text-center text-white/60 text-xs relative z-10">
                &copy; {{ date('Y') }} RSUP Sanglah Denpasar. All rights reserved.
            </div>
        </div>
    </body>
</html>
