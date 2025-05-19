<div class="flex space-x-2 mb-6 overflow-x-auto scrollbar-hide">
    <button data-filter="all"
        class="filter-btn {{ $activeFilter === 'all' ? 'bg-primary text-white' : 'bg-white text-gray-500' }} text-sm font-medium px-4 py-2 rounded-lg">
        Semua
    </button>
    <button data-filter="tabungan"
        class="filter-btn {{ $activeFilter === 'tabungan' ? 'bg-primary text-white' : 'bg-white text-gray-500' }} text-sm font-medium px-4 py-2 rounded-lg">
        Tabungan
    </button>
    <button data-filter="penarikan"
        class="filter-btn {{ $activeFilter === 'penarikan' ? 'bg-primary text-white' : 'bg-white text-gray-500' }} text-sm font-medium px-4 py-2 rounded-lg">
        Penarikan
    </button>
    <button data-filter="lainnya"
        class="filter-btn {{ $activeFilter === 'lainnya' ? 'bg-primary text-white' : 'bg-white text-gray-500' }} text-sm font-medium px-4 py-2 rounded-lg">
        Lainnya
    </button>
</div>
