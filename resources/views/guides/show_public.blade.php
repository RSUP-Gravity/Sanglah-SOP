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

    <div class="max-w-[90rem] mx-auto w-full flex">
        <!-- Sidebar - Left -->
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
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 w-full lg:pl-72 xl:pr-72 min-h-screen pt-24 lg:pt-28 pb-16 bg-white">
            <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                            {!! nl2br(e($section['content'] ?? '')) !!}
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
        </div>

        <!-- Sidebar - Right (TOC) -->
        <div class="hidden xl:block fixed z-40 inset-0 top-20 left-auto right-[max(0px,calc(50%-45rem))] w-72 overflow-y-auto pt-24 pb-10 pl-8 bg-transparent">
            <div class="border-l border-gray-200 pl-4">
                <h5 class="text-gray-900 font-bold text-sm mb-4 uppercase tracking-wide">Pada Halaman Ini</h5>
                <ul class="text-sm space-y-3 text-gray-600" id="toc">
                    <!-- JS Populated -->
                </ul>
            </div>
        </div>
    </div>

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
