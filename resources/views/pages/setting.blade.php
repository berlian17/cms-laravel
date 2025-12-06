@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    @php
        $pageTitle = 'Pengaturan';
    @endphp

    <form id="settings-form" class="space-y-6" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Website Setting --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-globe text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Informasi Website</h2>
                    <p class="text-sm text-slate-500">Pengaturan dasar website Anda</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Website <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="app_name"
                            value="{{ old('app_name', $settings->app_name) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukkan nama website" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tagline
                        </label>
                        <input type="text" name="tagline"
                            value="{{ old('tagline', $settings->tagline) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukkan tagline website" required>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-auto h-28 bg-blue-500/30 rounded-xl flex items-center justify-center shadow-lg mb-4">
                        @if ($settings->logo)
                            <img src="{{ asset('/logo/' . $settings->logo) }}" alt="logo" class="w-full h-auto">
                        @else
                            <i class="fa-solid fa-image text-white text-3xl"></i>
                        @endif
                    </div>

                    <label class="cursor-pointer inline-flex items-center space-x-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg transition-colors text-sm font-medium text-slate-700">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>Pilih Logo</span>
                        <input id="logoInput" type="file" name="logo" class="hidden" accept="image/*">
                    </label>

                    <p id="fileName" class="text-xs text-slate-500 mt-2 italic"></p>

                    <p class="text-xs text-slate-500 mt-1">
                        PNG, JPG atau SVG (Max 2MB)
                    </p>
                </div>
            </div>
        </div>

        {{-- Contact Setting --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-address-book text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Informasi Kontak</h2>
                    <p class="text-sm text-slate-500">Informasi untuk dihubungi pelanggan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email Kontak <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-envelope text-slate-400"></i>
                        </div>
                        <input type="email" name="email"
                            value="{{ old('email', $settings->email) }}"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Telepon
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-phone text-slate-400"></i>
                        </div>
                        <input type="text" name="phone" 
                            value="{{ old('phone', $settings->phone) }}"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="xxxx xxxx xxxx">
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        WhatsApp
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fa-brands fa-whatsapp text-slate-400"></i>
                        </div>
                        <input type="text" name="whatsapp"
                            value="{{ old('whatsapp', $settings->whatsapp) }}"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="xxxx xxxx xxxx">
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Fax
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-fax text-slate-400"></i>
                        </div>
                        <input type="text" name="fax"
                            value="{{ old('fax', $settings->fax) }}"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="xxxx xxxx">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea rows="3" name="address"
                        class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                        required>{{ old('address', $settings->address) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Company Setting --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-building text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Informasi Perusahaan</h2>
                    <p class="text-sm text-slate-500">Informasi perusahaan Anda</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="company_name"
                        value="{{ old('company_name', $settings->company_name) }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="Masukkan nama perusahaan" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea rows="2" name="short_desc"
                        class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                        required>{{ old('short_desc', $settings->short_desc) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Deskripsi Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea rows="10" name="long_desc"
                        class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                        required>{{ old('long_desc', $settings->long_desc) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Social Media --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-share-nodes text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Social Media</h2>
                    <p class="text-sm text-slate-500">Link ke akun social media perusahaan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fa-brands fa-linkedin text-blue-700 mr-1"></i> LinkedIn
                    </label>
                    <input type="url" name="linkedin"
                        value="{{ old('linkedin', $settings->linkedin) }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="https://linkedin.com/company/username">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook
                    </label>
                    <input type="url" name="facebook"
                        value="{{ old('facebook', $settings->facebook) }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="https://facebook.com/username">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fa-brands fa-instagram text-pink-600 mr-1"></i> Instagram
                    </label>
                    <input type="url" name="instagram"
                        value="{{ old('instagram', $settings->instagram) }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="https://instagram.com/username">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fa-brands fa-x text-sky-500 mr-1"></i> Twitter
                    </label>
                    <input type="url" name="twitter"
                        value="{{ old('twitter', $settings->twitter) }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                        placeholder="https://twitter.com/username">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center space-x-2 text-sm text-slate-500">
                <i class="fa-solid fa-clock"></i>
                <span>Terakhir diubah: {{ $settings->updated_at->locale('id')->diffForHumans() }}</span>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush
