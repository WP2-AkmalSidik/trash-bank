<!-- Top Navigation Bar -->
<header class="bg-white dark:bg-gray-800 shadow-md">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Mobile menu button -->
            <button id="mobile-sidebar-toggle" class="lg:hidden text-gray-500 dark:text-gray-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Spacer to push right items to the right -->
            <div class="flex-1"></div>

            <div class="flex items-center">
                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" onclick="toggleDarkMode()"
                    class="p-2 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none ml-2">
                    <!-- Sun icon for dark mode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden dark:block dark:text-secondary"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    <!-- Moon icon for light mode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 block dark:hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </button>


                <!-- Notifications dropdown -->
                <div class="relative">
                    <div class="dropdown">
                        <button onclick="openNotifications = !openNotifications"
                            class="flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline p-1 relative">
                            @if ($pendingCount > 0)
                                <span
                                    class="absolute top-0 right-0 inline-flex items-center justify-center h-5 w-5 rounded-full bg-red-500 text-white text-xs">
                                    {{ $pendingCount > 9 ? '9+' : $pendingCount }}
                                </span>
                            @endif
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button>
                        <div x-show="openNotifications" @click.away="openNotifications = false"
                            class="dropdown-content absolute right-0 mt-2 w-72 bg-white dark:bg-gray-700 rounded-md shadow-lg py-1 z-50">
                            <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-600">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Notifications</h3>
                            </div>
                            @if ($pendingCount > 0)
                                <a href="{{ route('pengajuan.index', ['status' => 'pending']) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-red-100 dark:bg-red-900 rounded-full p-1">
                                            <svg class="h-5 w-5 text-red-500 dark:text-red-300" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ $pendingCount }} pending submissions
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Requires your approval
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                    No new notifications
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="relative ml-5">
                    <div class="dropdown">
                        <button
                            class="flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline dark:text-white">
                            <img src="https://api.dicebear.com/7.x/pixel-art/svg?seed={{ Auth::user()->name }}"
                                class="h-8 w-8 rounded-full border-2 border-primary dark:border-secondary"
                                alt="User">
                            <span class="ml-2 text-gray-700 dark:text-gray-100 hidden sm:block">
                                {{ Auth::user()->name }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-1 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-content absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-600">Profil</a>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
