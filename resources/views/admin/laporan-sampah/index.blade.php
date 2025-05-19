@extends('admin.app')
@section('title', 'Laporan Sampah')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Title and Export Button -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    <i class="fas fa-recycle mr-2 text-green-500"></i>Laporan Deposit Sampah
                </h1>
                <div class="flex space-x-2">
                    <button onclick="confirmExport()"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                        <i class="fas fa-file-pdf mr-2"></i>Export PDF
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6">
                <form id="filterForm" method="GET" action="{{ route('laporan.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Year Selector -->
                    <div class="space-y-2">
                        <label for="year" class="text-sm font-medium text-gray-700 dark:text-gray-300">Tahun</label>
                        <select id="year" name="year"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary bg-white focus:border-primary dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Month Selector -->
                    <div class="space-y-2">
                        <label for="month" class="text-sm font-medium text-gray-700 dark:text-gray-300">Bulan</label>
                        <select id="month" name="month"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary bg-white focus:border-primary dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">Semua Bulan</option>
                            @foreach($months as $key => $name)
                                <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Waste Type Filter -->
                    <div class="space-y-2">
                        <label for="waste_type_id" class="text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Sampah</label>
                        <select id="waste_type_id" name="waste_type_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none bg-white focus:ring-primary focus:border-primary dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">Semua Jenis</option>
                            @foreach($wasteTypes as $wasteType)
                                <option value="{{ $wasteType->id }}" {{ $selectedWasteTypeId == $wasteType->id ? 'selected' : '' }}>
                                    {{ $wasteType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="md:col-span-3 flex justify-end gap-2">
                        <button type="button" onclick="resetFilters()"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Summary Cards -->
            @include('admin.laporan-sampah.partials.summary-cards')

            <!-- Waste Types Table -->
            @include('admin.laporan-sampah.partials.waste-table')
        </div>
    </div>

    <script>
        // Confirm PDF export
        function confirmExport() {
            Swal.fire({
                title: 'Export Laporan PDF?',
                text: 'Anda akan mengunduh laporan dalam format PDF',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Export!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('filterForm');
                    const exportInput = document.createElement('input');
                    exportInput.type = 'hidden';
                    exportInput.name = 'export';
                    exportInput.value = 'pdf';
                    form.appendChild(exportInput);
                    form.submit();
                }
            });
        }

        // Reset filters
        function resetFilters() {
            window.location.href = "{{ route('laporan.index') }}";
        }
    </script>
@endsection