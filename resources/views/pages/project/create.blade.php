@extends('layouts.app')

@section('title', 'Portfolio Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/project.css') }}">
@endpush

@section('content')
    @php
        $pageTitle = 'Tambah Portofolio Baru';
    @endphp

    <section>
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                        
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-briefcase text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Informasi Portofolio</h2>
                        <p class="text-sm text-slate-500">Pengaturan dasar portofolio Anda.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <input type="hidden" id="CKEditorFolder" value="project">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Gambar Cover <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col items-center">
                            <div id="coverPreview" class="w-full h-72 bg-blue-500/30 rounded-xl shadow-lg mb-4 p-6">
                                <div class="w-full h-full flex items-center justify-center border-2 border-dashed border-blue-300 rounded-xl">
                                    <div class="text-center">
                                        <i class="fas fa-image text-white text-3xl mb-2"></i>
                                        <p class="text-sm text-slate-500">Belum ada gambar dipilih</p>
                                    </div>
                                </div>
                            </div>

                            <label class="cursor-pointer inline-flex items-center space-x-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg transition-colors text-sm font-medium text-slate-700">
                                <i class="fas fa-cloud-arrow-up"></i>
                                <span>Pilih gambar cover</span>
                                <input id="coverInput" type="file" name="cover_img" class="hidden" accept="image/*" required>
                            </label>

                            <p id="coverFileName" class="text-xs text-slate-500 mt-2 italic"></p>
                            <p class="text-xs text-slate-500 mt-1">
                                PNG, JPG atau SVG (Max 2MB)
                            </p>
                        </div>
                        <x-input-error :messages="$errors->get('cover_img')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Judul Portofolio <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title"
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan judul" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Client <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="client_name"
                            value="{{ old('client_name') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan nama client" required>
                        <x-input-error :messages="$errors->get('client_name')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Layanan yang digunakan <span class="text-red-500">*</span>
                        </label>
                        <select name="service_name" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->title }}" {{ old('service_name') == $service->title ? 'selected' : '' }}>
                                    {{ $service->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('service_name')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tipe Industri <span class="text-red-500">*</span>
                        </label>
                        <select name="industrial_type" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            @foreach ($industrialTypes as $industrialType)
                                <option value="{{ $industrialType->name }}" {{ old('industrial_type') == $industrialType->name ? 'selected' : '' }}>
                                    {{ $industrialType->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('industrial_type')" class="mt-2" />
                    </div>
                    
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tanggal Mulai Proyek <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="completion_date"
                            value="{{ old('completion_date') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            required>
                        <x-input-error :messages="$errors->get('completion_date')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Durasi Proyek <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="duration"
                                value="{{ old('duration') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                                placeholder="Masukan durasi proyek" min="1" required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <span class="text-slate-500 font-medium text-sm">hari</span>
                            </div>
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Lokasi Proyek <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" name="location"
                            class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                            required>{{ old('location') }}</textarea>
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Deskripsi Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" name="description"
                            class="ckeditor">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- Gallery --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-images text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Dokumentasi Portofolio</h2>
                        <p class="text-sm text-slate-500">Upload gambar pendukung portofolio Anda.</p>
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <div id="galleryPreview" class="w-full h-72 bg-blue-500/30 rounded-xl shadow-lg mb-4 p-6">
                        <div class="w-full h-full flex items-center justify-center border-2 border-dashed border-blue-300 rounded-xl">
                            <div class="text-center">
                                <i class="fas fa-images text-white text-3xl mb-2"></i>
                                <p class="text-sm text-slate-500">Belum ada gambar dipilih</p>
                            </div>
                        </div>
                    </div>

                    <label class="cursor-pointer inline-flex items-center space-x-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg transition-colors text-sm font-medium text-slate-700">
                        <i class="fas fa-cloud-arrow-up"></i>
                        <span>Pilih Gambar</span>
                        <input id="galleryInput" type="file" name="gallery_images[]" class="hidden" accept="image/*" multiple>
                    </label>

                    <p id="galleryFileName" class="text-xs text-slate-500 mt-2 italic"></p>
                    <p class="text-xs text-slate-500 mt-1">
                        PNG, JPG atau SVG (Max 2MB per file) - Pilih multiple gambar
                    </p>
                </div>
                <x-input-error :messages="$errors->get('gallery_images')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/project.js') }}"></script>
@endpush
