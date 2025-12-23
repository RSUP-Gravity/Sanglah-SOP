

@extends('layouts.dashboard')

@section('title', 'Manajemen Panduan')
@section('page-title', 'Panduan Penggunaan')

@section('content')
<div class="space-y-6">
    <!-- Actions -->
    <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Daftar Panduan</h2>
            <p class="text-sm text-gray-500">Kelola konten panduan penggunaan sistem</p>
        </div>
        <a href="{{ route('guides.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Panduan
        </a>
    </div>

    <!-- Guides List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul & Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($guides as $guide)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $guide->sort_order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($guide->image_path)
                            <img src="{{ Storage::url($guide->image_path) }}" class="h-16 w-24 object-cover rounded-lg" alt="Guide Image">
                        @else
                            <div class="h-16 w-24 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Image</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 py-1 bg-gray-100 rounded text-xs font-semibold">{{ $guide->chapter ?? 'Umum' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $guide->title }}</div>
                        <div class="text-sm text-gray-500 line-clamp-2">{{ Str::limit(strip_tags($guide->description), 100) }}</div>
                        @if($guide->video_url)
                            <a href="{{ $guide->video_url }}" target="_blank" class="text-xs text-blue-500 hover:underline mt-1 block">Lihat Video</a>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button type="button" 
                                id="toggle-btn-{{ $guide->id }}"
                                onclick="toggleGuideStatus({{ $guide->id }}, '{{ route('guides.toggle-status', $guide->id) }}')"
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 {{ $guide->is_active ? 'bg-green-600' : 'bg-gray-200' }}">
                            <span class="sr-only">Toggle Status</span>
                            <span id="toggle-circle-{{ $guide->id }}" 
                                  aria-hidden="true" 
                                  class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $guide->is_active ? 'translate-x-5' : 'translate-x-0' }}">
                            </span>
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('guides.edit', $guide) }}" class="text-amber-600 hover:text-amber-900 bg-amber-50 p-2 rounded-lg hover:bg-amber-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('guides.destroy', $guide) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus panduan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg hover:bg-red-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        Belum ada panduan. Silahkan tambahkan panduan baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($guides->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $guides->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleGuideStatus(id, url) {
        const btn = document.getElementById(`toggle-btn-${id}`);
        const circle = document.getElementById(`toggle-circle-${id}`);
        
        // Disable button while processing
        btn.disabled = true;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(async response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Clone response to read text if json fails
            const clone = response.clone();
            try {
                return await response.json();
            } catch (e) {
                const text = await clone.text();
                console.error('Response was not JSON:', text);
                throw new Error('Server returned invalid JSON');
            }
        })
        .then(data => {
            if (data.success) {
                // Update UI based on new status
                if (data.is_active) {
                    btn.classList.remove('bg-gray-200');
                    btn.classList.add('bg-green-600');
                    circle.classList.remove('translate-x-0');
                    circle.classList.add('translate-x-5');
                } else {
                    btn.classList.remove('bg-green-600');
                    btn.classList.add('bg-gray-200');
                    circle.classList.remove('translate-x-5');
                    circle.classList.add('translate-x-0');
                }
            } else {
                alert('Gagal memperbarui status: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memperbarui status. Cek console untuk detail.');
        })
        .finally(() => {
            btn.disabled = false;
        });
    }
</script>
@endpush
