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
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-600 text-gray-800 dark:text-white" />
                </form>
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

            <!-- Tabel Nasabah -->
            <div class="overflow-x-auto">
                @include('admin.transaksi.tabungan.components.member-table')
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    data: requestData, // Hanya kirim parameter jika ada pencarian
                    success: function(data) {
                        $('.overflow-x-auto').html(data);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
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
                } : {}, // Hanya kirim search jika tidak kosong
                success: function(data) {
                    $('.overflow-x-auto').html(data);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    </script>

    @include('admin.transaksi.tabungan.components.modal-tambah-transaksi')
@endsection
