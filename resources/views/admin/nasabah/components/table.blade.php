<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">#</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No. Akun</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No HP</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Saldo</th>
            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
        @forelse($nasabahList as $index => $nasabah)
            <tr>
                <td class="px-4 py-4">{{ ($nasabahList->currentPage() - 1) * $nasabahList->perPage() + $index + 1 }}</td>
                <td class="px-4 py-4">{{ $nasabah->name }}</td>
                <td class="px-4 py-4">{{ $nasabah->memberAccount->account_number ?? '-' }}</td>
                <td class="px-4 py-4">{{ $nasabah->phone_number }}</td>
                <td class="px-4 py-4">{{ $nasabah->email }}</td>
                <td class="px-4 py-4 text-green-600">Rp
                    {{ number_format($nasabah->memberAccount->balance ?? 0, 0, ',', '.') }}</td>
                <td class="px-4 py-4 text-center">
                    <button onclick="openEditModal({{ $nasabah->id }})">Edit</button>
                    <button onclick="openDeleteModal({{ $nasabah->id }}, '{{ $nasabah->name }}')">Hapus</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center py-4">Tidak ada data nasabah ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>
