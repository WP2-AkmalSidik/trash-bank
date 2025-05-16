<!-- resources/views/admin/transaksi/components/history-table.blade.php -->
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jenis Sampah</th>
                    <th class="px-4 py-3">Berat (kg)</th>
                    <th class="px-4 py-3">Harga per kg</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($deposits as $deposit)
                    <tr class="text-gray-700 dark:text-gray-300">
                        <td class="px-4 py-3">
                            {{ $deposit->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $deposit->wasteType->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ number_format($deposit->weight_kg, 2, ',', '.') }} kg
                        </td>
                        <td class="px-4 py-3">
                            Rp {{ number_format($deposit->wasteType->price_per_kg, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 font-semibold text-green-600 dark:text-green-400">
                            Rp {{ number_format($deposit->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('transaksi.print-receipt', $deposit->id) }}" target="_blank"
                                   class="px-2 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-600 transition-colors flex items-center">
                                    <i class="fa-solid fa-print mr-1"></i> Cetak
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center">
                            Belum ada transaksi setoran sampah
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-t dark:border-gray-700">
        {{ $deposits->links() }}
    </div>
</div>