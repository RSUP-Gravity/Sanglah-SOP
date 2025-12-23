@extends('layouts.dashboard')

@section('title', 'Edit SOP')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('sops.show', $sop) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Detail SOP
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit SOP</h1>
        <p class="mt-2 text-gray-600">Update informasi SOP yang sudah ada</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('sops.update', $sop) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Unit -->
            <div class="mb-6">
                <label for="unit_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Unit/Bagian <span class="text-red-500">*</span>
                </label>
                <select name="unit_id" id="unit_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('unit_id') border-red-500 @enderror">
                    <option value="">Pilih Unit</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id', $sop->unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
                @error('unit_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul SOP <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $sop->title) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    placeholder="Contoh: Prosedur Penerimaan Pasien Baru">
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Code -->
            <div class="mb-6">
                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                    Kode SOP <span class="text-red-500">*</span>
                </label>
                <input type="text" name="code" id="code" value="{{ old('code', $sop->code) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('code') border-red-500 @enderror"
                    placeholder="Contoh: SOP-IGD-001">
                @error('code')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="category" id="category" value="{{ old('category', $sop->category) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('category') border-red-500 @enderror"
                    placeholder="Contoh: Pelayanan Pasien">
                @error('category')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('description') border-red-500 @enderror"
                    placeholder="Deskripsi singkat tentang SOP ini...">{{ old('description', $sop->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current File Info -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    File PDF Saat Ini
                </label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $sop->file_name }}</p>
                            <p class="text-sm text-gray-500">{{ number_format($sop->file_size / 1024, 2) }} KB</p>
                        </div>
                        <a href="{{ route('sops.download', $sop->id) }}" target="_blank"
                            class="text-green-600 hover:text-green-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- File Upload (Optional for update) -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                    Upload File PDF Baru (Opsional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-500 transition-colors">
                    <input type="file" name="file" id="file" accept=".pdf"
                        class="hidden"
                        onchange="updateFileName(this)">
                    <label for="file" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">
                            <span class="font-semibold text-green-600 hover:text-green-700">Klik untuk upload</span>
                            atau drag & drop
                        </p>
                        <p class="mt-1 text-xs text-gray-500">PDF hingga 10MB (Kosongkan jika tidak ingin mengubah file)</p>
                        <p id="file-name" class="mt-2 text-sm font-medium text-gray-900"></p>
                    </label>
                </div>
                @error('file')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Effective Date -->
                <div>
                    <label for="effective_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Berlaku <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="effective_date" id="effective_date" 
                        value="{{ old('effective_date', optional($sop->effective_date)->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('effective_date') border-red-500 @enderror">
                    @error('effective_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Review Date -->
                <div>
                    <label for="review_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Review <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="review_date" id="review_date" 
                        value="{{ old('review_date', optional($sop->review_date)->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('review_date') border-red-500 @enderror">
                    @error('review_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-yellow-900">Perhatian</h3>
                        <ul class="mt-2 text-sm text-yellow-700 space-y-1">
                            <li>• Perubahan pada SOP akan memerlukan validasi ulang</li>
                            <li>• Jika mengupload file baru, file lama akan diganti</li>
                            <li>• Riwayat versi akan disimpan untuk dokumentasi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                    class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                    Update SOP
                </button>
                <a href="{{ route('sops.show', $sop) }}"
                    class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileNameDisplay = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        const fileName = input.files[0].name;
        const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
        fileNameDisplay.textContent = `${fileName} (${fileSize} MB)`;
    } else {
        fileNameDisplay.textContent = '';
    }
}
</script>
@endsection
