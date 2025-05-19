@extends('user.layouts.app')

@section('title', 'Beranda - Bank Sampah')

@section('content')
    <div id="beranda-page" class="page active">
        {{-- Wave Header --}}
        @include('user.components.wave-header')

        <div class="px-6 pt-20">
            @include('user.partials.beranda.harga-sampah')

            @include('user.partials.beranda.pengumuman')

            @include('user.partials.beranda.transaksi-terakhir')
            
            <!-- Bank Sampah Section -->
            @include('user.partials.beranda.bank-sampah')
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