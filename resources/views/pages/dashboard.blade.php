@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $pageTitle = 'Dashboard';
    @endphp

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 rounded-2xl shadow-xl p-8 mb-6 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali! 👋</h1>
                <p class="text-blue-100">Berikut adalah ringkasan aktivitas hari ini</p>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl px-6 py-4 text-center border border-white/30">
                    <i class="fa-solid fa-calendar-days text-4xl mb-2"></i>
                    <p class="text-sm font-medium">{{ date('l') }}</p>
                    <p class="text-3xl font-bold">{{ date('d') }}</p>
                    <p class="text-sm">{{ date('M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200 hover:shadow-md hover:border-blue-300 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Pengunjung</p>
                    <h3 class="text-3xl font-bold text-slate-900 mb-2">1,234</h3>
                    <div class="flex items-center text-sm">
                        <span class="text-emerald-600 font-semibold flex items-center bg-emerald-50 px-2 py-1 rounded-lg">
                            <i class="fa-solid fa-arrow-trend-up mr-1"></i> 12%
                        </span>
                        <span class="text-slate-500 ml-2">dari bulan lalu</span>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fa-solid fa-users text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200 hover:shadow-md hover:border-cyan-300 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Artikel</p>
                    <h3 class="text-3xl font-bold text-slate-900 mb-2">45</h3>
                    <div class="flex items-center text-sm">
                        <span class="text-cyan-600 font-semibold flex items-center bg-cyan-50 px-2 py-1 rounded-lg">
                            <i class="fa-solid fa-plus mr-1"></i> 5 baru
                        </span>
                        <span class="text-slate-500 ml-2">minggu ini</span>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl p-3 shadow-lg shadow-cyan-500/30">
                    <i class="fa-solid fa-file-lines text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200 hover:shadow-md hover:border-blue-300 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500 mb-1">Produk/Layanan</p>
                    <h3 class="text-3xl font-bold text-slate-900 mb-2">28</h3>
                    <div class="flex items-center text-sm">
                        <span class="text-blue-600 font-semibold flex items-center bg-blue-50 px-2 py-1 rounded-lg">
                            <i class="fa-solid fa-plus mr-1"></i> 3 baru
                        </span>
                        <span class="text-slate-500 ml-2">ditambahkan</span>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fa-solid fa-cube text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200 hover:shadow-md hover:border-cyan-300 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500 mb-1">Form Submissions</p>
                    <h3 class="text-3xl font-bold text-slate-900 mb-2">156</h3>
                    <div class="flex items-center text-sm">
                        <span class="text-cyan-600 font-semibold flex items-center bg-cyan-50 px-2 py-1 rounded-lg">
                            <i class="fa-solid fa-bell mr-1"></i> 12 baru
                        </span>
                        <span class="text-slate-500 ml-2">hari ini</span>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-cyan-600 to-blue-600 rounded-xl p-3 shadow-lg shadow-cyan-500/30">
                    <i class="fa-solid fa-envelope text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-slate-900">Quick Actions</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <button class="group bg-white hover:bg-gradient-to-br hover:from-blue-500 hover:to-cyan-500 border-2 border-slate-200 hover:border-transparent rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/30 hover:-translate-y-1">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-slate-100 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <i class="fa-solid fa-pen-to-square text-slate-600 group-hover:text-white text-2xl transition-colors"></i>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-white transition-colors">Buat Artikel Baru</span>
                </div>
            </button>

            <button class="group bg-white hover:bg-gradient-to-br hover:from-cyan-500 hover:to-blue-500 border-2 border-slate-200 hover:border-transparent rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/30 hover:-translate-y-1">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-slate-100 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <i class="fa-solid fa-box-open text-slate-600 group-hover:text-white text-2xl transition-colors"></i>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-white transition-colors">Tambah Produk</span>
                </div>
            </button>

            <button class="group bg-white hover:bg-gradient-to-br hover:from-blue-600 hover:to-cyan-600 border-2 border-slate-200 hover:border-transparent rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/30 hover:-translate-y-1">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-slate-100 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <i class="fa-solid fa-cloud-arrow-up text-slate-600 group-hover:text-white text-2xl transition-colors"></i>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-white transition-colors">Upload Media</span>
                </div>
            </button>

            <button class="group bg-white hover:bg-gradient-to-br hover:from-cyan-600 hover:to-blue-600 border-2 border-slate-200 hover:border-transparent rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/30 hover:-translate-y-1">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-slate-100 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <i class="fa-solid fa-briefcase text-slate-600 group-hover:text-white text-2xl transition-colors"></i>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-white transition-colors">Tambah Portfolio</span>
                </div>
            </button>
        </div>
    </div>

    <!-- Charts & Activities Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Website Traffic Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Statistik Traffic Website</h2>
                        <p class="text-sm text-slate-500 mt-1">Performa pengunjung 7 hari terakhir</p>
                    </div>
                    <select class="text-sm border border-slate-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-50 font-medium text-slate-700">
                        <option>7 Hari</option>
                        <option>30 Hari</option>
                        <option>90 Hari</option>
                    </select>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-5">
                    <div>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-900">Aktivitas Terbaru</h2>
                <p class="text-sm text-slate-500 mt-1">Update sistem terkini</p>
            </div>
            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-2 flex-shrink-0 shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-plus text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">Artikel baru ditambahkan</p>
                        <p class="text-xs text-slate-500 mt-1">Tips Memilih Produk Terbaik</p>
                        <p class="text-xs text-slate-400 mt-1">2 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl p-2 flex-shrink-0 shadow-lg shadow-cyan-500/30">
                        <i class="fa-solid fa-check text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">Produk berhasil diperbarui</p>
                        <p class="text-xs text-slate-500 mt-1">Laptop Gaming XYZ</p>
                        <p class="text-xs text-slate-400 mt-1">4 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl p-2 flex-shrink-0 shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-image text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">Media baru di-upload</p>
                        <p class="text-xs text-slate-500 mt-1">15 gambar ditambahkan</p>
                        <p class="text-xs text-slate-400 mt-1">5 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="bg-gradient-to-br from-cyan-600 to-blue-600 rounded-xl p-2 flex-shrink-0 shadow-lg shadow-cyan-500/30">
                        <i class="fa-solid fa-envelope text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">Pesan baru diterima</p>
                        <p class="text-xs text-slate-500 mt-1">Form kontak dari John Doe</p>
                        <p class="text-xs text-slate-400 mt-1">6 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl p-2 flex-shrink-0 shadow-lg shadow-slate-500/30">
                        <i class="fa-solid fa-trash text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">Artikel dihapus</p>
                        <p class="text-xs text-slate-500 mt-1">Draft Test telah dihapus</p>
                        <p class="text-xs text-slate-400 mt-1">1 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Popular Articles -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Artikel Terpopuler</h2>
                        <p class="text-sm text-slate-500 mt-1">Berdasarkan views</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-2 shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-fire text-white"></i>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-blue-500/30">
                        1
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Cara Meningkatkan SEO Website</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-eye mr-1"></i>
                            <span>1,234 views</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-cyan-500/30">
                        2
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Tutorial Laravel untuk Pemula</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-eye mr-1"></i>
                            <span>987 views</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-blue-500/30">
                        3
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Tips Desain UI/UX Modern</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-eye mr-1"></i>
                            <span>856 views</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-600 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-cyan-500/30">
                        4
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Optimasi Performa Website</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-eye mr-1"></i>
                            <span>745 views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Produk Terlaris</h2>
                        <p class="text-sm text-slate-500 mt-1">Top selling bulan ini</p>
                    </div>
                    <div class="bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl p-2 shadow-lg shadow-cyan-500/30">
                        <i class="fa-solid fa-trophy text-white"></i>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-laptop text-blue-600 text-xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Laptop Gaming Pro</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-shopping-cart mr-1"></i>
                            <span>45 terjual</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-mobile-screen text-cyan-600 text-xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Smartphone X Series</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-shopping-cart mr-1"></i>
                            <span>38 terjual</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-headphones text-blue-600 text-xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Wireless Headphone</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-shopping-cart mr-1"></i>
                            <span>32 terjual</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-camera text-cyan-600 text-xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">Mirrorless Camera</p>
                        <div class="flex items-center mt-1 text-xs text-slate-500">
                            <i class="fa-solid fa-shopping-cart mr-1"></i>
                            <span>28 terjual</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Status Sistem</h2>
                        <p class="text-sm text-slate-500 mt-1">Monitoring real-time</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl p-2 shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-server text-white"></i>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-slate-700">Server Status</span>
                    </div>
                    <span class="text-sm font-bold text-emerald-600">Online</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-slate-700">Database</span>
                    </div>
                    <span class="text-sm font-bold text-emerald-600">Connected</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-amber-50 border border-amber-200 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-slate-700">Storage Usage</span>
                    </div>
                    <span class="text-sm font-bold text-amber-600">68%</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-slate-700">Backup Status</span>
                    </div>
                    <span class="text-sm font-bold text-emerald-600">Up to date</span>
                </div>

                <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-xl">
                    <div class="flex items-start space-x-3">
                        <i class="fa-solid fa-clock text-blue-600 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Maintenance Schedule</p>
                            <p class="text-xs text-slate-600 mt-1">Next: Sunday, 2:00 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Form Submissions -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Pesan Masuk Terbaru</h2>
                <p class="text-sm text-slate-500 mt-1">Form submissions dari website</p>
            </div>
            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center group">
                Lihat Semua 
                <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Pengirim</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Subjek</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-blue-500/30">
                                    JD
                                </div>
                                <span class="ml-3 text-sm font-semibold text-slate-900">John Doe</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">john@example.com</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">Pertanyaan Produk</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">2 jam lalu</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-amber-100 text-amber-700 border border-amber-200">
                                <i class="fa-solid fa-clock mr-1.5"></i> Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="text-emerald-600 hover:text-emerald-800 p-2 hover:bg-emerald-50 rounded-lg transition-colors" title="Tandai Selesai">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="text-rose-600 hover:text-rose-800 p-2 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-cyan-500/30">
                                    JS
                                </div>
                                <span class="ml-3 text-sm font-semibold text-slate-900">Jane Smith</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">jane@example.com</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">Request Demo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">5 jam lalu</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                                <i class="fa-solid fa-check mr-1.5"></i> Selesai
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="text-emerald-600 hover:text-emerald-800 p-2 hover:bg-emerald-50 rounded-lg transition-colors" title="Tandai Selesai">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="text-rose-600 hover:text-rose-800 p-2 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-blue-500/30">
                                    RJ
                                </div>
                                <span class="ml-3 text-sm font-semibold text-slate-900">Robert Johnson</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">robert@example.com</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">Komplain Layanan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">1 hari lalu</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-rose-100 text-rose-700 border border-rose-200">
                                <i class="fa-solid fa-exclamation mr-1.5"></i> Urgent
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="text-emerald-600 hover:text-emerald-800 p-2 hover:bg-emerald-50 rounded-lg transition-colors" title="Tandai Selesai">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="text-rose-600 hover:text-rose-800 p-2 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
