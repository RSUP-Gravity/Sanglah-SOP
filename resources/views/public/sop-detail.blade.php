<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $sop->title }} - SOP RSUP Sanglah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('public.index') }}" class="flex items-center space-x-3 group">
                    <img src="/logo/logo_sanglah.jpg" alt="Logo" class="h-10 w-10 rounded-lg shadow-sm group-hover:shadow transition-all">
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 leading-tight">RSUP Sanglah</h1>
                        <p class="text-xs text-gray-500 font-medium tracking-wide">Portal SOP Digital</p>
                    </div>
                </a>
                
                <a href="{{ route('public.index') }}" class="text-sm font-medium text-gray-500 hover:text-green-600 transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-6 text-sm text-gray-500">
                <a href="{{ route('public.index') }}" class="hover:text-green-600 transition-colors">Beranda</a>
                <span class="mx-2 text-gray-300">/</span>
                <span class="truncate max-w-xs block text-gray-900 font-medium">{{ $sop->title }}</span>
            </nav>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Header Banner -->
                <div class="bg-gradient-to-r from-green-50 to-teal-50 px-8 py-8 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row justify-between md:items-start gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 bg-white text-green-700 text-xs font-bold uppercase tracking-wider rounded-full border border-green-100 shadow-sm">
                                    {{ $sop->sk_number }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider rounded-full border border-gray-200">
                                    Revisi {{ $sop->version }}
                                </span>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-2">{{ $sop->title }}</h1>
                            <p class="text-gray-600 text-lg">{{ $sop->unit->name ?? 'Unit tidak diketahui' }}</p>
                        </div>
                        <div class="flex-shrink-0 flex gap-3">
                            <a href="{{ route('public.sop.download', $sop->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-xl shadow-sm text-gray-700 font-medium hover:bg-gray-50 hover:text-green-600 hover:border-green-200 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download PDF
                            </a>
                            <a href="{{ route('public.sop.view', $sop->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-xl shadow-sm text-white font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
                    <!-- Main Info -->
                    <div class="lg:col-span-2 p-8">
                        <section class="mb-8">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                Deskripsi
                            </h3>
                            <div class="prose prose-green max-w-none text-gray-600 bg-gray-50 p-6 rounded-xl border border-gray-100">
                                {{ $sop->description ?? 'Tidak ada deskripsi tersedia.' }}
                            </div>
                        </section>

                        <section>
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Detail Dokumen
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm">
                                    <span class="block text-xs text-gray-500 mb-1">Tanggal Efektif</span>
                                    <span class="block text-gray-900 font-semibold">{{ $sop->effective_date ? $sop->effective_date->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm">
                                    <span class="block text-xs text-gray-500 mb-1">Dibuat Oleh</span>
                                    <span class="block text-gray-900 font-semibold">{{ $sop->creator->name ?? 'System' }}</span>
                                </div>
                                <div class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm">
                                    <span class="block text-xs text-gray-500 mb-1">Direktorat</span>
                                    <span class="block text-gray-900 font-semibold">{{ $sop->unit->direktorat->name ?? '-' }}</span>
                                </div>
                                <div class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm">
                                    <span class="block text-xs text-gray-500 mb-1">Status</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ ucfirst($sop->status) }}
                                    </span>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="p-8 bg-gray-50/50">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-6">Informasi Tambahan</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Metadata File</h4>
                                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                                    <div class="flex items-center mb-3">
                                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="text-sm font-medium text-gray-900 truncate" title="{{ $sop->file_name }}">{{ $sop->file_name }}</p>
                                            <p class="text-xs text-gray-500">PDF Document</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 border-t border-gray-100 pt-2 mt-2">
                                        <span>Diupload</span>
                                        <span>{{ $sop->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Bantuan</h4>
                                <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-xl p-5 text-white text-center shadow-lg">
                                    <p class="text-sm opacity-90 mb-2">Butuh bantuan terkait SOP ini?</p>
                                    <a href="mailto:support@sanglah.go.id" class="inline-block w-full py-2 bg-white text-teal-700 font-bold rounded-lg text-sm hover:shadow-lg transition-all">
                                        Hubungi Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    
    <footer class="bg-white border-t border-gray-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} RSUP Sanglah Denpasar. All rights reserved.
        </div>
    </footer>

</body>
</html>
