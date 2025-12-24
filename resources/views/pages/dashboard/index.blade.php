@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $pageTitle = 'Dashboard';
    @endphp

    <section class="bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 rounded-2xl shadow-xl p-8 mb-6 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali!</h1>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl px-6 py-4 text-center border border-white/30">
                    <i class="fa-solid fa-calendar-days text-4xl mb-2"></i>
                    <p class="text-sm font-medium text-slate-900">{{ date('l') }}</p>
                    <p class="text-3xl font-bold text-slate-900">{{ date('d') }}</p>
                    <p class="text-sm text-slate-900">{{ date('M Y') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-blue-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Media & Berita</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalMedias }}</h3>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-newspaper text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-blue-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Layanan</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalServices }}</h3>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-cube text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-blue-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Portofolio</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalProjects }}</h3>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-briefcase text-white text-xl"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-blue-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Pengunjung</p>
                    <h3 class="text-3xl font-bold text-slate-900">0</h3>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-users-line text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-blue-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Pengguna</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalUsers }}</h3>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-8 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Statistik Traffic Website</h2>
                        <p class="text-sm text-slate-500 mt-1">Performa pengunjung 1 bulan terakhir</p>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="space-y-5">
                    {{-- <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700">Senin</span>
                            <span class="text-sm font-bold text-slate-900">245 pengunjung</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full shadow-sm" style="width: 85%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700">Selasa</span>
                            <span class="text-sm font-bold text-slate-900">198 pengunjung</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full shadow-sm" style="width: 68%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700">Rabu</span>
                            <span class="text-sm font-bold text-slate-900">312 pengunjung</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-3 rounded-full shadow-sm" style="width: 100%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700">Kamis</span>
                            <span class="text-sm font-bold text-slate-900">276 pengunjung</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full shadow-sm" style="width: 90%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700">Jumat</span>
                            <span class="text-sm font-bold text-slate-900">203 pengunjung</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full shadow-sm" style="width: 70%"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="p-8 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Pesan Masuk Terbaru</h2>
                <p class="text-sm text-slate-500 mt-1">Form submissions dari website</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden relative">
            <div id="loadingOverlay" class="hidden absolute inset-0 bg-white/90 flex items-center justify-center z-50">
                <div class="flex flex-col items-center gap-3">
                    <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm text-gray-600 font-medium">Memuat data...</span>
                </div>
            </div>

            <div id="tableWrapper" class="overflow-x-auto">
                @include('pages.dashboard.partials.table')
            </div>
        </div>
    </section>
@endsection
