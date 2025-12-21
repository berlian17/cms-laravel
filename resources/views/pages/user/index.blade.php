@extends('layouts.app')

@section('title', 'Users Management')

@section('content')
    @php
        $pageTitle = 'Users Management';
    @endphp

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
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

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-emerald-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Pengguna Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalActiveUsers }}</h3>
                </div>
                <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-3 shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-user-check text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-rose-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Pengguna Non Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $totalInactiveUsers }}</h3>
                </div>
                <div class="bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl p-3 shadow-lg shadow-rose-500/30">
                    <i class="fas fa-user-slash text-white text-xl"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Daftar Pengguna</h2>
                    <p class="text-sm text-slate-500 mt-1">Kelola dan pantau semua pengguna sistem Anda.</p>
                </div>
                <div class="flex gap-2">
                    <button
                        type="button"
                        class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2"
                        onclick="openModal('addModal', null)"
                    >
                        <i class="fas fa-plus"></i>
                        <span>Tambah Pengguna Baru</span>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm px-8 py-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Search Input --}}
                <div class="flex-1">
                    <input 
                        type="text" 
                        id="searchInput"
                        data-url="{{ route('users.index') }}"
                        placeholder="Cari pengguna..." 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                    >
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
                @include('pages.user.partials.table')
            </div>
        </div>
    </section>

    {{-- Modal Add User --}}
    <div id="addModal" class="{{ $errors->any() ? 'flex' : 'hidden' }} fixed inset-0 bg-black/40 backdrop-blur-sm z-50 items-center justify-center px-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 animate-scaleUp">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Tambah Pengguna Baru</h2>

            <form class="space-y-6" action="{{ route('users.store') }}" method="POST">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="Masukan username" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="Masukan email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="password-input w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan password" required>

                        <button type="button"
                            onclick="togglePassword(this)"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-500 hover:text-slate-700">
                            <i id="eyePasswordIcon" class="fa-regular fa-eye text-lg"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation"
                            class="password-input w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan password yang sama" required>

                        <button type="button"
                            onclick="togglePassword(this)"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-500 hover:text-slate-700">
                            <i id="eyePasswordConfirmIcon" class="fa-regular fa-eye text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="closeModal('addModal')"
                        class="bg-red-500 hover:bg-red-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        Batal
                    </button>
                    
                    <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-floppy-disk"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div id="editModal" class="{{ $errors->any() ? 'flex' : 'hidden' }} fixed inset-0 bg-black/40 backdrop-blur-sm z-50 items-center justify-center px-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 animate-scaleUp">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Edit Data Pengguna</h2>

            <form id="editForm" class="space-y-6" action="#" method="POST" data-action="{{ url('/users') }}">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_name"
                        name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="Masukan username" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="edit_email"
                        name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="Masukan email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="password-input w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan password">

                        <button type="button"
                            onclick="togglePassword(this)"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-500 hover:text-slate-700">
                            <i id="eyePasswordIcon" class="fa-regular fa-eye text-lg"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation"
                            class="password-input w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan password yang sama">

                        <button type="button"
                            onclick="togglePassword(this)"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-500 hover:text-slate-700">
                            <i id="eyePasswordConfirmIcon" class="fa-regular fa-eye text-lg"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="edit_status" name="status"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900">
                        <option value="1">Aktif</option>
                        <option value="0">Non Aktif</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="closeModal('editModal')"
                        class="bg-red-500 hover:bg-red-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        Batal
                    </button>

                    <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/user.js') }}"></script>
    <script>
        // Initialize
        bindBackdropClose('addModal');
        bindBackdropClose('editModal');
    </script>
@endpush
