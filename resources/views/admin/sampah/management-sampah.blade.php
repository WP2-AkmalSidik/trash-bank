@extends('admin.app')
@section('title', 'Manajemen Sampah')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            
            <!-- Search and Actions -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <form class="relative w-full md:w-1/3" method="GET" action="{{ route('sampah.index') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari jenis sampah..."
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-600 text-gray-800 dark:text-white" />
                </form>

                <div class="flex gap-3">
                    <button onclick="openModal()"
                        class="px-4 py-2 rounded-lg bg-primary text-secondary hover:bg-opacity-90 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Jenis</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Jenis Sampah -->
            <div class="overflow-x-auto">
                @include('admin.sampah.components.waste-table')
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let delayTimer;
        $('input[name="search"]').on('keyup', function () {
            clearTimeout(delayTimer);
            let search = $(this).val();

            delayTimer = setTimeout(() => {
                $.ajax({
                    url: "{{ route('sampah.index') }}",
                    type: "GET",
                    data: { search },
                    success: function (data) {
                        $('.overflow-x-auto').html(data);
                    }
                });
            }, 300); // delay 300ms (debounce)
        });
        
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let search = $('input[name="search"]').val();

            $.ajax({
                url: url,
                data: { search },
                success: function (data) {
                    $('.overflow-x-auto').html(data);
                }
            });
        });
    </script>
    
    @include('admin.sampah.components.modal-tambah-sampah')
    @include('admin.sampah.components.modal-edit-sampah')
    @include('admin.sampah.components.modal-hapus-sampah')
@endsection