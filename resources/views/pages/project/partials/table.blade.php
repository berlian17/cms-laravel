<table class="w-full">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-200">
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Layanan</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe Industri</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($projects as $project)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $projects->firstItem() + $loop->index }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $project->title ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ ucfirst($project->service_name) ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ ucfirst($project->industrial_type) ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ ucfirst($project->client_name) ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ ucfirst($project->location) ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $project->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $project->status == 1 ? 'active' : 'inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('projects.edit', $project->id) }}" class="p-2 bg-yellow-50 hover:bg-yellow-100 rounded-lg">
                            <i class="fas fa-pen text-yellow-600"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="px-6 py-6 text-center text-gray-500">
                    Tidak ada data ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div id="paginationContainer" class="bg-white px-6 py-4">
    {{ $projects->links() }}
</div>
