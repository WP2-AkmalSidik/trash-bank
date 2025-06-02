<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Logo and Title -->
        <div class="flex items-center justify-center p-4 border-b border-gray-200 dark:border-gray-700">
            <img src="{{ asset('bs_ciherang.svg') }}" alt="Logo Bank Sampah" class="h-10 w-auto mr-3">
            <div>
                <h1 class="text-lg font-bold text-primary dark:text-secondary">BANKSAL</h1>
                <p class="text-xs text-gray-600 dark:text-gray-400">Ciherang Tunas Mulia</p>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg
                        {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125
                                  1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125
                                  1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <!-- Manajemen Nasabah -->
                <li>
                    <a href="{{ route('nasabah') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg
                        {{ request()->routeIs('nasabah*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span class="ml-3">Manajemen Nasabah</span>
                    </a>
                </li>

                <!-- Catat Tabungan -->
                <li>
                    <a href="{{ route('transaksi.index') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg
                        {{ request()->routeIs('transaksi.*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        <span class="ml-3">Catat Tabungan</span>
                    </a>
                </li>

                <!-- Pengajuan Penarikan -->
                <li>
                    <a href="{{ route('pengajuan.index') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg
                        {{ request()->routeIs('pengajuan.*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        <span class="ml-3">Pengajuan Penarikan</span>
                    </a>
                </li>

                <!-- Kelola Jenis Sampah -->
                <li>
                    <a href="{{ route('sampah.index') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg {{ request()->routeIs('sampah.*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <span class="ml-3">Jenis Sampah</span>
                    </a>
                </li>

                <!-- Management Residu Sampah -->
                <li>
                    <a href="{{ route('residu.index') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg {{ request()->routeIs('residu.*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <span class="ml-3">Residu</span>
                    </a>
                </li>

                <!-- Laporan Sampah -->
                <li>
                    <a href="{{ route('laporan.index') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg {{ request()->routeIs('laporan.*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 12h10M7 8h10M7 16h6" />
                        </svg>
                        <span class="ml-3">Laporan</span>
                    </a>
                </li>

                <!-- Informasi & Lokasi -->
                <li>
                    <button type="button"
                        class="nav-link flex items-center p-2 w-full text-base font-medium rounded-lg text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('admin/pengumuman*') || request()->is('admin/lokasi*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"
                        aria-controls="dropdown-informasi" data-collapse-toggle="dropdown-informasi">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M15.5 8.25h.008v.008H15.5V8.25zm-7.5 4.125h.008v.008H8v-.008zm0-2.25h.008v.008H8v-.008zm6-2.25h.008v.008H14v-.008zm0 2.25h.008v.008H14v-.008z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Informasi & Lokasi</span>
                        <svg class="w-6 h-6 dropdown-icon {{ request()->is('pengumuman.*') || request()->is('lokasi.*') ? 'rotate-180' : '' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-informasi"
                        class="dropdown-menu py-2 space-y-2 {{ request()->is('pengumuman.*') || request()->is('lokasi.*') ? 'active' : '' }}">
                        <li>
                            <a href="{{ route('pengumuman.index') }}"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('pengumuman.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                                </svg>
                                Pengumuman
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lokasi.index') }}"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('lokasi.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                Bank Sampah
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('profile.index') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg {{ request()->routeIs('profile.*') ? 'bg-gray-100 dark:bg-gray-700 text-primary dark:text-secondary font-semibold' : 'text-gray-900 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6 text-primary dark:text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="ml-3">Profile</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 mt-auto border-t border-gray-200 dark:border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full p-2 text-base font-medium rounded-lg text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
<!-- Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
