<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $guide->title }} - SOP Sanglah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #171923; /* Laravel Dark */
            color: #E2E8F0;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1); 
        }
        ::-webkit-scrollbar-thumb {
            background: #4A5568; 
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #718096; 
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #CBD5E0;
            border-radius: 2px;
        }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background: #A0AEC0;
        }

        /* Content Typography Mimicking Prose */
        .content-body h1 { font-size: 2.5rem; line-height: 1.2; font-weight: 800; color: #111827 !important; margin-bottom: 2rem; }
        .content-body h2 { font-size: 1.75rem; line-height: 1.3; font-weight: 700; color: #111827 !important; margin-top: 3rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #E5E7EB; scroll-margin-top: 100px; }
        .content-body h3 { font-size: 1.5rem; line-height: 1.4; font-weight: 600; color: #111827 !important; margin-top: 2rem; margin-bottom: 1rem; scroll-margin-top: 100px; }
        .content-body h4 { font-size: 1.25rem; font-weight: 600; color: #111827 !important; margin-top: 1.5rem; margin-bottom: 0.75rem; }
        .content-body p { margin-bottom: 1.5rem; line-height: 1.8; color: #374151 !important; font-size: 1.05rem; }
        .content-body ul { list-style-type: disc; padding-left: 1.75rem; margin-bottom: 1.5rem; color: #374151 !important; }
        .content-body ol { list-style-type: decimal; padding-left: 1.75rem; margin-bottom: 1.5rem; color: #374151 !important; }
        .content-body li { margin-bottom: 0.5rem; color: inherit !important; }
        .content-body a { color: #16A34A !important; text-decoration: none; border-bottom: 1px solid transparent; transition: border-color 0.2s; }
        .content-body a:hover { border-bottom-color: #16A34A; }
        .content-body code { background-color: #F3F4F6; padding: 0.2em 0.4em; rounded: 0.25rem; font-size: 0.9em; color: #111827 !important; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
        .content-body pre { background-color: #1F2937 !important; padding: 1.5rem; border-radius: 0.75rem; overflow-x: auto; margin-bottom: 1.5rem; border: 1px solid #374151; }
        .content-body pre code { background-color: transparent !important; padding: 0; color: #E5E7EB !important; font-size: 0.9em; }
        .content-body img { border-radius: 0.75rem; margin-top: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); background-color: transparent !important; }
        .content-body blockquote { border-left: 4px solid #16A34A; padding-left: 1.5rem; font-style: italic; color: #4B5563 !important; margin-bottom: 1.5rem; background: #F0FDF4; py: 0.5rem; padding-top: 1rem; padding-bottom: 1rem; border-radius: 0 0.5rem 0.5rem 0; }
        .content-body table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        .content-body th { text-align: left; padding: 0.75rem; border-bottom: 1px solid #D1D5DB; color: #111827 !important; font-weight: 600; }
        .content-body td { padding: 0.75rem; border-bottom: 1px solid #E5E7EB; color: #374151 !important; }
        .content-body span[style] { color: inherit !important; background-color: transparent !important; } /* Nuclear option for pasted styles */
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('layouts.partials.public-header')

    <!-- Wrapper for Sidebar and Content -->
    <div class="max-w-[90rem] mx-auto w-full flex min-h-screen pt-20">
        <!-- Sidebar - Left -->
        <aside class="hidden lg:block w-72 flex-shrink-0 border-r border-gray-200 bg-gray-50 sticky top-20 h-[calc(100vh-5rem)] overflow-y-auto custom-scrollbar pb-10">
            <!-- Sidebar Search -->
            <div class="sticky top-0 z-10 bg-gray-50 p-4 mb-4 border-b border-gray-100">
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
                         <details class="group" @if(isset($guide) && $guidesInChapter->contains('id', $guide->id)) open @endif>
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
                                           class="block py-1.5 text-sm transition-colors duration-200 
                                                  {{ isset($guide) && $guide->slug == $item->slug 
                                                     ? 'text-green-600 font-semibold pl-2' 
                                                     : 'text-gray-600 hover:text-green-600 pl-2' }}">
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    </div>
                @endforeach
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0 bg-white px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
            <article class="max-w-3xl mx-auto w-full">
                <!-- Title -->
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-8">{{ $guide->title }}</h1>

                @if($guide->image_path)
                    <div class="mb-10 rounded-xl overflow-hidden border border-gray-200 shadow-lg">
                         <img src="{{ Storage::url($guide->image_path) }}" alt="{{ $guide->title }}" class="w-full object-cover">
                    </div>
                @endif
                
                <!-- Dynamic Content -->
                <div class="content-body text-gray-900">
                    {!! $guide->description !!}

                    @if(is_array($guide->sections))
                        <div class="mt-8 space-y-8">
                            @foreach($guide->sections as $section)
                                @if(!empty($section['title']))
                                    <div class="section-block">
                                        <h2 id="{{ \Illuminate\Support\Str::slug($section['title']) }}" class="text-2xl font-bold text-gray-900 mb-4 border-b pb-2 scroll-mt-24">
                                            {{ $section['title'] }}
                                        </h2>
                                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                                            {!! $section['content'] ?? '' !!}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                
                @if($guide->video_url)
                 <div class="mt-12 bg-gray-50 border border-gray-200 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Video Tutorial
                    </h3>
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-black">
                         <iframe src="{{ str_replace('watch?v=', 'embed/', $guide->video_url) }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                    </div>
                 </div>
                @endif

                <!-- Last Updated -->
                <div class="mt-16 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        Terakhir diperbarui pada {{ $guide->updated_at->format('d F Y') }}
                    </p>
                </div>
            </article>
        </main>

        <!-- Sidebar - Right (TOC) -->
        <aside class="hidden xl:block w-72 flex-shrink-0 sticky top-20 h-[calc(100vh-5rem)] overflow-y-auto px-6 py-10 custom-scrollbar">
            <div class="border-l border-gray-200 pl-4">
                <h5 class="text-gray-900 font-bold text-sm mb-4 uppercase tracking-wide">Pada Halaman Ini</h5>
                <ul class="text-sm space-y-3 text-gray-600" id="toc">
                    <!-- JS Populated -->
                </ul>
            </div>
        </aside>
    </div>

    <!-- Footer for Guide Page (Full Width) -->
    <footer class="bg-white text-gray-600 border-t border-gray-200 relative z-50">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-xl font-bold text-gray-900">SIM SOP RS Sanglah</h3>
                            <p class="text-sm text-gray-500">Sistem Informasi Manajemen SOP</p>
                        </div>
                    </div>
                    <p class="text-gray-500 mb-4">
                        Platform digital terpadu untuk pengelolaan Standar Operasional Prosedur di Rumah Sakit Umum Pusat Sanglah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-gray-900 font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}#hero" class="text-gray-600 hover:text-green-600 transition-colors">Beranda</a></li>
                        <li><a href="{{ url('/') }}#about" class="text-gray-600 hover:text-green-600 transition-colors">Tentang</a></li>
                        <li><a href="{{ url('/') }}#features" class="text-gray-600 hover:text-green-600 transition-colors">Fitur</a></li>
                        <li><a href="{{ url('/') }}#how-it-works" class="text-gray-600 hover:text-green-600 transition-colors">Cara Kerja</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-gray-900 font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-600">
                            <svg class="h-5 w-5 mr-2 mt-0.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm">Jl. Diponegoro, Denpasar, Bali</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">info@sanglah.go.id</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-sm">(0361) 227911-15</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-200 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-500 mb-4 md:mb-0">
                        &copy; {{ date('Y') }} Rumah Sakit Umum Pusat Sanglah. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-500 hover:text-green-600 transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-500 hover:text-green-600 transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-500 hover:text-green-600 transition-colors">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toc = document.getElementById('toc');
            const headings = document.querySelectorAll('.content-body h2, .content-body h3');
            
            if (headings.length === 0) {
                if (toc) toc.parentElement.classList.add('hidden');
                return;
            }

            headings.forEach(heading => {
                const id = heading.id || heading.innerText.toLowerCase().replace(/[^a-z0-9]+/g, '-');
                heading.id = id;

                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#' + id;
                a.innerText = heading.innerText;
                a.className = 'block transition-colors duration-200 hover:text-green-600';
                
                // Indent H3
                if (heading.tagName === 'H3') {
                    a.classList.add('pl-4', 'text-gray-500', 'text-xs');
                } else {
                    a.classList.add('font-medium', 'text-gray-700');
                }

                li.appendChild(a);
                toc.appendChild(li);
            });

            // Scroll Spy
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const id = entry.target.getAttribute('id');
                    const link = toc.querySelector(`a[href="#${id}"]`);
                    
                    if (entry.isIntersecting) {
                        toc.querySelectorAll('a').forEach(l => {
                            l.classList.remove('text-green-600', 'font-bold');
                             // Reset text color based on level
                             if(l.classList.contains('text-xs')) l.classList.add('text-gray-500');
                             else l.classList.add('text-gray-700');
                        });
                        
                        if (link) {
                            link.classList.remove('text-gray-500', 'text-gray-700');
                            link.classList.add('text-green-600', 'font-bold');
                        }
                    }
                });
            }, { rootMargin: '-100px 0px -66%' });

            headings.forEach(heading => observer.observe(heading));
        });
    </script>
</body>
</html>
