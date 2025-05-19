<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-4 shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-800 dark:text-blue-200">Total Hari Transaksi</p>
                <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ $summary['total_days'] }}</p>
            </div>
            <div class="p-3 rounded-full bg-blue-200 dark:bg-blue-800">
                <i class="fas fa-calendar-day text-blue-800 dark:text-blue-200"></i>
            </div>
        </div>
    </div>

    <div class="bg-green-100 dark:bg-green-900 rounded-lg p-4 shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-green-800 dark:text-green-200">Total Transaksi</p>
                <p class="text-2xl font-bold text-green-900 dark:text-green-100">{{ $summary['total_transactions'] }}
                </p>
            </div>
            <div class="p-3 rounded-full bg-green-200 dark:bg-green-800">
                <i class="fas fa-exchange-alt text-green-800 dark:text-green-200"></i>
            </div>
        </div>
    </div>

    <div class="bg-yellow-100 dark:bg-yellow-900 rounded-lg p-4 shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Total Berat (kg)</p>
                <p class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">
                    {{ number_format($summary['total_weight'], 2) }}</p>
            </div>
            <div class="p-3 rounded-full bg-yellow-200 dark:bg-yellow-800">
                <i class="fas fa-weight text-yellow-800 dark:text-yellow-200"></i>
            </div>
        </div>
    </div>

    <div class="bg-purple-100 dark:bg-purple-900 rounded-lg p-4 shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-purple-800 dark:text-purple-200">Total Nilai (Rp)</p>
                <p class="text-2xl font-bold text-purple-900 dark:text-purple-100">
                    {{ number_format($summary['total_price'], 0, ',', '.') }}</p>
            </div>
            <div class="p-3 rounded-full bg-purple-200 dark:bg-purple-800">
                <i class="fas fa-money-bill-wave text-purple-800 dark:text-purple-200"></i>
            </div>
        </div>
    </div>
</div>
