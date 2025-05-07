@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="flex items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="flex items-center justify-center w-8 h-8 rounded-l-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-500 dark:text-gray-300 opacity-50 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="flex items-center justify-center w-8 h-8 rounded-l-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span
                        class="flex items-center justify-center w-8 h-8 border-t border-b border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="flex items-center justify-center w-8 h-8 border-t border-b border-gray-200 dark:border-gray-600 bg-primary text-white font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="flex items-center justify-center w-8 h-8 border-t border-b border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="flex items-center justify-center w-8 h-8 rounded-r-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </a>
            @else
                <span
                    class="flex items-center justify-center w-8 h-8 rounded-r-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-500 dark:text-gray-300 opacity-50 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
