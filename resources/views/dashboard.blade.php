@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Overview & Statistik')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-green-50 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-teal-50 rounded-full blur-3xl opacity-50"></div>
        
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-gray-500 mt-1">
                    {{ auth()->user()->role->display_name ?? 'User' }} 
                    @if(auth()->user()->unit)
                        <span class="mx-2">•</span> {{ auth()->user()->unit->name }}
                    @endif
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @if(auth()->user()->isUser())
             <!-- USER STATISTICS -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total SOP Saya</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $mySopsStats['total'] ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gray-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Draft</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $mySopsStats['draft'] ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Validasi</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $mySopsStats['pending'] ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Disetujui</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $mySopsStats['approved'] ?? 0 }}</h3>
                </div>
            </div>

        @elseif(auth()->user()->isValidator())
            <!-- VALIDATOR STATISTICS -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Divalidasi</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $validationStats['validated'] ?? 0 }}</h3>
                </div>
            </div>

             <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    @if(($validationStats['pending'] ?? 0) > 0)
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Validasi</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $validationStats['pending'] ?? 0 }}</h3>
                </div>
            </div>
             
             <!-- Filler stats for Validator -->
             <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                         <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total SOP Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['active_sops'] }}</h3>
                </div>
            </div>

        @else
            <!-- ADMIN STATISTICS -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total SOP</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_sops'] }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-teal-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Unit Kerja</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_units'] ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengguna Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['active_users'] }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    @if($stats['pending_validations'] > 0)
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Validasi</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['pending_validations'] }}</h3>
                </div>
            </div>
        @endif
    </div>

    @if(isset($chartData) && (auth()->user()->isSuperAdmin() || auth()->user()->isValidator()))
    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Status SOP</h3>
            <canvas id="sopStatusChart"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">SOP per Unit (Top 5)</h3>
            <canvas id="unitSopsChart"></canvas>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SOP Status Chart
            const sopStatusCtx = document.getElementById('sopStatusChart').getContext('2d');
            new Chart(sopStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartData['sopStatus']['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($chartData['sopStatus']['data']) !!},
                        backgroundColor: ['#f3f4f6', '#fcd34d', '#10b981', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Unit SOPs Chart
            const unitSopsCtx = document.getElementById('unitSopsChart').getContext('2d');
            new Chart(unitSopsCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartData['unitSops']['labels']) !!},
                    datasets: [{
                        label: 'Total SOP',
                        data: {!! json_encode($chartData['unitSops']['data']) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
    @endpush
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content Column -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Top Units (Admin/Validator Only) -->
            @if(auth()->user()->isSuperAdmin() || auth()->user()->isValidator())
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Unit Kerja Teraktif</h3>
                    <span class="text-xs font-medium text-gray-500 bg-white border border-gray-200 px-2 py-1 rounded-md">Top 5</span>
                </div>
                <div class="p-0">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Nama Unit</th>
                                <th class="px-6 py-3 text-center">Total SOP</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($topUnits as $unit)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-3 font-medium text-gray-900">{{ $unit->name }}</td>
                                <td class="px-6 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $unit->sops_count }} SOP
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <a href="#" class="text-green-600 hover:text-green-800 font-medium text-xs">Lihat Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data unit.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Recent SOPs List (Grid View) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-xl">
                    <h3 class="text-lg font-bold text-gray-900">SOP Terbaru</h3>
                    <a href="{{ route('sops.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700 hover:underline">
                        Lihat Semua
                    </a>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($recentSops as $sop)
                        <div class="relative group bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md hover:border-green-200 transition-all cursor-pointer overflow-hidden" onclick="window.location='{{ route('sops.show', $sop) }}'">
                            <!-- Decorative Circle -->
                            <div class="absolute top-0 right-0 w-16 h-16 bg-gray-50 rounded-bl-full -mr-8 -mt-8 transition-colors group-hover:bg-green-50"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center border border-green-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    @php
                                        $statusColors = [
                                            'active' => 'bg-green-100 text-green-700',
                                            'pending_validation' => 'bg-amber-100 text-amber-700',
                                            'draft' => 'bg-gray-100 text-gray-700',
                                            'rejected' => 'bg-red-100 text-red-700'
                                        ];
                                        $statusClass = $statusColors[$sop->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md {{ $statusClass }}">
                                        {{ str_replace('_', ' ', $sop->status) }}
                                    </span>
                                </div>
                                
                                <h4 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors line-clamp-1 mb-1" title="{{ $sop->title }}">
                                    {{ $sop->title }}
                                </h4>
                                
                                <div class="flex items-center text-xs text-gray-500 gap-2 mt-2">
                                    <span class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded text-gray-600">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ $sop->unit->name }}
                                    </span>
                                    <span class="text-gray-400">{{ $sop->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                             <div class="mx-auto w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-900">Belum ada SOP</p>
                            <a href="{{ route('sops.create') }}" class="text-xs text-green-600 hover:text-green-700 font-medium hover:underline mt-1 block">Buat SOP Baru &rarr;</a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

             <!-- Quick Actions -->
             <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 px-1">Aksi Cepat</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('sops.create') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-green-200 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-green-100 transition-colors">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-green-700">Buat SOP</span>
                    </a>

                    <a href="{{ route('sops.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-100 transition-colors">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-700">Daftar SOP</span>
                    </a>

                    @if(auth()->user()->isValidator() || auth()->user()->isSuperAdmin())
                        <a href="{{ route('validations.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-amber-200 hover:-translate-y-1 transition-all duration-300 group">
                            <div class="w-12 h-12 bg-amber-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-amber-100 transition-colors">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-amber-700">Validasi</span>
                        </a>
                    @endif

                    <a href="#" class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-purple-200 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-100 transition-colors">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-purple-700">Laporan</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar / Right Column -->
        <div class="space-y-6">
            <!-- Pending Validations (Validator View) -->
            @if((auth()->user()->isValidator() || auth()->user()->isSuperAdmin()) && $pendingValidations->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-amber-50/50">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Perlu Validasi</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($pendingValidations->take(5) as $validation)
                        <div class="p-4 hover:bg-amber-50/30 transition-colors group cursor-pointer" onclick="window.location='{{ route('sops.show', $validation->sop) }}'">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 group-hover:text-amber-700 transition-colors">
                                        {{ $validation->sop->title }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Oleh: {{ $validation->sop->creator->name }}
                                    </p>
                                    <p class="text-xs text-amber-600 mt-1 font-medium">
                                        {{ $validation->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <a href="{{ route('validations.index') }}" class="block p-3 text-center text-xs font-semibold text-amber-600 hover:text-amber-700 hover:bg-amber-50 transition-colors">
                            Lihat Semua Validasi
                        </a>
                    </div>
                </div>
            @endif

            <!-- Recent Activity Log -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                 <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Aktivitas</h3>
                </div>
                <div class="p-4">
                    @if($recentActivities->count() > 0)
                        <div class="relative pl-4 border-l-2 border-gray-100 space-y-6 my-2">
                            @foreach($recentActivities->take(6) as $activity)
                            <div class="relative">
                                <div class="absolute -left-[21px] top-1 h-3 w-3 rounded-full bg-gray-200 border-2 border-white"></div>
                                <div class="text-sm text-gray-900">
                                    <span class="font-semibold">{{ $activity->user->name }}</span>
                                    <span class="text-gray-600">{{ $activity->description }}</span>
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-sm text-gray-500">Belum ada aktivitas.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
