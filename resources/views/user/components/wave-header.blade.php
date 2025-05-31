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
                @if ($monthlyGrowth >= 0)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6" />
                    </svg>
                @endif
                <p class="text-white text-xs">{{ $monthlyGrowth >= 0 ? '+' : '' }}{{ $monthlyGrowth }}% bulan ini</p>
            </div>
            <button onclick="document.getElementById('modal-pengajuan').classList.remove('hidden')"
                class="bg-white text-primary px-4 py-2 rounded-lg font-medium text-sm">
                Ajukan Tarik Dana
            </button>
        </div>
    </div>
</div>
