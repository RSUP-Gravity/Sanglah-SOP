<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentasi - SOP Sanglah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #171923; color: #E2E8F0; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #4A5568; border-radius: 3px; }
        ::-webkit-scrollbar-track { background: transparent; }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('layouts.partials.public-header')

    <div class="max-w-[90rem] mx-auto w-full flex">
        <!-- Sidebar -->
        <div class="hidden lg:block fixed z-40 inset-0 top-20 left-[max(0px,calc(50%-45rem))] right-auto w-72 overflow-y-auto border-r border-gray-200 bg-gray-50 pb-10">
            <!-- Sidebar Search -->
            <div class="sticky top-0 z-10 bg-gray-50 p-4 mb-4">
               <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-4 h-4 text-gray-500 group-focus-within:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Search docs..." class="w-full py-2 pl-9 pr-3 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm transition-all placeholder-gray-400">
                     <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <span class="text-gray-400 text-xs border border-gray-200 rounded px-1.5 py-0.5">/</span>
                    </div>
                </div>
            </div>

            <nav class="px-6 pb-8 space-y-2">
                @foreach($chapters as $chapterName => $guidesInChapter)
                    <div class="group">
                         <details class="group">
                            <summary class="flex items-center justify-between font-bold text-gray-900 cursor-pointer list-none py-2 hover:text-green-600 transition-colors">
                                <span>{{ $chapterName }}</span>
                                <span class="transition group-open:rotate-180">
                                    <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                                </span>
                            </summary>
                            <ul class="space-y-1 mt-1 border-l border-gray-200 pl-4 ml-2">
                                @foreach($guidesInChapter as $item)
                                    <li>
                                        <a href="{{ route('guides.showPublic', $item->slug) }}" 
                                           class="block py-1.5 text-sm text-gray-600 hover:text-green-600 pl-2 transition-colors duration-200">
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    </div>
                @endforeach
            </nav>
        </div>

        <!-- Main Content Placeholder -->
        <div class="flex-1 w-full lg:pl-72 min-h-screen pt-24 lg:pt-28 pb-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
                <!-- Hero Section -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center p-3 bg-green-50 rounded-2xl mb-6 ring-1 ring-green-100 shadow-sm">
                        <img src="/logo/logo_sanglah.jpg" alt="Logo" class="h-12 w-auto rounded-lg">
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight mb-6">
                        Pusat Panduan <span class="text-green-600">SOP Digital</span>
                    </h1>
                    <p class="text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">
                        Dokumentasi resmi dan Standar Operasional Prosedur untuk pelayanan dan manajemen di RSUP Sanglah / RS Prof. Ngoerah.
                    </p>
                    
                    @php
                        $firstGuide = null;
                        foreach($chapters as $group) {
                            if($group->isNotEmpty()) {
                                $firstGuide = $group->first();
                                break;
                            }
                        }
                    @endphp

                    @if($firstGuide)
                        <div class="mt-10 flex justify-center gap-4">
                            <a href="{{ route('guides.showPublic', $firstGuide->slug) }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-green-600 hover:bg-green-700 transition-all shadow-lg hover:shadow-green-500/30 transform hover:-translate-y-0.5">
                                Mulai Membaca
                                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <a href="#browse-chapters" class="inline-flex items-center px-8 py-4 border border-gray-200 text-lg font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all shadow-sm hover:shadow-md">
                                Jelajahi Topik
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Feature Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                    <div class="p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:border-green-200 transition-colors">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Dokumentasi Terstruktur</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Panduan disusun secara sistematis berdasarkan kategori (Umum, Teknis, Penting) untuk memudahkan pencarian informasi yang Anda butuhkan.
                        </p>
                    </div>

                    <div class="p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:border-green-200 transition-colors">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Tutorial Video & Visual</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Dilengkapi dengan ilustrasi gambar dan video tutorial interaktif untuk mempermudah pemahaman langkah demi langkah setiap prosedur.
                        </p>
                    </div>
                </div>

                <!-- Chapter Browser -->
                <div id="browse-chapters" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b border-gray-200 pb-4">Jelajahi Kategori Panduan</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($chapters as $chapterName => $guides)
                            <div class="group relative bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all hover:border-green-500/30">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $chapterName }}</h3>
                                    <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-green-100 group-hover:text-green-700 transition-colors">
                                        {{ $guides->count() }} Topik
                                    </span>
                                </div>
                                <ul class="space-y-3">
                                    @foreach($guides->take(3) as $guide)
                                        <li>
                                            <a href="{{ route('guides.showPublic', $guide->slug) }}" class="flex items-center text-sm text-gray-600 hover:text-green-600 group-hover:text-gray-700 transition-colors">
                                                <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                <span class="truncate">{{ $guide->title }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @if($guides->count() > 3)
                                        <li>
                                            <span class="text-xs text-gray-400 pl-6">+ {{ $guides->count() - 3 }} lainnya...</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
