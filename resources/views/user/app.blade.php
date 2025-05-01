<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <title>Bank Sampah</title>
</head>

<body class="bg-light min-h-screen">
    <div id="beranda-page" class="page active">
        <div class="wave-header p-6 pb-24 relative">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-white text-sm">Selamat datang,</p>
                    <h1 class="text-white text-xl font-bold">Budi Santoso</h1>
                </div>
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
            </div>

            <!-- Saldo Card diletakkan di sini -->
            <div class="card-balance p-4 rounded-xl bg-primary shadow-lg absolute left-5 right-5 -bottom-20">
                <p class="text-white/80 text-sm font-medium mb-1">Saldo Saat Ini</p>
                <h2 class="text-white text-2xl font-bold mb-2">Rp 350.000</h2>

                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <p class="text-white text-xs">+15% bulan ini</p>
                    </div>
                    <button class="bg-white text-primary px-4 py-2 rounded-lg font-medium text-sm">Ajukan Tarik
                        Dana</button>
                </div>
            </div>
        </div>

        <div class="px-5 pt-20">
            <!-- Harga Sampah Card -->
            <div class="card-price p-4 mb-6 bg-white rounded-xl shadow">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Harga Sampah Terkini</h3>
                    <a href="#" class="text-primary text-sm font-medium">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto scrollbar-hide -mx-1">
                    <div class="flex space-x-3 px-1 pb-2">
                        <div class="mini-card p-3 w-32 flex-shrink-0">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500">Kertas</p>
                            <p class="font-bold text-dark">Rp 3.500<span class="text-xs font-normal">/kg</span></p>
                        </div>

                        <div class="mini-card p-3 w-32 flex-shrink-0">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500">Plastik</p>
                            <p class="font-bold text-dark">Rp 2.000<span class="text-xs font-normal">/kg</span></p>
                        </div>

                        <div class="mini-card p-3 w-32 flex-shrink-0">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500">Botol</p>
                            <p class="font-bold text-dark">Rp 4.200<span class="text-xs font-normal">/kg</span></p>
                        </div>

                        <div class="mini-card p-3 w-32 flex-shrink-0">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500">Kaleng</p>
                            <p class="font-bold text-dark">Rp 12.000<span class="text-xs font-normal">/kg</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengumuman Card -->
            <div class="card-news p-4 mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Pengumuman Terbaru</h3>
                    <a href="#" class="text-primary text-sm font-medium">Lihat Semua</a>
                </div>

                <div class="bg-secondary/10 p-3 rounded-lg mb-3">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-secondary/20 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">Penyesuaian Harga Sampah</h4>
                            <p class="text-gray-500 text-sm mb-2">Harga sampah kaleng naik menjadi Rp 12.000/kg mulai 1
                                Mei 2025</p>
                            <p class="text-xs text-gray-400">Diposting 1 jam yang lalu</p>
                        </div>
                    </div>
                </div>

                <div class="bg-primary/10 p-3 rounded-lg">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">Acara Edukasi Bank Sampah</h4>
                            <p class="text-gray-500 text-sm mb-2">Ikuti acara edukasi bank sampah dan daur ulang pada
                                Sabtu, 10 Mei 2025</p>
                            <p class="text-xs text-gray-400">Diposting 5 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Terakhir -->
            <div class="mb-20">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Transaksi Terakhir</h3>
                    <a href="#" class="text-primary text-sm font-medium" onclick="showPage('transaksi-page')">Lihat
                        Semua</a>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-dark">Setoran Sampah</h4>
                                <p class="text-gray-500 text-xs">29 Apr 2025</p>
                            </div>
                        </div>
                        <p class="font-bold text-green-600">+Rp 45.000</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-dark">Tarik Dana (DANA)</h4>
                                <p class="text-gray-500 text-xs">27 Apr 2025</p>
                            </div>
                        </div>
                        <p class="font-bold text-red-600">-Rp 100.000</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-dark">Setoran Sampah</h4>
                                <p class="text-gray-500 text-xs">25 Apr 2025</p>
                            </div>
                        </div>
                        <p class="font-bold text-green-600">+Rp 28.500</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Page -->
    <div id="pengajuan-page" class="page">
        <div class="bg-primary py-6 px-5 rounded-b-3xl">
            <h1 class="text-white text-xl font-bold">Pengajuan Tarik Dana</h1>
        </div>

        <div class="p-5">
            <!-- Status Pengajuan -->
            <div class="card-balance p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-white text-lg font-bold">Status Pengajuan</h2>
                    <div class="bg-secondary/80 text-xs text-white font-medium px-2 py-1 rounded-full">Aktif</div>
                </div>
                <p class="text-white/80 text-sm mb-3">Saldo yang dapat ditarik</p>
                <h3 class="text-white text-2xl font-bold mb-4">Rp 250.000</h3>

                <div class="bg-white/20 p-3 rounded-lg">
                    <div class="flex justify-between text-white/90 text-sm mb-1">
                        <span>Periode menabung</span>
                        <span>8 bulan</span>
                    </div>
                    <div class="flex justify-between text-white/90 text-sm">
                        <span>Minimal saldo</span>
                        <span>Rp 100.000</span>
                    </div>
                </div>
            </div>

            <!-- Button Ajukan Penarikan -->
            <button class="w-full bg-primary text-white font-medium py-3 rounded-xl mb-6 shadow-md">Ajukan Penarikan
                Dana</button>

            <!-- Riwayat Pengajuan -->
            <div class="mb-20">
                <h3 class="font-bold text-dark mb-4">Riwayat Pengajuan</h3>

                <div class="bg-white rounded-lg shadow-sm p-4 mb-3">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-semibold text-dark">Pengajuan #1294</h4>
                        <div class="bg-green-100 text-green-600 text-xs font-medium px-2 py-1 rounded-full">Sukses</div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Tanggal</span>
                        <span>27 Apr 2025</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Jumlah</span>
                        <span class="font-medium">Rp 100.000</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Metode</span>
                        <span>DANA (08123456789)</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-4 mb-3">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-semibold text-dark">Pengajuan #1183</h4>
                        <div class="bg-red-100 text-red-600 text-xs font-medium px-2 py-1 rounded-full">Ditolak</div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Tanggal</span>
                        <span>15 Mar 2025</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Jumlah</span>
                        <span class="font-medium">Rp 200.000</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-3">
                        <span>Metode</span>
                        <span>Tunai</span>
                    </div>
                    <div class="bg-red-50 p-2 rounded text-xs text-red-600">
                        Saldo tidak mencukupi minimum setelah penarikan
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-semibold text-dark">Pengajuan #1092</h4>
                        <div class="bg-green-100 text-green-600 text-xs font-medium px-2 py-1 rounded-full">Sukses</div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Tanggal</span>
                        <span>10 Feb 2025</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Jumlah</span>
                        <span class="font-medium">Rp 150.000</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Metode</span>
                        <span>GoPay (08123456789)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi Page -->
    <div id="transaksi-page" class="page">
        <div class="bg-primary py-6 px-5 rounded-b-3xl">
            <h1 class="text-white text-xl font-bold">Riwayat Transaksi</h1>
        </div>

        <div class="p-5">
            <!-- Filter -->
            <div class="flex space-x-2 mb-6 overflow-x-auto scrollbar-hide">
                <button class="bg-primary text-white text-sm font-medium px-4 py-2 rounded-lg">Semua</button>
                <button class="bg-white text-gray-500 text-sm font-medium px-4 py-2 rounded-lg">Tabungan</button>
                <button class="bg-white text-gray-500 text-sm font-medium px-4 py-2 rounded-lg">Penarikan</button>
                <button class="bg-white text-gray-500 text-sm font-medium px-4 py-2 rounded-lg">Lainnya</button>
            </div>

            <!-- Transaksi List -->
            <div class="mb-20">
                <div class="mb-4">
                    <h3 class="text-gray-500 text-sm mb-2">Mei 2025</h3>

                    <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark">Setoran Sampah</h4>
                                    <p class="text-gray-500 text-xs">
                                        <span class="mr-1">29 Apr 2025</span>
                                        <span
                                            class="bg-green-50 text-green-600 text-xs px-2 py-0.5 rounded-full">Masuk</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-green-600">+Rp 45.000</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="text-gray-500 text-sm mb-2">April 2025</h3>

                    <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark">Tarik Dana (DANA)</h4>
                                    <p class="text-gray-500 text-xs">
                                        <span class="mr-1">27 Apr 2025</span>
                                        <span
                                            class="bg-red-50 text-red-600 text-xs px-2 py-0.5 rounded-full">Keluar</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-red-600">-Rp 100.000</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark">Setoran Sampah</h4>
                                    <p class="text-gray-500 text-xs">
                                        <span class="mr-1">25 Apr 2025</span>
                                        <span
                                            class="bg-green-50 text-green-600 text-xs px-2 py-0.5 rounded-full">Masuk</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-green-600">+Rp 28.500</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark">Bonus Sampah Rutin</h4>
                                    <p class="text-gray-500 text-xs">
                                        <span class="mr-1">15 Apr 2025</span>
                                        <span
                                            class="bg-green-50 text-green-600 text-xs px-2 py-0.5 rounded-full">Masuk</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-green-600">+Rp 10.000</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm mb-2">Maret 2025</h3>

                    <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark">Setoran Sampah</h4>
                                    <p class="text-gray-500 text-xs">
                                        <span class="mr-1">28 Mar 2025</span>
                                        <span
                                            class="bg-green-50 text-green-600 text-xs px-2 py-0.5 rounded-full">Masuk</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-green-600">+Rp 52.500</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark">Tarik Dana (Tunai)</h4>
                                    <p class="text-gray-500 text-xs">
                                        <span class="mr-1">10 Mar 2025</span>
                                        <span
                                            class="bg-red-50 text-red-600 text-xs px-2 py-0.5 rounded-full">Keluar</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-red-600">-Rp 150.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profil Page -->
    <div id="profil-page" class="page">
        <div class="bg-primary py-6 px-5 rounded-b-3xl">
            <h1 class="text-white text-xl font-bold">Profil Saya</h1>
        </div>

        <div class="p-5">
            <!-- Profil Info -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-24 h-24 bg-gray-200 rounded-full mb-3 relative">
                    <div class="absolute inset-0 rounded-full overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-8 h-8 bg-primary rounded-full flex items-center justify-center border-2 border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-xl font-bold text-dark">Budi Santoso</h2>
                <p class="text-gray-500">ID: NS-20211015</p>
            </div>

            <!-- Informasi Pribadi -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-bold text-dark mb-4">Informasi Pribadi</h3>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                    <p class="font-medium">Budi Santoso</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nomor Telepon</p>
                    <p class="font-medium">081234567890</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Email</p>
                    <p class="font-medium">budi.santoso@email.com</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Alamat</p>
                    <p class="font-medium">Jl. Purnama Indah No. 123, RT 002/RW 003, Kelurahan Sejahtera, Kecamatan
                        Makmur, Kota Jakarta Selatan</p>
                </div>
            </div>

            <!-- Informasi Rekening -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-bold text-dark mb-4">Informasi Rekening</h3>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nomor Rekening</p>
                    <p class="font-medium">BK-2021-10-0015</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Tanggal Pembukaan</p>
                    <p class="font-medium">15 Oktober 2021</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <div class="inline-flex items-center">
                        <span
                            class="bg-green-100 text-green-600 text-xs font-medium px-2 py-1 rounded-full mr-2">Aktif</span>
                        <span class="text-sm">Sudah bisa melakukan penarikan</span>
                    </div>
                </div>
            </div>

            <!-- Rekening E-Wallet -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-8">
                <h3 class="font-bold text-dark mb-4">Rekening E-Wallet Terhubung</h3>

                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="font-bold text-blue-600">D</span>
                        </div>
                        <div>
                            <h4 class="font-medium">DANA</h4>
                            <p class="text-gray-500 text-xs">081234567890</p>
                        </div>
                    </div>
                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <span class="font-bold text-green-600">G</span>
                        </div>
                        <div>
                            <h4 class="font-medium">GoPay</h4>
                            <p class="text-gray-500 text-xs">081234567890</p>
                        </div>
                    </div>
                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pengaturan dan Logout -->
            <div class="mb-20">
                <button class="w-full bg-white flex items-center justify-between p-4 rounded-lg shadow-sm mb-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Pengaturan</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <button class="w-full bg-white flex items-center justify-between p-4 rounded-lg shadow-sm mb-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Bantuan</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 text-red-600 font-medium py-3 rounded-xl">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around p-3">
        <button onclick="showPage('beranda-page')" class="flex flex-col items-center text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-xs mt-1">Beranda</span>
        </button>

        <button onclick="showPage('pengajuan-page')" class="flex flex-col items-center text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            <span class="text-xs mt-1">Pengajuan</span>
        </button>

        <button onclick="showPage('transaksi-page')" class="flex flex-col items-center text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
            <span class="text-xs mt-1">Transaksi</span>
        </button>

        <button onclick="showPage('profil-page')" class="flex flex-col items-center text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-xs mt-1">Profil</span>
        </button>
    </div>

    <script>
        // Fungsi untuk menampilkan halaman tertentu
        function showPage(pageId) {
            // Sembunyikan semua halaman
            const pages = document.querySelectorAll('.page');
            pages.forEach(page => {
                page.classList.remove('active');
            });

            // Tampilkan halaman yang dipilih
            document.getElementById(pageId).classList.add('active');

            // Update status nav button
            const navButtons = document.querySelectorAll('.fixed.bottom-0 button');
            navButtons.forEach(button => {
                button.classList.remove('text-primary');
                button.classList.add('text-gray-400');
            });

            // Set active nav button
            const activeButton = document.querySelector(`.fixed.bottom-0 button[onclick="showPage('${pageId}')"]`);
            activeButton.classList.remove('text-gray-400');
            activeButton.classList.add('text-primary');
        }
    </script>
</body>

</html>
