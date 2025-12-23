@extends('layouts.dashboard')

@section('title', 'Ajukan Validasi SOP')
@section('page-title', 'Ajukan Validasi SOP')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('sops.show', $sop) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Detail SOP
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Ajukan Validasi SOP</h1>
        <p class="mt-2 text-gray-600">Ajukan SOP untuk divalidasi oleh validator</p>
    </div>

    <!-- SOP Info -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi SOP</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Judul SOP</p>
                <p class="font-semibold text-gray-900">{{ $sop->title }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Kode SOP</p>
                <p class="font-semibold text-gray-900">{{ $sop->code }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Unit</p>
                <p class="font-semibold text-gray-900">{{ $sop->unit->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Kategori</p>
                <p class="font-semibold text-gray-900">{{ $sop->category }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status Saat Ini</p>
                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-full mt-1">
                    Draft
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                <p class="font-semibold text-gray-900">{{ $sop->created_at->format('d M Y') }}</p>
            </div>
        </div>

        @if($sop->description)
        <div class="mt-4 pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-500 mb-2">Deskripsi</p>
            <p class="text-gray-900">{{ $sop->description }}</p>
        </div>
        @endif
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('validations.store', $sop) }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan Pengajuan (Opsional)
                </label>
                <textarea name="notes" id="notes" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                    placeholder="Tambahkan catatan atau informasi tambahan untuk validator...">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-blue-900">Proses Validasi</h3>
                        <ul class="mt-2 text-sm text-blue-700 space-y-1">
                            <li>• Setelah diajukan, status SOP akan berubah menjadi "Pending Validation"</li>
                            <li>• Validator dari unit Anda akan menerima notifikasi</li>
                            <li>• Validator dapat menyetujui atau menolak SOP</li>
                            <li>• Jika disetujui, SOP akan berstatus "Active"</li>
                            <li>• Jika ditolak, SOP akan kembali ke status "Draft" untuk diperbaiki</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Warning Box -->
            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-yellow-900">Perhatian</h3>
                        <p class="mt-1 text-sm text-yellow-700">
                            Pastikan semua informasi SOP sudah benar dan file PDF sudah diupload sebelum mengajukan validasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                    class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                    Ajukan untuk Validasi
                </button>
                <a href="{{ route('sops.show', $sop) }}"
                    class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
