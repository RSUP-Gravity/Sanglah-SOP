@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Navbar -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('public.index') }}" class="flex items-center gap-2">
                        <img src="/logo/logo_sanglah.jpg" alt="Logo" class="h-8 w-auto rounded-md">
                        <span class="font-bold text-gray-900 text-lg hidden sm:block">Pusat Panduan</span>
                    </a>
                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-700">SOP v1.0</span>
                </div>

                <!-- Right Nav -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('guides.list') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">
                        Index Panduan
                    </a>
                    <a href="{{ route('public.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row min-h-[calc(100vh-4rem)]">
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 flex-shrink-0 lg:border-r border-gray-200 py-6 pr-6 lg:sticky lg:top-16 lg:h-[calc(100vh-4rem)] overflow-y-auto hidden lg:block">
                <nav class="space-y-6">
                    @forelse($chapters as $chapterName => $guidesInChapter)
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wider mb-2">
                                {{ $chapterName }}
                            </h3>
                            <ul class="space-y-1">
                                @foreach($guidesInChapter as $item)
                                    <li>
                                        <a href="{{ route('guides.showPublic', $item->slug) }}" 
                                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->route('slug') == $item->slug ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                            <span class="truncate">{{ $item->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada panduan.</p>
                    @endforelse
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 lg:pl-10 py-8 max-w-4xl">
                <article class="prose prose-green max-w-none">
                    <span class="text-green-600 font-semibold tracking-wide text-sm uppercase">{{ $guide->chapter }}</span>
                    <h1 class="mb-4">{{ $guide->title }}</h1>
                    
                    @if($guide->image_path)
                        <img src="{{ Storage::url($guide->image_path) }}" alt="{{ $guide->title }}" class="rounded-xl shadow-md w-full object-cover max-h-96">
                    @endif

                    <div class="mt-8">
                        {!! nl2br(e($guide->description)) !!}
                    </div>

                    @if($guide->video_url)
                        <div class="mt-8">
                            <h3 class="text-lg font-bold mb-3">Video Tutorial</h3>
                            <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl overflow-hidden shadow-sm">
                                <iframe src="{{ str_replace('watch?v=', 'embed/', $guide->video_url) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
                            </div>
                        </div>
                    @endif
                </article>

                <div class="mt-12 pt-8 border-t border-gray-200 flex justify-between">
                    <a href="{{ route('guides.list') }}" class="text-green-600 hover:text-green-700 font-medium flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Index
                    </a>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
