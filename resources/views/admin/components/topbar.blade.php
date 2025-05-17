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

            <!-- Right side navigation items -->
            <div class="flex items-center">
                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" onclick="toggleDarkMode()"
                    class="p-2 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none ml-2">
                    <!-- Sun icon for dark mode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden dark:block dark:text-secondary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
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

                <!-- Notifications -->
                <div class="relative ml-2">
                    <button
                        class="p-2 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                        <span
                            class="absolute top-0 right-0 inline-flex items-center justify-center h-5 w-5 rounded-full bg-accent text-white text-xs">3</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>
                </div>

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div class="dropdown">
                        <button class="flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline dark:text-white">
                            <img class="h-8 w-8 rounded-full border-2 border-primary dark:border-secondary"
                                src="https://randomuser.me/api/portraits/women/2.jpg" alt="User">
                            <span class="ml-2 text-gray-700 dark:text-gray-100 hidden sm:block">Yosi Nurkhofifah</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-gray-700 dark:text-gray-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-content absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg py-1 z-50">
                            <a href="/profil"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-600">Profil</a>
                            <a href="/pengaturan"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-600">Pengaturan</a>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6A2.25 2.25 0 0015.75 18.75V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
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