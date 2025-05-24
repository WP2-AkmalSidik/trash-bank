<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <form class="relative w-full md:w-1/3" method="GET" action="{{ route('residu.index') }}">
        <input type="hidden" name="month" value="{{ $month }}">
        <input type="hidden" name="year" value="{{ $year }}">

        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <i class="fa-solid fa-search text-gray-400"></i>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari residu sampah..."
            class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 bg-white placeholder-gray-400 dark:placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-primary dark:text-white dark:focus:ring-secondary focus:border-primary dark:focus:border-secondary" />
    </form>

    <div class="flex gap-3">
        <button onclick="openAddModal()"
            class="px-4 py-2 rounded-lg bg-primary text-secondary hover:bg-opacity-90 transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Tambah Residu</span>
        </button>
    </div>
</div>
