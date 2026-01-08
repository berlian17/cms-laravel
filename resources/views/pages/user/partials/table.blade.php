<table class="w-full">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-200">
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Terakhir Login</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $users->firstItem() + $loop->index }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $user->name ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ $user->email ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $user->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $user->status == 1 ? 'active' : 'inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">
                    {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d-m-Y H:i:s') : '-' }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <button
                            type="button"
                            class="p-2 bg-yellow-50 hover:bg-yellow-100 rounded-lg"
                            onclick="openModal('editModal', {{ $user->id }})"
                        >
                            <i class="fas fa-pen text-yellow-600"></i>
                        </button>
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
<div class="bg-white px-6 py-4 border-t border-gray-200">
    {{ $users->links() }}
</div>
