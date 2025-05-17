@extends('user.layouts.app')

@section('title', 'Form Pengajuan - Bank Sampah')
@section('header', 'Form Pengajuan Tarik Dana')

@section('content')
    <div id="pengajuan-form-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            <div class="card-balance p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-white text-lg font-bold">Informasi Saldo</h2>
                </div>
                <p class="text-white/80 text-sm mb-3">Saldo yang dapat ditarik</p>
                <h3 class="text-white text-2xl font-bold mb-4">Rp {{ number_format($withdrawableAmount, 0, ',', '.') }}</h3>

                <div class="bg-white/20 p-3 rounded-lg">
                    <div class="flex justify-between text-white/90 text-sm mb-1">
                        <span>Saldo saat ini</span>
                        <span>Rp {{ number_format($memberAccount->balance, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-white/90 text-sm">
                        <span>Minimal saldo tersisa</span>
                        <span>Rp 100.000</span>
                    </div>
                </div>
            </div>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

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
                            <input type="radio" id="method_cash" name="method" value="cash" class="mr-2" {{ old('method') == 'cash' ? 'checked' : '' }} required>
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

                <div id="ewallet_details" class="{{ old('method') == 'ewallet' ? '' : 'hidden' }}">
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

                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('user.pengajuan') }}" class="flex-1 py-3 px-4 bg-gray-300 text-gray-800 rounded-xl text-center font-medium">Batal</a>
                    <button type="submit" class="flex-1 py-3 px-4 bg-primary text-white rounded-xl font-medium">Ajukan Penarikan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script untuk toggle form e-wallet
        const methodCash = document.getElementById('method_cash');
        const methodEwallet = document.getElementById('method_ewallet');
        const ewalletDetails = document.getElementById('ewallet_details');

        // Function to toggle e-wallet fields
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

        // Add event listeners
        methodCash.addEventListener('change', toggleEwalletFields);
        methodEwallet.addEventListener('change', toggleEwalletFields);

        // Initialize on page load
        toggleEwalletFields();
    </script>
@endsection