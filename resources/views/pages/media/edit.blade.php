@extends('layouts.app')

@section('title', 'Media Management')

@section('content')
    @php
        $pageTitle = 'Edit Media';
    @endphp

    <section>
        <form action="{{ route('medias.update', $media->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        
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
                            <div id="coverPreview" class="h-72 {{ $media->cover_img ? '' : 'w-full bg-blue-500/30' }} rounded-xl flex items-center justify-center shadow-lg mb-4">
                                @if ($media->cover_img)
                                    <img src="{{ $media->cover_img }}" alt="cover-image" class="w-auto h-72 object-cover rounded-xl">
                                @else
                                    <i class="fas fa-image text-white text-3xl"></i>
                                @endif
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
                        <x-input-error :messages="$errors->get('cover_img')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Judul Media & Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title"
                            value="{{ old('title', $media->title) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan judul" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Author <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="author"
                            value="{{ old('author', $media->author) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan nama author" required>
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            <option value="News" {{ old('category', $media->category) == 'News' ? 'selected' : '' }}>News</option>
                            <option value="Events" {{ old('category', $media->category) == 'Events' ? 'selected' : '' }}>Events</option>
                            <option value="Blogs" {{ old('category', $media->category) == 'Blogs' ? 'selected' : '' }}>Blogs</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Deskripsi Singkat <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" id="excerpt" name="excerpt" maxlength="300"
                            class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                            required>{{ old('excerpt', $media->excerpt) }}</textarea>
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
                            class="ckeditor">{!! clean($media->description) !!}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Status Media & Berita <span class="text-red-500">*</span>
                        </label>
                        <select name="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="1" {{ old('status', $media->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $media->status) == 0 ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
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

                @if ($media->mediaTags->count() > 0)
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach ($media->mediaTags as $mediaTag)
                            <div class="flex items-center gap-2 bg-slate-100 border border-slate-200 text-slate-900 rounded-full px-3 py-1 text-sm">
                                <span>{{ $mediaTag->tag->name }}</span>

                                <button type="button" onclick="deleteTagModal('deleteTagModal', {{ $mediaTag->id }})"
                                    class="text-slate-900 hover:text-red-500"
                                >
                                    <i class="fas fa-xmark"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <select name="tags[]" multiple class="tom-select w-full">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', [])))>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('tags')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center space-x-2 text-sm text-slate-500">
                    <i class="fas fa-clock hidden sm:inline-block"></i>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-1">
                        <span>Terakhir diubah:</span>
                        <span class="font-semibold">
                            {{ $media->updated_at->locale('id')->diffForHumans() }}
                        </span>
                    </div>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-floppy-disk hidden sm:inline-block"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </section>

    {{-- Modal Delete Tag --}}
    <div id="deleteTagModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 items-center justify-center px-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-8 animate-scaleUp">
            <div class="flex items-start gap-4 mb-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-triangle-exclamation text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Hapus Tag</h2>
                    <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>
            <p class="text-slate-900 my-10">
                Yakin ingin menghapus tag ini?
            </p>
            <form id="deleteTagForm" action="#" method="POST" data-action="{{ url('/medias/tag') }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('deleteTagModal')"
                        class="items-center justify-center rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                        Batal
                    </button>

                    <button type="submit" class="bg-red-500 hover:bg-red-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center justify-center gap-2">
                        <i class="fas fa-trash"></i>
                        <span>Hapus</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/media.js') }}"></script>
    <script>
        // Initialize
        setupCoverPreview('coverInput', 'coverFileName', 'coverPreview');
        bindBackdropClose('deleteTagModal');
    </script>
@endpush
