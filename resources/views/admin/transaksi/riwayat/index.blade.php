<!-- resources/views/admin/transaksi/history.blade.php -->
@extends('admin.app')
@section('title', 'Riwayat Transaksi')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <div class="mb-6">
                <div class="flex items-center mb-4">
                    <a href="{{ route('transaksi.index') }}" class="text-primary hover:underline flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Riwayat Transaksi Nasabah</h1>
                <p class="text-gray-600 dark:text-gray-300">Detail transaksi nasabah {{ $member->name }}</p>
            </div>

            <!-- Member Info Card -->
            <div class="mb-6 bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div class="h-16 w-16 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-700 dark:text-gray-300 font-semibold text-2xl mr-4">
                            {{ substr($member->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $member->name }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">No. Rekening: {{ $member->memberAccount->account_number }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ $member->email }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Saldo</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Riwayat Setoran Sampah</h3>
                <div class="overflow-x-auto">
                    @include('admin.transaksi.components.history-table')
                </div>
            </div>
        </div>
    </section>
@endsection