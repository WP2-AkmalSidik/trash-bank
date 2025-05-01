<!-- Sidebar -->
<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Logo and Title -->
        <div class="flex items-center justify-center p-4 border-b border-gray-200">
            <img src="{{ asset('bs_ciherang.svg') }}" alt="Logo Bank Sampah" class="h-10 w-auto mr-3">
            <div>
                <h1 class="text-lg font-bold text-primary">TRASH BANK</h1>
                <p class="text-xs text-gray-600">Ciherang Tunas Mulia</p>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <!-- Manajemen Nasabah -->
                <li>
                    <a href="{{ route('nasabah') }}"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span class="ml-3">Manajemen Nasabah</span>
                    </a>
                </li>

                <!-- Transaksi Tabungan -->
                <li>
                    <button type="button"
                        class="nav-link flex items-center p-2 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100"
                        aria-controls="dropdown-transaksi" data-collapse-toggle="dropdown-transaksi">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Transaksi</span>
                        <svg class="w-6 h-6 dropdown-icon" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-transaksi" class="dropdown-menu hidden space-y-2">
                        <li>
                            <a href="/transaksi/tabungan"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Catat
                                Tabungan</a>
                        </li>
                        <li>
                            <a href="/transaksi/pengajuan"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Pengajuan
                                Penarikan</a>
                        </li>
                        <li>
                            <a href="/transaksi/history"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Riwayat
                                Transaksi</a>
                        </li>
                    </ul>
                </li>

                <!-- Kelola Jenis Sampah -->
                <li>
                    <a href="/jenis-sampah"
                        class="nav-link flex items-center p-2 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <span class="ml-3">Jenis Sampah</span>
                    </a>
                </li>

                <!-- Laporan -->
                <li>
                    <button type="button"
                        class="nav-link flex items-center p-2 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100"
                        aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Laporan</span>
                        <svg class="w-6 h-6 dropdown-icon" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-laporan" class="dropdown-menu hidden space-y-2">
                        <li>
                            <a href="/laporan/transaksi"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Laporan
                                Transaksi</a>
                        </li>
                        <li>
                            <a href="/laporan/keuangan"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Laporan
                                Keuangan</a>
                        </li>
                        <li>
                            <a href="/laporan/sampah"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Laporan
                                Sampah</a>
                        </li>
                    </ul>
                </li>

                <!-- Pengaturan -->
                <li>
                    <button type="button"
                        class="nav-link flex items-center p-2 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100"
                        aria-controls="dropdown-pengaturan" data-collapse-toggle="dropdown-pengaturan">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Pengaturan</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-pengaturan" class="dropdown-menu hidden py-2 space-y-2">
                        <li>
                            <a href="/pengaturan/profil-bank"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Profil
                                Bank Sampah</a>
                        </li>
                        <li>
                            <a href="/pengaturan/pengguna"
                                class="nav-link-child flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg text-gray-900 hover:bg-gray-100">Manajemen
                                Pengguna</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 mt-auto border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full p-2 text-base font-medium rounded-lg text-red-600 hover:bg-gray-100">
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

