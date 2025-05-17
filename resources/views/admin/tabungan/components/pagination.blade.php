@if ($members->hasPages())
    <div class="px-4 py-3 border-t dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan {{ $members->firstItem() }} - {{ $members->lastItem() }} dari {{ $members->total() }} hasil
        </div>
        <div class="flex items-center space-x-1">
            <!-- Previous Page Link -->
            @if ($members->onFirstPage())
                <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 cursor-not-allowed">
                    &laquo;
                </span>
            @else
                <a href="{{ $members->previousPageUrl() }}" 
                   class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    &laquo;
                </a>
            @endif

            <!-- First Page Link -->
            @if ($members->currentPage() > 3)
                <a href="{{ $members->url(1) }}" 
                   class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    1
                </a>
                @if ($members->currentPage() > 4)
                    <span class="px-2 py-1 text-gray-500">...</span>
                @endif
            @endif

            <!-- Pagination Elements (limited to 5 pages around current) -->
            @php
                $start = max(1, $members->currentPage() - 2);
                $end = min($members->lastPage(), $members->currentPage() + 2);
            @endphp
            
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $members->currentPage())
                    <span class="px-3 py-1 rounded-md bg-primary text-white cursor-default">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $members->url($page) }}" 
                       class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            <!-- Last Page Link -->
            @if ($members->currentPage() < $members->lastPage() - 2)
                @if ($members->currentPage() < $members->lastPage() - 3)
                    <span class="px-2 py-1 text-gray-500">...</span>
                @endif
                <a href="{{ $members->url($members->lastPage()) }}" 
                   class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    {{ $members->lastPage() }}
                </a>
            @endif

            <!-- Next Page Link -->
            @if ($members->hasMorePages())
                <a href="{{ $members->nextPageUrl() }}" 
                   class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    &raquo;
                </a>
            @else
                <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 cursor-not-allowed">
                    &raquo;
                </span>
            @endif
        </div>
    </div>
    @endif