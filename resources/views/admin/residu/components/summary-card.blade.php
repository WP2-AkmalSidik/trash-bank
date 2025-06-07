<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Sampah Masuk</h3>
                <p class="text-2xl font-bold text-primary dark:text-secondary">
                    {{ number_format($totalDeposit, 2) }} kg</p>
            </div>
            <div class="p-3 rounded-full bg-primary bg-opacity-10 dark:bg-opacity-20">
                <i class="fa-solid fa-inbox text-primary dark:text-secondary"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Residu</h3>
                <p class="text-2xl font-bold text-red-600 dark:text-red-400">
                    {{ number_format($totalResidu, 2) }} kg</p>
            </div>
            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 dark:bg-opacity-20">
                <i class="fa-solid fa-trash text-red-600 dark:text-red-400"></i>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Sampah Terpilih</h3>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                    {{ number_format($cleanWaste, 2) }} kg</p>
            </div>
            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 dark:bg-opacity-20">
                <i class="fa-solid fa-recycle text-green-600 dark:text-green-400"></i>
            </div>
        </div>
    </div>
</div>
