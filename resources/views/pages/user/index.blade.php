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
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Users</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ count($users) }}</h3>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-3 shadow-lg shadow-blue-500/30">
                    <i class="fa-solid fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-emerald-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Active Users</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ count($users->where('status', 1)) }}</h3>
                </div>
                <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-3 shadow-lg shadow-emerald-500/30">
                    <i class="fa-solid fa-user-check text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-rose-300 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Inactive Users</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ count($users->where('status', 0)) }}</h3>
                </div>
                <div class="bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl p-3 shadow-lg shadow-rose-500/30">
                    <i class="fa-solid fa-user-slash text-white text-xl"></i>
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
                    <a href="javascript:void(0)" onclick="openAddUserModal()" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Pengguna Baru</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm px-8 py-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Search Input --}}
                <div class="flex-1">
                    {{-- <form action="{{ route('users.index') }}" method="GET"> --}}
                    <form action="#" method="GET" class="w-full">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari user..." 
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Last Login</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $user->status === 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $user->status === 1 ? 'active' : 'inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{-- belum --}}
                                    {{ $user->last_login ? $user->last_login->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="p-2 bg-blue-50 hover:bg-blue-100 rounded-lg">
                                            <i class="fa-solid fa-pen text-blue-600"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 bg-red-50 hover:bg-red-100 rounded-lg">
                                                <i class="fa-solid fa-trash text-red-600"></i>
                                            </button>
                                        </form>
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

            {{-- <Pagination --}}
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        </div>
    </section>

    {{-- Modal Add User --}}
    <div id="addUserModal" class="{{ $errors->any() ? 'flex' : 'hidden' }} fixed inset-0 bg-black/40 backdrop-blur-sm z-50 items-center justify-center px-4">
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
                        placeholder="Masukkan username" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="Masukkan email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukkan password" required>

                        <button type="button"
                            onclick="togglePassword('password', 'eyePasswordIcon')"
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
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukkan password yang sama" required>

                        <button type="button"
                            onclick="togglePassword('password_confirmation', 'eyePasswordConfirmIcon')"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-500 hover:text-slate-700">
                            <i id="eyePasswordConfirmIcon" class="fa-regular fa-eye text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="closeAddUserModal()"
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
@endsection

@push('scripts')
    <script>
        document.getElementById('addUserModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeAddUserModal();
            }
        });

        function openAddUserModal() {
            const modal = document.getElementById('addUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAddUserModal() {
            const modal = document.getElementById('addUserModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
@endpush