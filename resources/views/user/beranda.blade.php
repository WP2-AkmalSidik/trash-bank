@extends('user.layouts.app')

@section('title', 'Beranda - Bank Sampah')

@section('content')
    <div id="beranda-page" class="page active">
        <div class="wave-header p-6 pb-24 relative">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-white text-sm">Selamat datang,</p>
                    <h1 class="text-white text-xl font-bold">{{ $user->name }}</h1>
                </div>
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
            </div>

            <!-- Saldo Card diletakkan di sini -->
            <div class="card-balance p-4 rounded-xl bg-primary shadow-lg absolute left-5 right-5 -bottom-20">
                <p class="text-white/80 text-sm font-medium mb-1">Saldo Saat Ini</p>
                <h2 class="text-white text-2xl font-bold mb-2">Rp {{ number_format($balance, 0, ',', '.') }}</h2>

                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        @if($monthlyGrowth >= 0)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6" />
                            </svg>
                        @endif
                        <p class="text-white text-xs">{{ $monthlyGrowth >= 0 ? '+' : '' }}{{ $monthlyGrowth }}% bulan ini</p>
                    </div>
                    <button 
                        onclick="document.getElementById('modal-pengajuan').classList.remove('hidden')" 
                        class="bg-white text-primary px-4 py-2 rounded-lg font-medium text-sm">
                        Ajukan Tarik Dana
                    </button>
                </div>
            </div>
        </div>

        <div class="px-6 pt-20">
            <div class="card-price p-4 mb-6 bg-white rounded-xl shadow">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Harga Sampah Terkini</h3>
                </div>

                <div class="overflow-x-auto scrollbar-hide -mx-1">
                    <div class="flex space-x-3 px-1 pb-2">
                        @foreach($wasteTypes as $index => $wasteType)
                            @php
                                // Set different icons based on waste type name 
                                $icons = [
                                    'paper' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />',
                                    'plastic' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />',
                                    'bottle' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />',
                                    'can' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />'
                                ];
                                $icon = $icons['paper']; // Default icon
                                $name = strtolower($wasteType->name);
                                
                                if (strpos($name, 'kertas') !== false || strpos($name, 'paper') !== false) {
                                    $icon = $icons['paper'];
                                } elseif (strpos($name, 'plastik') !== false || strpos($name, 'plastic') !== false) {
                                    $icon = $icons['plastic'];
                                } elseif (strpos($name, 'botol') !== false || strpos($name, 'bottle') !== false) {
                                    $icon = $icons['bottle']; 
                                } elseif (strpos($name, 'kaleng') !== false || strpos($name, 'can') !== false) {
                                    $icon = $icons['can'];
                                }
                            @endphp
                            
                            <div class="mini-card p-3 w-32 flex-shrink-0">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        {!! $icon !!}
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-500">{{ $wasteType->name }}</p>
                                <p class="font-bold text-dark">Rp {{ number_format($wasteType->price_per_kg, 0, ',', '.') }}<span class="text-xs font-normal">/kg</span></p>
                                
                                <!-- Persentase perubahan harga -->
                                <div class="flex items-center mt-1">
                                    @if($wasteType->is_increase)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                        <span class="text-xs text-green-500 ml-1">+{{ abs($wasteType->price_change) }}%</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                        <span class="text-xs text-red-500 ml-1">-{{ abs($wasteType->price_change) }}%</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-news p-4 mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Pengumuman Terbaru</h3>
                    <a href="#" class="text-primary text-sm font-medium">Lihat Semua</a>
                </div>

                @if($news->isEmpty())
                    <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
                        Belum ada pengumuman terbaru
                    </div>
                @else
                    @foreach($news as $index => $announcement)
                        <div class="bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/10 p-3 rounded-lg mb-3">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/20 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        @if($index % 2 == 0)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark">{{ $announcement->title }}</h4>
                                    <p class="text-gray-500 text-sm mb-2">{{ Str::limit($announcement->content, 100) }}</p>
                                    <p class="text-xs text-gray-400">Diposting {{ $announcement->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="mb-20">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Transaksi Terakhir</h3>
                    <a href="{{ route('user.transaksi') }}" class="text-primary text-sm font-medium" onclick="showPage('transaksi-page')">Lihat Semua</a>
                </div>

                @if($transactions->isEmpty())
                    <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
                        Belum ada transaksi
                    </div>
                @else
                    @foreach($transactions as $transaction)
                        <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-{{ $transaction['type'] == 'deposit' ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $transaction['type'] == 'deposit' ? 'green' : 'red' }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            @if($transaction['type'] == 'deposit')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-dark">{{ $transaction['description'] }}</h4>
                                        <p class="text-gray-500 text-xs">{{ $transaction['created_at']->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <p class="font-bold text-{{ $transaction['amount'] > 0 ? 'green' : 'red' }}-600">
                                    {{ $transaction['amount'] > 0 ? '+' : '' }}Rp {{ number_format(abs($transaction['amount']), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <!-- Bank Sampah Section -->
            <div class="mb-20">
                <h3 class="font-bold text-dark mb-3">Lokasi Bank Sampah</h3>
                
                @if($locations->isEmpty())
                    <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
                        Belum ada lokasi bank sampah
                    </div>
                @else
                    @foreach($locations as $location)
                        <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                            <h4 class="font-medium text-dark mb-1">{{ $location->name }}</h4>
                            <p class="text-gray-500 text-sm">{{ $location->address }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    
    <!-- Modal Pengajuan Penarikan Dana -->
    <div id="modal-pengajuan" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-lg mx-5 p-6 rounded-lg shadow-lg relative">
            <!-- Close button -->
            <button onclick="document.getElementById('modal-pengajuan').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-lg font-bold mb-4 text-gray-800">Form Pengajuan Penarikan Dana</h2>
            <form action="{{ route('user.pengajuan.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 font-medium mb-2">Jumlah Penarikan (Rp)</label>
                    <input 
                        type="number" 
                        id="amount" 
                        name="amount" 
                        value="{{ old('amount', 10000) }}" 
                        min="10000" 
                        max="{{ $withdrawableAmount }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Metode Penarikan</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="method_cash" name="method" value="cash" class="mr-2" {{ old('method') == 'cash' ? 'checked' : '' }} checked required>
                            <label for="method_cash">Tunai</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="method_ewallet" name="method" value="ewallet" class="mr-2" {{ old('method') == 'ewallet' ? 'checked' : '' }}>
                            <label for="method_ewallet">E-Wallet</label>
                        </div>
                    </div>
                    @error('method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="ewallet_details" class="hidden">
                    <div class="mb-4">
                        <label for="ewallet_type" class="block text-gray-700 font-medium mb-2">Jenis E-Wallet</label>
                        <select 
                            id="ewallet_type" 
                            name="ewallet_type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            <option value="">Pilih Jenis E-Wallet</option>
                            <option value="DANA" {{ old('ewallet_type') == 'DANA' ? 'selected' : '' }}>DANA</option>
                            <option value="OVO" {{ old('ewallet_type') == 'OVO' ? 'selected' : '' }}>OVO</option>
                            <option value="GoPay" {{ old('ewallet_type') == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                            <option value="LinkAja" {{ old('ewallet_type') == 'LinkAja' ? 'selected' : '' }}>LinkAja</option>
                            <option value="ShopeePay" {{ old('ewallet_type') == 'ShopeePay' ? 'selected' : '' }}>ShopeePay</option>
                        </select>
                        @error('ewallet_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ewallet_number" class="block text-gray-700 font-medium mb-2">Nomor E-Wallet</label>
                        <input 
                            type="text" 
                            id="ewallet_number" 
                            name="ewallet_number" 
                            value="{{ old('ewallet_number') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            placeholder="contoh: 08123456789"
                        >
                        @error('ewallet_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-pengajuan').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Ajukan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script untuk toggle form e-wallet
        const methodCash = document.getElementById('method_cash');
        const methodEwallet = document.getElementById('method_ewallet');
        const ewalletDetails = document.getElementById('ewallet_details');

        function toggleEwalletFields() {
            if (methodEwallet.checked) {
                ewalletDetails.classList.remove('hidden');
                document.getElementById('ewallet_type').setAttribute('required', 'required');
                document.getElementById('ewallet_number').setAttribute('required', 'required');
            } else {
                ewalletDetails.classList.add('hidden');
                document.getElementById('ewallet_type').removeAttribute('required');
                document.getElementById('ewallet_number').removeAttribute('required');
            }
        }

        methodCash.addEventListener('change', toggleEwalletFields);
        methodEwallet.addEventListener('change', toggleEwalletFields);
        
        // Run on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleEwalletFields();
        });
    </script>
@endsection