@extends('layouts.app')

@section('title', 'Portfolio Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/project.css') }}">
@endpush

@section('content')
    @php
        $pageTitle = 'Edit Portfolio';
    @endphp

    <section>
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        
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
                            <div id="coverPreview" class="h-72 {{ $project->cover_img ? '' : 'w-full bg-blue-500/30' }} rounded-xl flex items-center justify-center shadow-lg mb-4">
                                @if ($project->cover_img)
                                    <img src="{{ $project->cover_img }}" alt="cover-image" class="w-auto h-72 object-cover rounded-xl">
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

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Judul Portofolio <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title"
                            value="{{ old('title', $project->title) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="Masukan judul portofolio" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Client <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="client_name"
                            value="{{ old('client_name', $project->client_name) }}"
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
                                <option value="{{ $service->title }}" {{ old('service_name', $project->service_name) == $service->title ? 'selected' : '' }}>
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
                                <option value="{{ $industrialType->name }}" {{ old('industrial_type', $project->industrial_type) == $industrialType->name ? 'selected' : '' }}>
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
                            value="{{ old('completion_date', $project->completion_date) }}"
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
                                value="{{ old('duration', $project->duration) }}"
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
                            required>{{ old('location', $project->location) }}</textarea>
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Deskripsi Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" name="description"
                            class="ckeditor">{!! clean($project->description) !!}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Status Portofolio <span class="text-red-500">*</span>
                        </label>
                        <select name="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="1" {{ old('status', $project->status) === 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $project->status) === 0 ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                
                @if ($project->galleries->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                        @foreach ($project->galleries as $gallery)
                            <div class="md:col-span-1">
                                <div class="relative h-72 rounded-xl shadow-lg bg-white overflow-visible group">
                                    <img src="{{ env('APP_URL') . $gallery->image }}" alt="gallery-img" class="w-full h-full object-cover rounded-xl" />

                                    <button type="button" onclick="deleteGalleryModal('deleteGalleryModal', {{ $gallery->id }})"
                                        class="btn-delete-preview absolute bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 z-50"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

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

            <div class="flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center space-x-2 text-sm text-slate-500">
                    <i class="fas fa-clock hidden sm:inline-block"></i>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-1">
                        <span>Terakhir diubah:</span>
                        <span class="font-semibold">
                            {{ $project->updated_at->locale('id')->diffForHumans() }}
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

    {{-- Modal Delete Gallery --}}
    <div id="deleteGalleryModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 items-center justify-center px-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-8 animate-scaleUp">
            <div class="flex items-start gap-4 mb-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-triangle-exclamation text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Hapus Gambar</h2>
                    <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>
            <p class="text-slate-900 my-10">
                Yakin ingin menghapus gambar ini dari dokumentasi portofolio?
            </p>
            <form id="deleteGalleryForm" action="#" method="POST" data-action="{{ url('/projects/gallery') }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('deleteGalleryModal')"
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
    <script src="{{ asset('js/pages/project.js') }}"></script>
    <script>
        // Initialize
        setupCoverPreview('coverInput', 'coverFileName', 'coverPreview');
        setupMultipleImagePreview('galleryInput', 'galleryFileName', 'galleryPreview');
        bindBackdropClose('deleteGalleryModal');
    </script>
@endpush
