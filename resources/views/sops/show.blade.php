@extends('layouts.dashboard')

@section('title', 'Detail SOP')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('sops.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar SOP
        </a>
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $sop->title }}</h1>
                <p class="mt-2 text-gray-600">{{ $sop->code }}</p>
            </div>
            <div class="flex gap-2">
                @if($sop->status === 'draft' && (Auth::user()->isSuperAdmin() || $sop->created_by === Auth::id()))
                    <a href="{{ route('validations.create', $sop) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Ajukan Validasi
                    </a>
                @endif
                @if(Auth::user()->isSuperAdmin() || $sop->created_by === Auth::id())
                    <a href="{{ route('sops.edit', $sop) }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit SOP
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Info Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi SOP</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold mt-1
                            @if($sop->status === 'active') bg-green-100 text-green-800
                            @elseif($sop->status === 'pending_validation') bg-yellow-100 text-yellow-800
                            @elseif($sop->status === 'draft') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $sop->status)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Versi</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $sop->version }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Unit</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $sop->unit->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kategori</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $sop->category }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Berlaku</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ optional($sop->effective_date)->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Review</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ optional($sop->review_date)->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>

                @if($sop->description)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-sm text-gray-500 mb-2">Deskripsi</p>
                        <p class="text-gray-900">{{ $sop->description }}</p>
                    </div>
                @endif

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-2">Pembuat</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr($sop->creator->name, 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-900">{{ $sop->creator->name }}</p>
                            <p class="text-sm text-gray-500">{{ optional($sop->created_at)->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                @if($sop->updated_by && $sop->updated_by !== $sop->created_by)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 mb-2">Terakhir Diupdate</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr($sop->updater->name, 0, 1)) }}
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">{{ $sop->updater->name }}</p>
                                <p class="text-sm text-gray-500">{{ optional($sop->updated_at)->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- PDF Preview -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Dokumen PDF</h2>
                    <a href="{{ route('sops.download', $sop->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download PDF
                    </a>
                </div>
                
                <div class="border border-gray-300 rounded-lg overflow-hidden" style="height: 600px;">
                    <iframe src="{{ route('sops.view', $sop->id) }}" 
                        class="w-full h-full"
                        frameborder="0">
                    </iframe>
                </div>

                <div class="mt-4 text-sm text-gray-500">
                    <p>Nama File: {{ $sop->file_name }}</p>
                    <p>Ukuran: {{ number_format($sop->file_size / 1024, 2) }} KB</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Version History -->
            @if($sop->versions->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Versi</h3>
                <div class="space-y-3">
                    @foreach($sop->versions as $version)
                        <div class="border-l-4 border-green-500 pl-4">
                            <p class="font-semibold text-gray-900">Versi {{ $version->version }}</p>
                            <p class="text-sm text-gray-600">{{ $version->change_notes }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ optional($version->created_at)->format('d M Y H:i') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Validation History -->
            @if($sop->validations->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Validasi</h3>
                <div class="space-y-3">
                    @foreach($sop->validations as $validation)
                        <div class="border-l-4 
                            @if($validation->status === 'approved') border-green-500
                            @elseif($validation->status === 'rejected') border-red-500
                            @else border-yellow-500
                            @endif pl-4">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-semibold text-gray-900">{{ optional($validation->validator)->name ?? '-' }}</p>
                                <span class="text-xs px-2 py-1 rounded-full
                                    @if($validation->status === 'approved') bg-green-100 text-green-800
                                    @elseif($validation->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($validation->status) }}
                                </span>
                            </div>
                            @if($validation->notes)
                                <p class="text-sm text-gray-600">{{ $validation->notes }}</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">
                                {{ optional($validation->created_at)->format('d M Y H:i') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Tindakan</h3>
                <div class="space-y-2">
                    @if(Auth::user()->isValidator() && $sop->status === 'pending_validation')
                        <button onclick="showValidationModal()"
                            class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Validasi SOP
                        </button>
                    @endif
                    
                    @if(Auth::user()->isSuperAdmin() || $sop->created_by === Auth::id())
                        <form action="{{ route('sops.destroy', $sop) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus SOP ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                Hapus SOP
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
