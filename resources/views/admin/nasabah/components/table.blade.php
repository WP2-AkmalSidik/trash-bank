<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                #</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Nama</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                No. Akun</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                No HP</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Email</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Saldo</th>
            <th scope="col"
                class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
        @forelse($nasabahList as $index => $nasabah)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                    {{ ($nasabahList->currentPage() - 1) * $nasabahList->perPage() + $index + 1 }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                    {{ $nasabah->name }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $nasabah->memberAccount->account_number ?? '-' }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $nasabah->phone_number }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $nasabah->email }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-green-600 dark:text-secondary">
                    Rp {{ number_format($nasabah->memberAccount->balance ?? 0, 0, ',', '.') }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick="openEditModal({{ $nasabah->id }})"
                            class="p-2 text-green-600 hover:bg-green-100/50 dark:text-green-400 dark:hover:bg-green-900/50 rounded-full transition-colors duration-200"
                            title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button onclick="openDeleteModal({{ $nasabah->id }}, '{{ $nasabah->name }}')"
                            class="p-2 text-red-600 hover:bg-red-100/50 dark:text-red-400 dark:hover:bg-red-900/50 rounded-full transition-colors duration-200"
                            title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                    Tidak ada data nasabah ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
