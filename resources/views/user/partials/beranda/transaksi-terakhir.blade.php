<div class="mb-6">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-bold text-dark">Transaksi Terakhir</h3>
        <a href="{{ route('user.transaksi') }}" class="text-primary text-sm font-medium"
            onclick="showPage('transaksi-page')">Lihat Semua</a>
    </div>

    @if ($transactions->isEmpty())
        <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
            Belum ada transaksi
        </div>
    @else
        @foreach ($transactions as $transaction)
            <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-{{ $transaction['type'] == 'deposit' ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-{{ $transaction['type'] == 'deposit' ? 'green' : 'red' }}-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                @if ($transaction['type'] == 'deposit')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                @endif
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark">{{ $transaction['description'] }}</h4>
                            <p class="text-gray-500 text-xs">{{ $transaction['created_at']->format('d M Y') }}</p>
                        </div>
                    </div>
                    <p class="font-bold text-{{ $transaction['amount'] > 0 ? 'green' : 'red' }}-600">
                        {{ $transaction['amount'] > 0 ? '+' : '' }}Rp
                        {{ number_format(abs($transaction['amount']), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>
