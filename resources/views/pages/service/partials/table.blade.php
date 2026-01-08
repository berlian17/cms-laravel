<table class="w-full">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-200">
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($services as $service)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $services->firstItem() + $loop->index }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 shrink-0 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="{{ $service->icon ?? 'fas fa-image' }} text-white text-2xl"></i>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">{{ $service->title ?? '-' }}</div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $service->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $service->status == 1 ? 'active' : 'inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('services.edit', $service->id) }}" class="p-2 bg-yellow-50 hover:bg-yellow-100 rounded-lg">
                            <i class="fas fa-pen text-yellow-600"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                    Tidak ada data ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div id="paginationContainer" class="bg-white px-6 py-4">
    {{ $services->links() }}
</div>
