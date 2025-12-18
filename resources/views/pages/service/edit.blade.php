@extends('layouts.app')

@section('title', 'Service Management')

@section('content')
    @php
        $pageTitle = 'Edit Layanan';
    @endphp

    <section>
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-cube text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Informasi Layanan</h2>
                        <p class="text-sm text-slate-500">Pengaturan dasar layanan Anda.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <input type="hidden" id="CKEditorFolder" value="service">

                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Layanan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title"
                                value="{{ old('title', $service->title) }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                                placeholder="Masukan nama layanan" required>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Deskripsi Singkat <span class="text-red-500">*</span>
                            </label>
                            <textarea rows="3" name="short_desc"
                                class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 resize-none"
                                required>{{ old('short_desc', $service->short_desc) }}</textarea>
                            <x-input-error :messages="$errors->get('short_desc')" class="mt-2" />
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        <div class="flex flex-col items-center">
                            <div class="w-28 h-28 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg mb-4">
                                <i id="previewIcon" class="fas fa-image text-white text-3xl"></i>
                            </div>
                        </div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Icon Layanan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="iconInput" name="icon"
                            value="{{ old('icon', $service->icon) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                            placeholder="fas fa-box" required>
                        <p class="text-xs text-slate-500 my-2">
                            Gunakan ikon dari 
                            <a href="https://fontawesome.com/search?ic=free-collection" target="_blank" class="text-blue-600 hover:underline">Font Awesome Free v7</a>
                        </p>                        
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Deskripsi Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="3" name="long_desc"
                            class="ckeditor">{!! clean($service->long_desc) !!}</textarea>
                        <x-input-error :messages="$errors->get('long_desc')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Status Layanan <span class="text-red-500">*</span>
                        </label>
                        <select name="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900" required>
                            <option value="1" {{ old('status', $service->status) === 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $service->status) === 0 ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center space-x-2 text-sm text-slate-500">
                    <i class="fas fa-clock"></i>
                    <span>Terakhir diubah: {{ $service->updated_at->locale('id')->diffForHumans() }}</span>
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
    <script src="{{ asset('js/pages/service.js') }}"></script>
@endpush
