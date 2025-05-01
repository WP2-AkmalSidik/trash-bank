@extends('admin.app')
@section('title', 'Manajemen Nasabah')

@section('content')
    <section class="p-6 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto">

            <!-- Search + Filter -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                <input type="text" placeholder="Cari nasabah..."
                    class="w-full md:w-1/3 px-4 py-2 rounded border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" />

                <div class="flex gap-2">
                    <button class="px-4 py-2 rounded bg-secondary text-white hover:bg-yellow-500 transition">Tambah
                        Nasabah</button>
                    <button class="px-4 py-2 rounded bg-accent text-white hover:bg-red-700 transition">Export</button>
                </div>
            </div>

            <!-- Tabel Nasabah -->
            <div class="overflow-auto rounded-lg shadow border border-gray-200">
                <table class="w-full text-sm text-left">
                    <thead class="bg-light text-gray-700">
                        <tr>
                            <th class="p-4">No</th>
                            <th class="p-4">Nama</th>
                            <th class="p-4">NIK</th>
                            <th class="p-4">No HP</th>
                            <th class="p-4">Saldo</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        <!-- Row dummy -->
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">1</td>
                            <td class="p-4">Ahmad Fauzi</td>
                            <td class="p-4">3271021234567890</td>
                            <td class="p-4">081234567890</td>
                            <td class="p-4">Rp 125.000</td>
                            <td class="p-4 text-center space-x-2">
                                <button
                                    class="px-3 py-1 rounded bg-primary text-white hover:bg-green-800 text-xs">Edit</button>
                                <button
                                    class="px-3 py-1 rounded bg-accent text-white hover:bg-red-800 text-xs">Hapus</button>
                            </td>
                        </tr>
                        <!-- Tambahkan lebih banyak dummy row jika ingin -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6 text-sm text-gray-600">
                <span>Menampilkan 1 dari 10 nasabah</span>
                <div class="flex items-center gap-1">
                    <button class="px-2 py-1 rounded hover:bg-gray-200">&laquo;</button>
                    <button class="px-3 py-1 rounded bg-primary text-white">1</button>
                    <button class="px-2 py-1 rounded hover:bg-gray-200">&raquo;</button>
                </div>
            </div>
        </div>
    </section>

@endsection
