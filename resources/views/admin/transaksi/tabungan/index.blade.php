@extends('admin.app')
@section('title', 'Transaksi Tabungan Sampah')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">

            <!-- Search and Actions -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <form class="relative w-full md:w-1/3" method="GET" action="{{ route('transaksi.index') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nasabah..."
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 bg-white placeholder-gray-400 dark:placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-primary dark:text-white dark:focus:ring-secondary focus:border-primary dark:focus:border-secondary" />
                </form>
            </div>

            <!-- Tabel Nasabah -->
            <div class="overflow-x-auto">
                @include('admin.transaksi.tabungan.components.member-table')
            </div>
        </div>
    </section>

    <script>
        let delayTimer;
        $('input[name="search"]').on('keyup', function() {
            clearTimeout(delayTimer);
            let search = $(this).val();

            delayTimer = setTimeout(() => {
                // Jika search kosong, kirim tanpa parameter search
                let requestData = {};
                if (search.trim() !== '') {
                    requestData.search = search;
                }

                $.ajax({
                    url: "{{ route('transaksi.index') }}",
                    type: "GET",
                    data: requestData,
                    success: function(data) {
                        $('.overflow-x-auto').html(data);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        showErrorAlert('Gagal memuat data. Silakan coba lagi.');
                    }
                });
            }, 300);
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let search = $('input[name="search"]').val().trim();

            // Jika search kosong, jangan sertakan parameter
            if (search === '') {
                // Hapus parameter search dari URL jika ada
                url = url.split('?')[0];
            }

            $.ajax({
                url: url,
                data: search ? {
                    search
                } : {},
                success: function(data) {
                    $('.overflow-x-auto').html(data);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    showErrorAlert('Gagal memuat data. Silakan coba lagi.');
                }
            });
        });

        // Display SweetAlert for success and error messages
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessAlert("{{ session('success') }}");
            });
        @endif

        @if (session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showErrorAlert("{{ session('error') }}");
            });
        @endif
    </script>

    @include('admin.transaksi.tabungan.components.modal-tambah-transaksi')
@endsection