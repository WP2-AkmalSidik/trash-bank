@extends('user.layouts.app')

@section('title', 'Profil - Bank Sampah')
@section('header', 'Profil Saya')

@section('content')
    <div id="profil-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            <!-- Profil Info -->
            <div class="flex flex-col items-center mb-8">
                <div
                    class="w-24 h-24 bg-primary rounded-full mb-3 flex items-center justify-center text-white text-4xl font-bold">
                    @php
                        $nameParts = explode(' ', trim($user->name));
                        $initials = strtoupper(substr($nameParts[0], 0, 1));
                        if (count($nameParts) > 1) {
                            $initials .= strtoupper(substr($nameParts[1], 0, 1));
                        }
                    @endphp
                    {{ $initials }}
                </div>
                <h2 class="text-xl font-bold text-dark">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->memberAccount->account_number }}</p>
            </div>

            <!-- Informasi Pribadi -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-bold text-dark mb-4">Informasi Pribadi</h3>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                    <p class="font-medium">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nomor Telepon</p>
                    <p class="font-medium">{{ $user->phone_number ?? '-' }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Email</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Informasi Rekening -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-bold text-dark mb-4">Informasi Rekening</h3>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Nomor Rekening</p>
                    <p class="font-medium">{{ $user->memberAccount->account_number }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Tanggal Pembukaan</p>
                    <p class="font-medium">{{ $user->memberAccount->created_at->format('d F Y') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <div class="inline-flex items-center">
                        @php
                            $accountAge = $user->memberAccount->created_at->diffInMonths(now());
                            $isActive = $accountAge >= 6;
                        @endphp
                        <span
                            class="bg-{{ $isActive ? 'green' : 'yellow' }}-100 text-{{ $isActive ? 'green' : 'yellow' }}-600 text-xs font-medium px-2 py-1 rounded-full mr-2">
                            {{ $isActive ? 'Aktif' : 'Belum Aktif' }}
                        </span>
                        <span class="text-sm">
                            @if ($isActive)
                                Sudah bisa melakukan penarikan
                            @else
                                Belum bisa melakukan penarikan (minimal 6 bulan)
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Saldo Rekening -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-bold text-dark mb-4">Saldo Rekening</h3>
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-500">Total Saldo</p>
                    <p class="font-bold text-primary text-lg">Rp
                        {{ number_format($user->memberAccount->balance, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Pengaturan dan Logout -->
            <div class="mb-20">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logout-button"
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
    <script>
        document.getElementById('logout-button').addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: "Kamu akan keluar dari akun ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
@endsection
