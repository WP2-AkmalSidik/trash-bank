<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">@yield('title')</h1>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 -mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-primary dark:text-secondary dark:hover:text-yellow-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    TrashBank
                </a>
            </li>
            <li>
                <div
                    class="flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700 dark:text-secondary dark:hover:text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    @yield('title')
                </div>
            </li>
        </ol>
    </nav>
</div>
