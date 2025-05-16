@extends('admin.app')
@section('title', 'Riwayat Transaksi')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Header with back button and member info -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('transaksi.index') }}"
                        class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <div class="flex items-center gap-2 mt-1">
                            <div
                                class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-700 dark:text-gray-300 font-semibold">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <span class="font-medium">{{ $member->name }}</span>
                            <span class="text-gray-500 dark:text-gray-400">•</span>
                            <span
                                class="text-gray-600 dark:text-gray-300">{{ $member->memberAccount->account_number }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="bg-blue-100 dark:bg-blue-900 px-4 py-2 rounded-lg">
                        <span class="text-gray-600 dark:text-gray-300">Total Saldo:</span>
                        <span class="font-bold text-blue-600 dark:text-blue-300 ml-2">
                            Rp {{ number_format($totalBalance, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Export PDF Button -->
                    <a href="{{ route('transaksi.print-history', $member->id) }}"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span>Export PDF</span>
                    </a>
                </div>
            </div>

            <!-- Alert Message -->
            @if (session('success'))
                <div id="alert-success"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i onclick="document.getElementById('alert-success').remove()"
                            class="fa-solid fa-times cursor-pointer"></i>
                    </span>
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i onclick="document.getElementById('alert-error').remove()"
                            class="fa-solid fa-times cursor-pointer"></i>
                    </span>
                </div>
            @endif

            <!-- Transaction History Table -->
            <div class="overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Jenis Sampah</th>
                            <th class="px-4 py-3">Berat (kg)</th>
                            <th class="px-4 py-3">Harga/Kg</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($deposits as $deposit)
                            <tr class="text-gray-700 dark:text-gray-300">
                                <td class="px-4 py-3">
                                    {{ $deposit->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $deposit->wasteType->name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ number_format($deposit->weight_kg, 2) }}
                                </td>
                                <td class="px-4 py-3">
                                    Rp {{ number_format($deposit->wasteType->price_per_kg, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 font-semibold text-right">
                                    Rp {{ number_format($deposit->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('transaksi.print-receipt', $deposit->id) }}" target="_blank"
                                        class="px-2 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-600 transition-colors flex items-center justify-center">
                                        <i class="fa-solid fa-print mr-1"></i>Cetak
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center">
                                    Tidak ada riwayat transaksi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t dark:border-gray-700">
                {{ $deposits->links() }}
            </div>
        </div>
    </section>
@endsection
