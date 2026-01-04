<table id="notification-table" class="w-full">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-200">
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Subjek</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Topik</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($mails as $mail)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $mails->firstItem() + $loop->index }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900">{{ ucfirst($mail->full_name) ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ $mail->subject ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    @if ($mail->topic === 'quotation')
                        <span class="inline-block bg-yellow-600 text-white text-xs px-4 py-2 rounded-full font-semibold">
                            {{ $mail->topic }}
                        </span>
                    @elseif ($mail->topic === 'technical')
                        <span class="inline-block bg-blue-600 text-white text-xs px-4 py-2 rounded-full font-semibold">
                            {{ $mail->topic }}
                        </span>
                    @elseif ($mail->topic === 'partnership')
                        <span class="inline-block bg-purple-600 text-white text-xs px-4 py-2 rounded-full font-semibold">
                            {{ $mail->topic }}
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ $mail->email ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $mail->status === 'read' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $mail->status === 'read' ? 'read' : 'unread' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">
                        {{ $mail->created_at ? \Carbon\Carbon::parse($mail->created_at)->format('d-m-Y H:i:s') : '-' }}
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('notification', $mail->id) }}" class="p-2 bg-blue-50 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-circle-info text-blue-600"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                    Tidak ada data ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div id="paginationContainer" class="bg-white px-6 py-4">
    {{ $mails->links() }}
</div>
