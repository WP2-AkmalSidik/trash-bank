@extends('admin.app')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Nasabah -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Nasabah</p>
                    <p class="text-2xl font-bold text-gray-900">235</p>
                    <p class="text-xs text-green-600 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-3 h-3 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                        15% bulan ini
                    </p>
                </div>
                <div class="p-3 bg-emerald-500/10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Sampah Masuk (kg) -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Sampah Masuk</p>
                    <p class="text-2xl font-bold text-gray-900">1,284 kg</p>
                    <p class="text-xs text-green-600 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-3 h-3 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                        8% minggu ini
                    </p>
                </div>
                <div class="p-3 bg-blue-500/10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Penarikan Dana -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Penarikan Dana</p>
                    <p class="text-2xl font-bold text-gray-900">Rp 5,4 jt</p>
                    <p class="text-xs text-red-600 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-3 h-3 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                        3% minggu ini
                    </p>
                </div>
                <div class="p-3 bg-amber-500/10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-amber-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Jumlah Bank Sampah -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Bank Sampah</p>
                    <p class="text-2xl font-bold text-gray-900">12</p>
                    <p class="text-xs text-green-600 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-3 h-3 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                        2 baru
                    </p>
                </div>
                <div class="p-3 bg-purple-500/10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-purple-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Chart - Statistik Sampah Masuk -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Statistik Sampah Masuk (kg)
                </h2>
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-md">Mingguan</button>
                    <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md">Bulanan</button>
                    <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md">Tahunan</button>
                </div>
            </div>
            <div class="relative h-72">
                <!-- Chart Canvas -->
                <canvas id="chartSampahMasuk" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Pengajuan Penarikan Terbaru -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Pengajuan Penarikan</h2>
                <a href="#" class="text-sm text-emerald-600 hover:underline">Lihat
                    Semua</a>
            </div>
            <div class="space-y-3">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/men/1.jpg"
                                alt="Nasabah">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Ahmad Suparman
                                </p>
                                <p class="text-xs text-gray-500">Bank Sampah Berseri</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-md">Rp
                            250.000</span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-500">Metode: DANA</span>
                        <span class="text-xs text-gray-500">5 jam lalu</span>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/women/2.jpg"
                                alt="Nasabah">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Siti Nurhaliza
                                </p>
                                <p class="text-xs text-gray-500">Bank Sampah Lestari</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-md">Rp
                            175.000</span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-500">Metode: OVO</span>
                        <span class="text-xs text-gray-500">10 jam lalu</span>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/men/3.jpg"
                                alt="Nasabah">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Budi Santoso
                                </p>
                                <p class="text-xs text-gray-500">Bank Sampah Sejahtera
                                </p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-md">Rp
                            320.000</span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-500">Metode: Tunai</span>
                        <span class="text-xs text-gray-500">1 hari lalu</span>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/women/4.jpg"
                                alt="Nasabah">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Rina Wati</p>
                                <p class="text-xs text-gray-500">Bank Sampah Berseri</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-md">Rp
                            150.000</span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-500">Metode: GoPay</span>
                        <span class="text-xs text-gray-500">2 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Statistik Jenis Sampah -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Jenis Sampah</h2>
            <div class="relative h-64">
                <canvas id="chartJenisSampah" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Pertumbuhan Saldo Nasabah -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Pertumbuhan Saldo Nasabah
            </h2>
            <div class="relative h-64">
                <canvas id="chartPertumbuhanSaldo" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>
@endsection
