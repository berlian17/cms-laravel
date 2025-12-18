@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    @php
        $pageTitle = 'Pengaturan';
    @endphp

    <section>
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Website Setting --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-globe text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Informasi Website</h2>
                        <p class="text-sm text-slate-500">Pengaturan dasar website Anda.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Website <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="app_name"
                            value="{{ old('app_name', $settings->app_name) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan nama website" required>
                        <x-input-error :messages="$errors->get('app_name')" class="mt-2" />
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tagline
                        </label>
                        <input type="text" name="tagline"
                            value="{{ old('tagline', $settings->tagline) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan tagline website" required>
                        <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                    </div>
                    <div class="md:col-span-1">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Logo 1 <span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col items-center">
                                <div id="logo1Preview" class="{{ $settings->logo1 ? 'w-auto' : 'w-28' }} h-28 bg-blue-500/30 rounded-xl flex items-center justify-center shadow-lg mb-4 overflow-hidden">
                                    @if ($settings->logo1)
                                        <img src="{{ $settings->logo1 }}" alt="logo-1" class="w-full h-full object-contain">
                                    @else
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    @endif
                                </div>

                                <label class="cursor-pointer inline-flex items-center space-x-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg transition-colors text-sm font-medium text-slate-700">
                                    <i class="fas fa-cloud-arrow-up"></i>
                                    <span>Pilih Logo 1</span>
                                    <input id="logo1Input" type="file" name="logo1" class="hidden" accept="image/*">
                                </label>

                                <p id="logo1FileName" class="text-xs text-slate-500 mt-2 italic"></p>
                                <p class="text-xs text-slate-500 mt-1">
                                    PNG, JPG atau SVG (Max 2MB)
                                </p>
                            </div>
                            <x-input-error :messages="$errors->get('logo1')" class="mt-2" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Logo 2 <span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col items-center">
                                <div id="logo2Preview" class="{{ $settings->logo2 ? 'w-auto' : 'w-28' }} h-28 bg-blue-500/30 rounded-xl flex items-center justify-center shadow-lg mb-4 overflow-hidden">
                                    @if ($settings->logo2)
                                        <img src="{{ $settings->logo2 }}" alt="logo-2" class="w-full h-full object-contain">
                                    @else
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    @endif
                                </div>

                                <label class="cursor-pointer inline-flex items-center space-x-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg transition-colors text-sm font-medium text-slate-700">
                                    <i class="fas fa-cloud-arrow-up"></i>
                                    <span>Pilih Logo 2</span>
                                    <input id="logo2Input" type="file" name="logo2" class="hidden" accept="image/*">
                                </label>

                                <p id="logo2FileName" class="text-xs text-slate-500 mt-2 italic"></p>
                                <p class="text-xs text-slate-500 mt-1">
                                    PNG, JPG atau SVG (Max 2MB)
                                </p>
                            </div>
                            <x-input-error :messages="$errors->get('logo2')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Setting --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-address-book text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Informasi Kontak</h2>
                        <p class="text-sm text-slate-500">Informasi untuk dihubungi pelanggan.</p>
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
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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
                            <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
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
                            <x-input-error :messages="$errors->get('fax')" class="mt-2" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" name="address"
                            class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                            required>{{ old('address', $settings->address) }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-share-nodes text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Social Media</h2>
                        <p class="text-sm text-slate-500">Link ke akun social media perusahaan.</p>
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
                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook
                        </label>
                        <input type="url" name="facebook"
                            value="{{ old('facebook', $settings->facebook) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="https://facebook.com/username">
                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fa-brands fa-instagram text-pink-600 mr-1"></i> Instagram
                        </label>
                        <input type="url" name="instagram"
                            value="{{ old('instagram', $settings->instagram) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="https://instagram.com/username">
                        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fa-brands fa-x text-sky-500 mr-1"></i> Twitter
                        </label>
                        <input type="url" name="twitter"
                            value="{{ old('twitter', $settings->twitter) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="https://twitter.com/username">
                        <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center space-x-2 text-sm text-slate-500">
                    <i class="fas fa-clock"></i>
                    <span>Terakhir diubah: {{ $settings->updated_at->locale('id')->diffForHumans() }}</span>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-floppy-disk"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush
