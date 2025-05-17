@extends('user.layouts.app')

@section('title', 'Detail Pengajuan - Bank Sampah')
@section('header', 'Detail Pengajuan')

@section('content')
    <div id="pengajuan-show-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-dark">Detail Pengajuan</h2>
                    <div class="
                        @if($withdrawal->status == 'approved') bg-green-100 text-green-600 
                        @elseif($withdrawal->status == 'rejected') bg-red-100 text-red-600 
                        @else bg-yellow-100 text-yellow-600 
                        @endif 
                        text-xs font-medium px-3 py-1 rounded-full"
                    >
                        {{ $withdrawal->status == 'approved' ? 'Disetujui' : ($withdrawal->status == 'rejected' ? 'Ditolak' : 'Menunggu') }}
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal Pengajuan</span>
                        <span class="font-medium">{{ $withdrawal->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nomor Pengajuan</span>
                        <span class="font-medium">#{{ $withdrawal->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Jumlah Penarikan</span>
                        <span class="font-medium text-primary">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Metode Penarikan</span>
                        <span class="font-medium">
                            {{ $withdrawal->method == 'cash' ? 'Tunai' : $withdrawal->ewallet_type }}
                        </span>
                    </div>
                    
                    @if($withdrawal->method == 'ewallet')
                        <div class="flex justify-between">
                            <span class="text-gray-500">Nomor E-Wallet</span>
                            <span class="font-medium">{{ $withdrawal->ewallet_number }}</span>
                        </div>
                    @endif
                    
                    @if($withdrawal->status == 'rejected' && $withdrawal->rejection_reason)
                        <div class="mt-4 pt-3 border-t border-gray-100">
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Alasan Penolakan</h4>
                            <p class="text-red-600">{{ $withdrawal->rejection_reason }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-balance p-4 mb-6">
                <h2 class="text-white text-lg font-bold mb-3">Informasi Saldo</h2>
                <div class="bg-white/20 p-3 rounded-lg space-y-2">
                    <div class="flex justify-between text-white/90 text-sm">
                        <span>Saldo Saat Ini</span>
                        <span>Rp {{ number_format($memberAccount->balance, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('user.pengajuan') }}" class="block w-full bg-primary text-white font-medium py-3 rounded-xl shadow-md text-center">
                Kembali ke Daftar Pengajuan
            </a>
        </div>
    </div>
@endsection