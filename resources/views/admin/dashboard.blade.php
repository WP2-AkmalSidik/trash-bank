@extends('admin.app')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Nasabah -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Nasabah</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalMembers }}</p>
                    <p
                        class="text-xs {{ $memberGrowthPercentage > 0 ? 'text-green-600 dark:text-green-500' : 'text-red-600 dark:text-red-500' }} flex items-center mt-1">
                        @if ($memberGrowthPercentage > 0)
                            <i class="fas fa-arrow-up mr-1"></i>
                        @else
                            <i class="fas fa-arrow-down mr-1"></i>
                        @endif
                        {{ abs($memberGrowthPercentage) }}% bulan ini
                    </p>
                </div>
                <div class="p-3 bg-emerald-500/10 dark:bg-emerald-500/20 rounded-full">
                    <i class="fas fa-users text-emerald-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Sampah Masuk (kg) -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sampah Masuk</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($totalWasteWeight, 0, ',', '.') }} kg</p>
                    <p
                        class="text-xs {{ $wasteGrowthPercentage > 0 ? 'text-green-600 dark:text-green-500' : 'text-red-600 dark:text-red-500' }} flex items-center mt-1">
                        @if ($wasteGrowthPercentage > 0)
                            <i class="fas fa-arrow-up mr-1"></i>
                        @else
                            <i class="fas fa-arrow-down mr-1"></i>
                        @endif
                        {{ abs($wasteGrowthPercentage) }}% minggu ini
                    </p>
                </div>
                <div class="p-3 bg-blue-500/10 dark:bg-blue-500/20 rounded-full">
                    <i class="fas fa-trash-alt text-blue-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Penarikan Dana -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Penarikan Dana</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp
                        {{ number_format($totalWithdrawals, 0, ',', '.') }}
                    </p>
                    <p
                        class="text-xs {{ $withdrawalsGrowthPercentage > 0 ? 'text-green-600 dark:text-green-500' : 'text-red-600 dark:text-red-500' }} flex items-center mt-1">
                        @if ($withdrawalsGrowthPercentage > 0)
                            <i class="fas fa-arrow-up mr-1"></i>
                        @else
                            <i class="fas fa-arrow-down mr-1"></i>
                        @endif
                        {{ abs($withdrawalsGrowthPercentage) }}% minggu ini
                    </p>
                </div>
                <div class="p-3 bg-amber-500/10 dark:bg-amber-500/20 rounded-full">
                    <i class="fas fa-money-bill-wave text-amber-500 text-2xl"></i>
                </div>
            </div>
        </div>


        <!-- Jumlah semua Sampah Masuk -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Deposit Sampah</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalDeposits }}</p>
                    <p class="text-xs text-green-600 dark:text-green-500 flex items-center mt-1">
                        <i class="fas fa-plus-circle mr-1"></i>
                        {{ $newDeposits }} baru
                    </p>
                </div>
                <div class="p-3 bg-purple-500/10 dark:bg-purple-500/20 rounded-full">
                    <i class="fas fa-recycle text-purple-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Chart - Statistik Sampah Masuk -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Statistik Sampah Masuk (kg)</h2>
                <div class="flex space-x-2">
                    <button id="btn-weekly" data-period="weekly"
                        class="px-3 py-1 text-xs font-medium bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-200 rounded-md period-btn">Mingguan</button>
                    <button id="btn-monthly" data-period="monthly"
                        class="px-3 py-1 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md period-btn">Bulanan</button>
                    <button id="btn-yearly" data-period="yearly"
                        class="px-3 py-1 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md period-btn">Tahunan</button>
                </div>
            </div>
            <div class="relative h-72">
                <!-- Chart Canvas -->
                <canvas id="chartSampahMasuk" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Pengajuan Penarikan Terbaru -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Penarikan</h2>
                <a href="{{ route('pengajuan.index') }}"
                    class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse($latestWithdrawalsData as $withdrawal)
                    <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $withdrawal['user_name'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $withdrawal['bank_name'] }}</p>
                                </div>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-medium bg-amber-100 dark:bg-amber-900 text-amber-700 dark:text-amber-200 rounded-md">Rp
                                {{ $withdrawal['amount'] }}</span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Metode:
                                {{ $withdrawal['method'] }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $withdrawal['time_elapsed'] }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada pengajuan penarikan terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Statistik Jenis Sampah -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Statistik Jenis Sampah</h2>
            <div class="relative h-64">
                <canvas id="chartJenisSampah" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Pertumbuhan Saldo Nasabah -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 lg:col-span-2">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pertumbuhan Saldo Nasabah</h2>
            <div class="relative h-64">
                <canvas id="chartPertumbuhanSaldo" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>
@endsection
