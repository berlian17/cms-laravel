@extends('layouts.app')

@section('title', 'Media Management')

@section('content')
    @php
        $pageTitle = 'Tambah Media Baru';
    @endphp

    <section>
        <form action="{{ route('medias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                        
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl shrink-0 flex items-center justify-center shadow-lg">
                        <i class="fas fa-briefcase text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Informasi Media</h2>
                        <p class="text-sm text-slate-500">Pengaturan dasar media & berita Anda.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <input type="hidden" id="CKEditorFolder" value="media">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Gambar Cover <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col items-center">
                            <div id="coverPreview" class="w-full h-72 rounded-xl shadow-lg mb-4 p-6 {{ $errors->has('cover_img') ? 'bg-red-500/10 border-2 border-red-400' : 'bg-blue-500/30' }}">
                                <div class="w-full h-full flex items-center justify-center border-2 border-dashed rounded-xl {{ $errors->has('cover_img') ? 'border-red-400' : 'border-blue-300' }}">
                                    <div class="text-center">
                                        <i class="fas fa-image text-white text-3xl mb-2"></i>
                                        <p class="text-sm text-slate-500">Belum ada gambar dipilih</p>
                                    </div>
                                </div>
                            </div>

                            <label class="cursor-pointer inline-flex items-center space-x-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg transition-colors text-sm font-medium text-slate-700">
                                <i class="fas fa-cloud-arrow-up"></i>
                                <span>Pilih gambar cover</span>
                                <input id="coverInput" type="file" name="cover_img" class="hidden" accept="image/*">
                            </label>

                            <p id="coverFileName" class="text-xs text-slate-500 mt-2 italic"></p>
                            <p class="text-xs text-slate-500 mt-1">
                                PNG, JPG atau SVG (Max 2MB)
                            </p>
                        </div>
                        <x-input-error :messages="$errors->get('cover_img')" class="mt-2 text-center" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Judul Media & Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title"
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan judul" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            <option value="News" {{ old('category') == 'News' ? 'selected' : '' }}>News</option>
                            <option value="Events" {{ old('category') == 'Events' ? 'selected' : '' }}>Events</option>
                            <option value="Blogs" {{ old('category') == 'Blogs' ? 'selected' : '' }}>Blogs</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Deskripsi Singkat <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" id="excerpt" name="excerpt" maxlength="300"
                            class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                            required>{{ old('excerpt') }}</textarea>
                        <div class="flex justify-between mt-1 text-xs text-slate-500">
                            <span>Maksimal 300 karakter</span>
                            <span>
                                <span id="excerptCount">{{ strlen(old('excerpt', '')) }}</span>/300
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
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

            {{-- Tags --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6 relative">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl shrink-0 flex items-center justify-center shadow-lg">
                        <i class="fas fa-images text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Kata Kunci (Tags)</h2>
                        <p class="text-sm text-slate-500">Pilih atau ketik untuk menambahkan kata kunci baru.</p>
                    </div>
                </div>

                <select name="tags[]" multiple class="tom-select w-full">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', [])))>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('tags')" class="mt-2" />
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
    <script src="{{ asset('js/pages/media.js') }}"></script>
    <script>
        // Initialize
        setupCoverPreview('coverInput', 'coverFileName', 'coverPreview');
    </script>
@endpush
