<table class="w-full">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-200">
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Author</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($medias as $media)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $medias->firstItem() + $loop->index }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $media->title ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    @if ($media->category == 'News')
                        <span class="inline-block bg-red-600 text-white text-xs px-4 py-2 rounded-full font-semibold">
                            {{ $media->category }}
                        </span>
                    @elseif ($media->category == 'Blogs')
                        <span class="inline-block bg-blue-600 text-white text-xs px-4 py-2 rounded-full font-semibold">
                            {{ $media->category }}
                        </span>
                    @elseif ($media->category == 'Events')
                        <span class="inline-block bg-purple-600 text-white text-xs px-4 py-2 rounded-full font-semibold">
                            {{ $media->category }}
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ ucfirst($media->author) ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $media->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $media->status == 1 ? 'active' : 'inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('medias.edit', $media->id) }}" class="p-2 bg-yellow-50 hover:bg-yellow-100 rounded-lg">
                            <i class="fas fa-pen text-yellow-600"></i>
                        </a>
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

{{-- Pagination --}}
<div id="paginationContainer" class="bg-white px-6 py-4">
    {{ $medias->links() }}
</div>
