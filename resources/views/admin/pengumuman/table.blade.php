<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deskripsi</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dibuat</th>
            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
        @forelse($news as $item)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                    {{ ($news->currentPage() - 1) * $news->perPage() + $loop->iteration }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                    {{ $item->title }}
                </td>
                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                    {{ Str::limit($item->content, 50) }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $item->created_at->format('d M Y, H:i') }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick="openEditModal({{ $item->id }})"
                            class="p-2 text-blue-600 hover:bg-blue-100/50 dark:text-blue-400 dark:hover:bg-blue-900/50 rounded-full transition-colors duration-200"
                            title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->title) }}')"
                            class="p-2 text-red-600 hover:bg-red-100/50 dark:text-red-400 dark:hover:bg-red-900/50 rounded-full transition-colors duration-200"
                            title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                    Tidak ada pengumuman ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@if($news->hasPages())
    <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            Menampilkan
            <span class="font-medium">{{ $news->firstItem() ?? 0 }}</span>
            sampai
            <span class="font-medium">{{ $news->lastItem() ?? 0 }}</span>
            dari
            <span class="font-medium">{{ $news->total() }}</span>
            pengumuman
        </div>

        <div class="flex items-center">
            <nav class="flex items-center space-x-1">
                {{ $news->onEachSide(1)->links('admin.pengumuman.pagination') }}
            </nav>
        </div>
    </div>
@endif