@extends('layouts.dashboard')

@section('page-title', 'Notifikasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
            <p class="text-gray-600 mt-1">Kelola semua notifikasi Anda</p>
        </div>
        @if($notifications->where('read_at', null)->count() > 0)
        <form action="{{ route('notifications.read-all') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Tandai Semua Dibaca
                </div>
            </button>
        </form>
        @endif
    </div>

    <!-- Notifications List -->
    @if($notifications->count() > 0)
        <div class="space-y-3">
            @foreach($notifications as $notification)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md {{ $notification->read_at ? 'opacity-75' : '' }}">
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-4">
                            <!-- Notification Icon -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-lg {{ $notification->read_at ? 'bg-gray-100' : 'bg-gradient-to-br from-green-500 to-teal-500' }} flex items-center justify-center">
                                    @if($notification->type === 'validation_request')
                                        <svg class="w-6 h-6 {{ $notification->read_at ? 'text-gray-500' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @elseif($notification->type === 'validation_approved')
                                        <svg class="w-6 h-6 {{ $notification->read_at ? 'text-gray-500' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @elseif($notification->type === 'validation_rejected')
                                        <svg class="w-6 h-6 {{ $notification->read_at ? 'text-gray-500' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 {{ $notification->read_at ? 'text-gray-500' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Notification Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <h3 class="text-base font-semibold text-gray-900">
                                        {{ $notification->title }}
                                    </h3>
                                    @if(!$notification->read_at)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Baru
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-3">{{ $notification->message }}</p>
                                
                                <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                    @if($notification->data && isset($notification->data['sop_id']))
                                        <a href="{{ route('sops.show', $notification->data['sop_id']) }}" class="text-green-600 hover:text-green-700 font-medium">
                                            Lihat SOP →
                                        </a>
                                    @endif
                                    @if($notification->data && isset($notification->data['validation_id']))
                                        <a href="{{ route('validations.show', $notification->data['validation_id']) }}" class="text-green-600 hover:text-green-700 font-medium">
                                            Lihat Validasi →
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col gap-2">
                                @if(!$notification->read_at)
                                    <button onclick="markAsRead({{ $notification->id }})" class="p-2 rounded-lg text-gray-400 hover:text-green-600 hover:bg-green-50 transition-colors" title="Tandai dibaca">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                @endif
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus notifikasi ini?')" class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $notifications->links() }}
        </div>

        <!-- Clear Read Notifications -->
        @if($notifications->where('read_at', '!=', null)->count() > 0)
        <div class="mt-6 text-center">
            <form action="{{ route('notifications.clear-read') }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus semua notifikasi yang sudah dibaca?')" class="text-sm text-red-600 hover:text-red-700 font-medium">
                    Hapus Notifikasi yang Sudah Dibaca
                </button>
            </form>
        </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-xl border border-gray-200">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada notifikasi</h3>
            <p class="text-gray-600">Anda akan menerima notifikasi untuk aktivitas penting di sini</p>
        </div>
    @endif
</div>

<script>
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
