@extends('user.layouts.app')

@section('title', 'Profil - Bank Sampah')
@section('header', 'Profil Saya')

@section('content')
    <div id="profil-page" class="page active">
        @include('user.components.header')

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
                <p class="text-gray-500">NS-20211015</p>
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
            </div>

            <!-- Informasi Rekening -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-bold text-dark mb-4">Informasi Rekening</h3>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nomor Rekening</p>
                    <p class="font-medium">NS-20211015</p>
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

            <!-- Pengaturan dan Logout -->
            <div class="mb-20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 font-medium py-3 rounded-xl hover:bg-red-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>

            </div>

        </div>
    </div>
@endsection
