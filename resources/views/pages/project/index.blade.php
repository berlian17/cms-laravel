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
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari portofolio..." 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                        >
                    </form>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Layanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe Industri</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($projects as $project)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $projects->firstItem() + $loop->index }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $project->title ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700">{{ ucfirst($project->service_name) ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700">{{ ucfirst($project->industrial_type) ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ ucfirst($project->client_name) ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700">{{ ucfirst($project->location) ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $project->status === 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $project->status === 1 ? 'active' : 'inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('projects.edit', $project->id) }}" class="p-2 bg-yellow-50 hover:bg-yellow-100 rounded-lg">
                                            <i class="fas fa-pen text-yellow-600"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                    Tidak ada data ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
@endsection
