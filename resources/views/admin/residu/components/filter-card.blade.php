<div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
    <form method="GET" action="{{ route('residu.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="w-full md:w-1/4">
            <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan</label>
            <select id="month" name="month"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-secondary dark:focus:border-secondary">
                <option value="">Semua Bulan</option>
                @foreach ($months as $key => $name)
                    <option value="{{ $key }}" {{ $key == $month ? 'selected' : '' }}>
                        {{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/4">
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
            <select id="year" name="year"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-secondary dark:focus:border-secondary">
                @foreach ($years as $y)
                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-auto flex gap-2">
            <button type="submit"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition flex items-center gap-2">
                <i class="fa-solid fa-filter"></i>
                <span>Filter</span>
            </button>

            <a href="{{ route('residu.print', ['month' => $month, 'year' => $year]) }}" target="_blank"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fa-solid fa-print"></i>
                <span>Cetak</span>
            </a>
        </div>
    </form>
</div>
