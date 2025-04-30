<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Desa - Kabupaten Tasikmalaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> 
    @vite('resources/css/app.css')

    @include('admin.script')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <script src="{{ asset('js/admin.js') }}"></script>
</head>

<body class="font-sans antialiased min-h-screen bg-light dark:bg-dark transition-colors duration-300">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-dark shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">
            <!-- Logo and Title -->
            <div class="flex items-center justify-center p-4 border-b border-gray-200 dark:border-gray-700">
                <img src="{{ asset('logo_kab_tsk.svg') }}" alt="Logo Kabupaten Tasikmalaya" class="h-10 w-auto mr-3">
                <div>
                    <h1 class="text-lg font-bold text-primary dark:text-white">Admin Desa</h1>
                    <p class="text-xs text-gray-600 dark:text-gray-300">Desa Tunawijaya</p>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                <ul class="space-y-2">
                    <li>
                        <a href="/dashboard"
                            class="flex items-center p-2 text-base font-medium rounded-lg text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/pengajuan-sk"
                            class="flex items-center p-2 text-base font-medium rounded-lg text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="ml-3">Pengajuan SK</span>
                        </a>
                    </li>
                    <li>
                        <a href="/history-pengaduan"
                            class="flex items-center p-2 text-base font-medium rounded-lg text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-3">History Pengaduan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/Manajemen-berita"
                            class="flex items-center p-2 w-full text-base font-medium rounded-lg text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">Manajemen Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="/manajemen-user"
                            class="flex items-center p-2 text-base font-medium rounded-lg text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span class="ml-3">Manajemen RT</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 mt-auto border-t border-gray-200 dark:border-gray-700">
                <a href="/logout"
                    class="flex items-center p-2 text-base font-medium rounded-lg text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="ml-3">Logout</span>
                </a>
            </div>
        </div>
    </aside>
    <!-- Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="lg:ml-64 transition-all duration-300">
        <!-- Top Navigation Bar -->
        <header class="bg-white dark:bg-gray-800 shadow-md">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Mobile menu button -->
                    <button id="mobile-sidebar-toggle" class="lg:hidden text-gray-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Search Bar -->
                    <div class="relative flex-1 max-w-md mx-4">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input type="text"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Cari...">
                    </div>

                    <!-- Right side navigation items -->
                    <div class="flex items-center">
                        <!-- Dark Mode Toggle -->
                        <button onclick="toggleDarkMode()"
                            class="p-2 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none ml-2">
                            <!-- Sun icon for dark mode -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 hidden dark:block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                            <!-- Moon icon for light mode -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 block dark:hidden">
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </button>
                        </div>

                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div class="dropdown">
                                <button
                                    class="flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline">
                                    <img class="h-8 w-8 rounded-full border-2 border-primary"
                                        src="https://randomuser.me/api/portraits/men/7.jpg" alt="User">
                                    <span class="ml-2 text-gray-700 dark:text-gray-200 hidden sm:block">Akmal Sidik</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 ml-1 text-gray-700 dark:text-gray-200">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-content absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                    <a href="/profil"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Profil</a>
                                    <a href="/pengaturan"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Pengaturan</a>
                                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                                    <a href="/logout"
                                        class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="container mx-auto px-4 py-6 animate-fadeIn">
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/"
                                class="inline-flex items-center text-sm font-medium text-primary dark:text-secondary hover:text-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                Beranda
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                                <span
                                    class="ml-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ml-2">Dashboard</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Surat Pengajuan Masuk -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-primary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Surat Masuk</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">125</p>
                            <p class="text-xs text-green-600 dark:text-green-400 flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                                12% minggu ini
                            </p>
                        </div>
                        <div class="p-3 bg-primary/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Surat Disetujui -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Surat Disetujui</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">98</p>
                            <p class="text-xs text-green-600 dark:text-green-400 flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                                8% minggu ini
                            </p>
                        </div>
                        <div class="p-3 bg-green-500/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Surat Ditolak -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-accent">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Surat Ditolak</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">27</p>
                            <p class="text-xs text-red-600 dark:text-red-400 flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                3% minggu ini
                            </p>
                        </div>
                        <div class="p-3 bg-accent/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-accent">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Jumlah RT -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-secondary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total RT</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">42</p>
                            <p class="text-xs text-green-600 dark:text-green-400 flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                                2 baru
                            </p>
                        </div>
                        <div class="p-3 bg-secondary/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Chart - Statistik Surat -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 lg:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Statistik Pengajuan Surat</h2>
                    <div class="relative h-72">
                        <!-- Chart Canvas -->
                        <canvas id="chartStatistik" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- RT List -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar RT Aktif</h2>
                        <a href="#" class="text-sm text-primary dark:text-secondary hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/men/1.jpg"
                                alt="RT">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Ahmad Sudrajat</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">RT 001 - Kampung Ciborelang</p>
                            </div>
                        </div>
                        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/men/2.jpg"
                                alt="RT">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Dedi Firmansyah</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">RT 002 - Kampung Sukamanah</p>
                            </div>
                        </div>
                        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/women/3.jpg"
                                alt="RT">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Siti Nurhasanah</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">RT 003 - Kampung Pasirlimus</p>
                            </div>
                        </div>
                        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/men/4.jpg"
                                alt="RT">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Rudi Hartono</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">RT 004 - Kampung Cigadog</p>
                            </div>
                        </div>
                        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/men/5.jpg"
                                alt="RT">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Hendra Setiawan</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">RT 005 - Kampung Pagelaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 shadow-md mt-6">
            <div class="max-w-full mx-auto px-4 py-6 md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start">
                    <span class="text-sm text-gray-500 dark:text-gray-400">© 2025 Desa Tunawijaya - Kabupaten
                        Tasikmalaya</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- Chart.js script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/sidebar.js') }}" ></script>

</body>

</html>
