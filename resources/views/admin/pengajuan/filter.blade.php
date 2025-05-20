<div class="flex items-center gap-3">
    <form action="{{ route('pengajuan.filter') }}" method="GET" class="flex items-center gap-3">
        <div class="relative">
            <select id="status-filter" name="status"
                class="pl-3 pr-8 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-700 text-gray-800 dark:text-white appearance-none"
                onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                </option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                </option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                </option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <i class="fas fa-chevron-down text-gray-400"></i>
            </div>
        </div>
    </form>

    <!-- Refresh Button -->
    <a href="{{ route('pengajuan.index') }}" id="refresh-btn"
        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
        <i class="fas fa-sync-alt text-gray-700 dark:text-gray-300"></i>
    </a>
</div>
