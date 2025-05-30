@extends('user.layouts.app')

@section('title', 'Pengajuan - Bank Sampah')
@section('header', 'Pengajuan Tarik Dana')

@section('content')
    <div id="pengajuan-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            <div class="card-balance p-4 mb-6">
                <p class="text-white/80 text-sm mb-3">Saldo yang dapat ditarik</p>
                <h3 class="text-white text-2xl font-bold mb-4">Rp {{ number_format($withdrawableAmount, 0, ',', '.') }}</h3>

                <div class="bg-white/20 p-3 rounded-lg">
                    <div class="flex justify-between text-white/90 text-sm mb-1">
                        <span>Saldo saat ini</span>
                        <span>Rp {{ number_format($memberAccount->balance, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-white/90 text-sm">
                        <span>Minimal saldo tersisa</span>
                        <span>Rp {{ number_format($minimumBalance, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button onclick="showPengajuanModal()"
                class="block w-full bg-primary text-white font-medium py-3 rounded-xl mb-6 shadow-md text-center">
                Ajukan Penarikan Dana
            </button>

            <!-- Modal -->
            <div id="modal-pengajuan" class="fixed inset-0 z-50 flex items-center justify-center hidden"
                style="background-color: rgba(255, 255, 255, 0.5);">
                <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
                    <!-- Close button -->
                    <button onclick="document.getElementById('modal-pengajuan').classList.add('hidden')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                        &times;
                    </button>

                    <h2 class="text-lg font-bold mb-4 text-gray-800">Form Pengajuan Penarikan Dana</h2>
                    <form action="{{ route('user.pengajuan.store') }}" method="POST" id="pengajuanForm">
                        @csrf

                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 font-medium mb-2">Jumlah Penarikan (Rp)</label>
                            <input type="number" id="amount" name="amount" value="{{ old('amount', 10000) }}"
                                min="10000" max="{{ $withdrawableAmount }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                required>
                            @error('amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Metode Penarikan</label>
                            <div class="flex space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="method_cash" name="method" value="cash" class="mr-2"
                                        {{ old('method') == 'cash' ? 'checked' : '' }} required>
                                    <label for="method_cash">Tunai</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="method_ewallet" name="method" value="ewallet" class="mr-2"
                                        {{ old('method') == 'ewallet' ? 'checked' : '' }}>
                                    <label for="method_ewallet">E-Wallet</label>
                                </div>
                            </div>
                            @error('method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="ewallet_details" class="{{ old('method') == 'ewallet' ? '' : 'hidden' }}">
                            <div class="mb-4">
                                <label for="ewallet_type" class="block text-gray-700 font-medium mb-2">Jenis
                                    E-Wallet</label>
                                <select id="ewallet_type" name="ewallet_type"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Pilih Jenis E-Wallet</option>
                                    <option value="DANA" {{ old('ewallet_type') == 'DANA' ? 'selected' : '' }}>DANA
                                    </option>
                                    <option value="OVO" {{ old('ewallet_type') == 'OVO' ? 'selected' : '' }}>OVO
                                    </option>
                                    <option value="GoPay" {{ old('ewallet_type') == 'GoPay' ? 'selected' : '' }}>GoPay
                                    </option>
                                    <option value="LinkAja" {{ old('ewallet_type') == 'LinkAja' ? 'selected' : '' }}>
                                        LinkAja</option>
                                    <option value="ShopeePay" {{ old('ewallet_type') == 'ShopeePay' ? 'selected' : '' }}>
                                        ShopeePay</option>
                                </select>
                                @error('ewallet_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="ewallet_number" class="block text-gray-700 font-medium mb-2">Nomor
                                    E-Wallet</label>
                                <input type="text" id="ewallet_number" name="ewallet_number"
                                    value="{{ old('ewallet_number') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="contoh: 08123456789">
                                @error('ewallet_number')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button"
                                onclick="document.getElementById('modal-pengajuan').classList.add('hidden')"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Ajukan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mb-20 mt-6">
                <h3 class="font-bold text-dark mb-4">Riwayat Pengajuan</h3>

                @if ($withdrawals->isEmpty())
                    <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
                        Belum ada riwayat pengajuan penarikan
                    </div>
                @else
                    @foreach ($withdrawals as $withdrawal)
                        <div class="bg-white rounded-lg shadow-sm p-4 mb-3">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-dark">Pengajuan ke-{{ $withdrawal->submission_number }}</h4>
                                <div
                                    class="@if ($withdrawal->status == 'approved') bg-green-100 text-green-600 
            @elseif($withdrawal->status == 'rejected') bg-red-100 text-red-600 
            @else bg-yellow-100 text-yellow-600 @endif 
            text-xs font-medium px-2 py-1 rounded-full">
                                    {{ $withdrawal->status == 'approved' ? 'Sukses' : ($withdrawal->status == 'rejected' ? 'Ditolak' : 'Pending') }}
                                </div>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mb-1">
                                <span>Tanggal</span>
                                <span>{{ $withdrawal->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mb-1">
                                <span>Jumlah</span>
                                <span class="font-medium">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</span>
                            </div>
                            <div
                                class="flex justify-between text-sm text-gray-500 
        @if ($withdrawal->status == 'rejected' && $withdrawal->rejection_reason) mb-3 @endif">
                                <span>Metode</span>
                                <span>
                                    @if ($withdrawal->method == 'cash')
                                        Tunai
                                    @else
                                        {{ $withdrawal->ewallet_type }} ({{ $withdrawal->ewallet_number }})
                                    @endif
                                </span>
                            </div>

                            @if ($withdrawal->status == 'approved' && $withdrawal->method == 'ewallet' && $withdrawal->proof_of_transfer)
                                <div class="mt-3 flex justify-end">
                                    <button onclick="showProof('{{ $withdrawal->id }}')"
                                        class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Bukti Transfer
                                    </button>
                                </div>
                            @endif

                            @if ($withdrawal->status == 'rejected' && $withdrawal->rejection_reason)
                                <div class="bg-red-50 p-2 rounded text-xs text-red-600">
                                    {{ $withdrawal->rejection_reason }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Proof Modal -->
    <div id="modal-proof" class="fixed inset-0 z-50 flex items-start justify-center hidden" style="background-color: rgba(255, 255, 255, 0.5);">
        <div class="bg-white w-full max-w-md rounded-xl shadow-xl relative mx-4 my-8 overflow-hidden">
            <!-- Modal Header -->
            <div class="border-b border-gray-100 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Bukti Transfer</h2>
                <button onclick="document.getElementById('modal-proof').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div class="flex justify-center mb-6">
                    <img id="proof-image" src="" alt="Bukti Transfer"
                        class="max-w-full h-auto rounded-lg border border-gray-200 shadow-sm">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <button onclick="document.getElementById('modal-proof').classList.add('hidden')"
                    class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium">
                    Tutup
                </button>
            </div>
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
        toggleEwalletFields(); // initial

        // Fungsi untuk menampilkan modal pengajuan
        function showPengajuanModal() {
            document.getElementById('modal-pengajuan').classList.remove('hidden');
        }

        // Fungsi untuk menampilkan bukti transfer
        function showProof(withdrawalId) {
            fetch(`/user/pengajuan/proof/${withdrawalId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('proof-image').src = data.proof_url;
                    document.getElementById('modal-proof').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Gagal memuat bukti transfer',
                        icon: 'error',
                        confirmButtonColor: '#3085d6'
                    });
                });
        }

        // SweetAlert untuk notifikasi
        document.addEventListener('DOMContentLoaded', function() {
            // Form submit dengan SweetAlert
            const pengajuanForm = document.getElementById('pengajuanForm');
            if (pengajuanForm) {
                pengajuanForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Konfirmasi Pengajuan',
                        text: 'Apakah Anda yakin ingin mengajukan penarikan dana?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Ajukan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            pengajuanForm.submit();
                        }
                    });
                });
            }

            // SweetAlert untuk flash messages
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
            @endif
        });
    </script>
@endsection
