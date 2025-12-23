@extends('layouts.dashboard')

@section('title', 'Tambah Panduan')
@section('page-title', 'Tambah Panduan Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-900">Formulir Panduan</h3>
        </div>
        
        <form action="{{ route('guides.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Panduan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Contoh: Cara Membuat SOP Baru">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Chapter/Kategori -->
                <div class="col-span-2">
                    <label for="chapter" class="block text-sm font-medium text-gray-700 mb-2">Bagian / Kategori</label>
                    <div class="relative">
                        <select name="chapter" id="chapter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none bg-white">
                            <option value="Umum" {{ old('chapter') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="Penting" {{ old('chapter') == 'Penting' ? 'selected' : '' }}>Penting</option>
                            <option value="Teknis" {{ old('chapter') == 'Teknis' ? 'selected' : '' }}>Teknis</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('chapter')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Pendahuluan / Deskripsi Utama <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Jelaskan gambaran umum panduan...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dynamic Sections -->
                <div class="col-span-2 space-y-4" x-data="sectionManager()">
                    <div class="flex items-center justify-between border-b border-gray-200 pb-2">
                        <label class="block text-lg font-medium text-gray-900">Bagian / Bab Tambahan</label>
                        <button type="button" @click="addSection()" class="text-sm px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 font-medium transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Bagian
                        </button>
                    </div>

                    <template x-for="(section, index) in sections" :key="section.id">
                        <div class="relative bg-gray-50 p-4 rounded-xl border border-gray-200 group transition-all hover:border-green-200 hover:shadow-sm">
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" @click="removeSection(index)" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Bagian">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4 pr-8">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Judul Bagian</label>
                                    <input type="text" :name="'sections['+index+'][title]'" x-model="section.title" placeholder="Contoh: Langkah 1 - Persiapan" 
                                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-green-500 focus:border-green-500 text-sm font-medium">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Konten Bagian</label>
                                    <textarea :name="'sections['+index+'][content]'" x-model="section.content" rows="4" placeholder="Tuliskan detail poin ini..." 
                                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-green-500 focus:border-green-500 text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div x-show="sections.length === 0" class="text-center py-8 border-2 border-dashed border-gray-200 rounded-xl">
                        <p class="text-sm text-gray-500">Belum ada bagian tambahan.</p>
                        <button type="button" @click="addSection()" class="mt-2 text-sm text-green-600 hover:text-green-700 font-medium">
                            + Tambah Bagian Pertama
                        </button>
                    </div>
                </div>

                <script>
                    function sectionManager() {
                        return {
                            sections: [],
                            addSection() {
                                this.sections.push({
                                    id: Date.now(),
                                    title: '',
                                    content: ''
                                });
                            },
                            removeSection(index) {
                                this.sections.splice(index, 1);
                            }
                        }
                    }
                </script>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Ilustrasi</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WEBP. Max: 2MB.</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">Link Video (Opsional)</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="https://youtube.com/...">
                    @error('video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Create/Edit Columns -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="sort_order" min="0" value="{{ old('sort_order', 0) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>

                <div class="flex items-center pt-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Aktifkan Panduan</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 mt-6">
                <a href="{{ route('guides.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition shadow-lg shadow-green-200">
                    Simpan Panduan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    tinymce.init({
        selector: '#description',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Plus Jakarta Sans,sans-serif; font-size:14px }',
        branding: false,
        promotion: false
    });
</script>
@endpush
