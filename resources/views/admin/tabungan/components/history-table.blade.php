<table class="w-full whitespace-no-wrap">
    <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            <th class="px-4 py-3">Tanggal</th>
            <th class="px-4 py-3">Jenis Transaksi</th>
            <th class="px-4 py-3">Keterangan</th>
            <th class="px-4 py-3">Nominal</th>
            <th class="px-4 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @forelse ($transactions as $transaction)
            <tr class="text-gray-700 dark:text-gray-300" id="transaction-row-{{ $transaction->id }}">
                <td class="px-4 py-3">
                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i') }}
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type === 'deposit')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            Setoran
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            Penarikan
                        </span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type === 'deposit')
                        {{ $transaction->wasteType->name ?? 'Unknown' }}
                        ({{ number_format($transaction->weight_kg, 2, ',', '.') }} kg)
                    @else
                        Pengajuan Penarikan
                    @endif
                </td>
                <td class="px-4 py-3 font-semibold @if ($transaction->type === 'deposit') text-green-600 dark:text-green-400 @else text-red-600 dark:text-red-400 @endif">
                    @if ($transaction->type === 'deposit')
                        + Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                    @else
                        - Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                    @endif
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-2">
                        @if ($transaction->type === 'deposit')
                            <a href="{{ route('transaksi.print-receipt', $transaction->id) }}" target="_blank"
                                class="px-2 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-600 transition-colors flex items-center print-receipt">
                                <i class="fa-solid fa-print mr-1"></i> Cetak
                            </a>
                            <button onclick="confirmDelete({{ $transaction->id }})"
                                class="px-2 py-1 rounded-md bg-red-500 text-white hover:bg-red-600 transition-colors flex items-center delete-transaction">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-3 text-center">
                    Belum ada transaksi
                </td>
            </tr>
        @endforelse
    </tbody>
</table>