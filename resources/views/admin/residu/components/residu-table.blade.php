<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">No</th>
            <th scope="col" class="px-6 py-3">Nama Residu</th>
            <th scope="col" class="px-6 py-3">Tanggal</th>
            <th scope="col" class="px-6 py-3">Berat (kg)</th>
            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($residues as $index => $residu)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">{{ $residues->firstItem() + $index }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $residu->name }}</td>
                <td class="px-6 py-4">{{ $residu->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">{{ number_format($residu->weight_kg, 2) }}</td>
                <td class="px-6 py-4 flex justify-center gap-2">
                    <button onclick="openEditModal({{ $residu->id }})" 
                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button onclick="openDeleteModal({{ $residu->id }}, '{{ $residu->name }}')" 
                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                    Tidak ada data residu ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@if ($residues->hasPages())
    <div class="mt-4 px-6">
        {{ $residues->withQueryString()->links() }}
    </div>
@endif