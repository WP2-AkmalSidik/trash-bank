<table class="w-full text-sm text-left">
    <thead class="text-xs uppercase dark:text-white bg-gray-50 dark:bg-gray-700">
        <tr>
            <th scope="col" class="px-4 py-3">Tanggal</th>
            <th scope="col" class="px-4 py-3">Jenis</th>
            <th scope="col" class="px-4 py-3">Keterangan</th>
            <th scope="col" class="px-4 py-3">Jumlah (Kg)</th>
            <th scope="col" class="px-4 py-3">Harga/Kg</th>
            <th scope="col" class="px-4 py-3">Total</th>
            <th scope="col" class="px-4 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transactions as $transaction)
            <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600"
                id="row-transaction-{{ $transaction->id }}">
                <td class="px-4 py-3">
                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type == 'deposit')
                        <span class="text-green-600 font-medium">Setoran</span>
                    @else
                        <span class="text-red-600 font-medium">Penarikan</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type == 'deposit')
                        {{ $transaction->wasteType?->name ?? 'Sampah' }}
                    @else
                        Penarikan Tabungan
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type == 'deposit')
                        {{ number_format($transaction->weight_kg, 2, ',', '.') }} kg
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type == 'deposit')
                        Rp {{ number_format($transaction->price_per_kg, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if ($transaction->type == 'deposit')
                        <span class="text-green-600 font-medium">+ Rp
                            {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    @else
                        <span class="text-red-600 font-medium">- Rp
                            {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-2">
                        @if ($transaction->type == 'deposit')
                            <a href="{{ route('transaksi.print-receipt', $transaction->id) }}" target="_blank"
                                class="text-blue-500 hover:text-blue-700" title="Cetak Bon">
                                <i class="fa-solid fa-print"></i>
                            </a>
                            <button type="button" data-id="{{ $transaction->id }}"
                                class="delete-transaction text-red-500 hover:text-red-700" title="Hapus Transaksi">
                                <i class="fa-solid fa-trash-alt"></i>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-4 py-3 text-center">
                    Belum ada transaksi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>