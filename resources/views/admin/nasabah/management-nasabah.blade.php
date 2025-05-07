@extends('admin.app')
@section('title', 'Manajemen Nasabah')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Search and Actions -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <form class="relative w-full md:w-1/3" method="GET" action="{{ route('nasabah') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, NIK, atau no. HP..."
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-600 text-gray-800 dark:text-white" />
                </form>

                <div class="flex gap-3">
                    <button onclick="openModal()"
                        class="px-4 py-2 rounded-lg bg-primary text-secondary hover:bg-opacity-90 transition flex items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="hidden sm:inline">Nasabah</span>
                    </button>
                    <button
                        class="px-4 py-2 rounded-lg bg-secondary text-primary hover:bg-opacity-90 transition flex items-center gap-2">
                        <i class="fa-solid fa-file-export"></i>
                        <span class="hidden sm:inline">Export</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Nasabah -->
            <div class="overflow-x-auto">
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
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-600 dark:text-gray-300">
                    Menampilkan
                    <span class="font-medium">{{ $nasabahList->firstItem() }}</span>
                    sampai
                    <span class="font-medium">{{ $nasabahList->lastItem() }}</span>
                    dari
                    <span class="font-medium">{{ $nasabahList->total() }}</span>
                    nasabah
                </div>

                @if($nasabahList->hasPages())
                    <div class="flex items-center">
                        {{ $nasabahList->onEachSide(1)->links('admin.nasabah.components.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    @include('admin.nasabah.components.modal-tambah-nasabah')
    @include('admin.nasabah.components.modal-edit-nasabah')
    @include('admin.nasabah.components.modal-hapus-nasabah')
@endsection
