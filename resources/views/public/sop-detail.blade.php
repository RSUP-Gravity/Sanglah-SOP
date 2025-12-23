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
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar (Metadata) -->
            <aside class="w-full lg:w-80 flex-shrink-0 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wider rounded-full">
                            {{ $sop->sk_number }}
                        </span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider rounded-full">
                            Rev {{ $sop->version }}
                        </span>
                    </div>
                     <h1 class="text-xl font-bold text-gray-900 leading-tight mb-2">{{ $sop->title }}</h1>
                     <p class="text-sm text-gray-500 mb-4">{{ $sop->unit->name ?? 'Unit tidak diketahui' }}</p>
                     
                     <div class="space-y-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('public.sop.download', $sop->id) }}" class="flex items-center justify-center w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                        <a href="{{ route('public.sop.view', $sop->id) }}" target="_blank" class="flex items-center justify-center w-full px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium text-sm">
                             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Buka di Tab Baru
                        </a>
                     </div>
                </div>

                <!-- Details Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Informasi Dokumen</h3>
                    <div class="space-y-4 text-sm">
                        <div>
                            <span class="block text-gray-500 text-xs uppercase mb-1">Tanggal Efektif</span>
                            <span class="font-medium text-gray-900">{{ $sop->effective_date ? $sop->effective_date->format('d F Y') : '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 text-xs uppercase mb-1">Direktorat</span>
                            <span class="font-medium text-gray-900">{{ $sop->unit->direktorat->name ?? '-' }}</span>
                        </div>
                         <div>
                            <span class="block text-gray-500 text-xs uppercase mb-1">Dibuat Oleh</span>
                            <span class="font-medium text-gray-900">{{ $sop->creator->name ?? 'System' }}</span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content (PDF Viewer & Description) -->
            <div class="flex-1 min-w-0">
                <!-- Description Section -->
                 <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-3">Deskripsi</h2>
                    <div class="prose prose-sm prose-green max-w-none text-gray-600">
                        {{ $sop->description ?? 'Tidak ada deskripsi.' }}
                    </div>
                </div>

                <!-- PDF Preview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                         <h2 class="font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Preview Dokumen
                         </h2>
                    </div>
                    <div class="aspect-[1.414/1] w-full bg-gray-100 relative">
                        <iframe src="{{ route('public.sop.view', $sop->id) }}#toolbar=0" class="absolute inset-0 w-full h-full" frameborder="0"></iframe>
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
