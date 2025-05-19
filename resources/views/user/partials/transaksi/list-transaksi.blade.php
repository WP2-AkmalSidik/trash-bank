@forelse($groupedTransactions as $month => $transactions)
    <div class="mb-4 transition-opacity">
        <h3 class="text-gray-500 text-sm mb-2">{{ $month }}</h3>
        
        @foreach($transactions as $transaction)
            <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-{{ $transaction['icon'] }}-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $transaction['icon'] }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $transaction['icon_svg'] }}" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark">{{ $transaction['title'] }}</h4>
                            <p class="text-gray-500 text-xs">
                                <span class="mr-1">{{ $transaction['date']->format('d M Y') }}</span>
                                <span class="bg-{{ $transaction['icon'] }}-50 text-{{ $transaction['icon'] }}-600 text-xs px-2 py-0.5 rounded-full">
                                    {{ $transaction['type'] === 'withdrawal' ? 'Keluar' : 'Masuk' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <p class="font-bold text-{{ $transaction['icon'] }}-600">
                        {{ $transaction['type'] === 'withdrawal' ? '-' : '+' }}Rp {{ number_format($transaction['amount'], 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@empty
    <div class="text-center py-10 transition-opacity">
        <p class="text-gray-500">Tidak ada transaksi ditemukan</p>
    </div>
@endforelse