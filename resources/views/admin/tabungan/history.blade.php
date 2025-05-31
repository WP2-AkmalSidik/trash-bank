@extends('admin.app')
@section('title', 'Riwayat Transaksi')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Header with back button and member info -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('transaksi.index') }}"
                        class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <div class="flex items-center gap-2 mt-1">
                            <div
                                class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-700 dark:text-gray-300 font-semibold">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <span class="font-medium">{{ $member->name }}</span>
                            <span class="text-gray-500 dark:text-gray-400">•</span>
                            <span
                                class="text-gray-600 dark:text-gray-300">{{ $member->memberAccount->account_number }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="bg-blue-100 dark:bg-blue-900 px-4 py-2 rounded-lg">
                        <span class="text-gray-600 dark:text-gray-300">Total Saldo:</span>
                        <span class="font-bold text-blue-600 dark:text-blue-300 ml-2 total-balance">
                            Rp {{ number_format($totalBalance, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Export PDF Button -->
                    <a href="{{ route('transaksi.print-history', $member->id) }}"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span>Export PDF</span>
                    </a>
                </div>
            </div>

            <!-- Alert Message -->
            @if (session('success'))
                <div id="alert-success"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i onclick="document.getElementById('alert-success').remove()"
                            class="fa-solid fa-times cursor-pointer"></i>
                    </span>
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i onclick="document.getElementById('alert-error').remove()"
                            class="fa-solid fa-times cursor-pointer"></i>
                    </span>
                </div>
            @endif

            <!-- Transaction History Table -->
            <div class="overflow-x-auto">
                @include('admin.tabungan.components.history-table')
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t dark:border-gray-700">
                {{ $transactions->links() }}
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            // Event listener untuk tombol hapus
            $(document).on('click', '.delete-transaction', function() {
                const transactionId = $(this).data('id');
                confirmDelete(transactionId);
            });

            // Fungsi konfirmasi hapus
            function confirmDelete(transactionId) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Transaksi ini akan dihapus dan saldo nasabah akan dikurangi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteTransaction(transactionId);
                    }
                });
            }

            // Fungsi hapus transaksi
            function deleteTransaction(transactionId) {
                Swal.fire({
                    title: 'Menghapus Transaksi',
                    text: 'Sedang memproses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: `/admin/transaksi/histori/${transactionId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // Hapus baris dari tabel
                        $(`#row-transaction-${transactionId}`).fadeOut(300, function() {
                            $(this).remove();

                            // Update saldo yang ditampilkan
                            $('.total-balance').text('Rp ' + response.balance.replace(
                                /\B(?=(\d{3})+(?!\d))/g, "."));

                            // Jika tabel kosong, reload halaman
                            if ($('tbody tr').length <= 1) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan saat menghapus transaksi'
                        });
                    }
                });
            }

            // Handle print receipt dengan SweetAlert
            $(document).on('click', '.print-receipt', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');

                Swal.fire({
                    title: 'Mempersiapkan Struk',
                    text: 'Sedang memuat data struk...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        window.open(url, '_blank');
                        setTimeout(() => {
                            Swal.close();
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endsection
