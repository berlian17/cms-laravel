@extends('layouts.app')

@section('title', 'Portfolio Management')

@section('content')
    @php
        $pageTitle = 'Portofolio';
    @endphp

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
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

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-emerald-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Portofolio Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalActiveProjects }}</h3>
                </div>
                <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-3 shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-rose-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Portofolio Non Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalInactiveProjects }}</h3>
                </div>
                <div class="bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl p-3 shadow-lg shadow-rose-500/30">
                    <i class="fas fa-ban text-white text-xl"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Daftar Portofolio</h2>
                    <p class="text-sm text-slate-500 mt-1">Kelola portofolio yang Anda miliki.</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('projects.create') }}" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Portofolio Baru</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm px-8 py-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Search Input --}}
                <div class="flex-1">
                    <form action="{{ route('projects.index') }}" method="GET" class="w-full">
                        <input 
                            type="text" 
                            id="searchInput"
                            data-url="{{ route('projects.index') }}"
                            placeholder="Cari portofolio..." 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                        >
                    </form>
                </div>
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
                @include('pages.project.partials.table')
            </div>
        </div>
    </section>
@endsection
