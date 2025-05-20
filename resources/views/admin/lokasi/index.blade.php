@extends('admin.app')
@section('title', 'Lokasi Bank Sampah')
@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Search and Actions -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <form id="searchForm" class="relative w-full md:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lokasi bank..."
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 bg-white placeholder-gray-400 dark:placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-primary dark:text-white focus:ring-blue-500 dark:focus:ring-blue-500 focus:border-blue-500 dark:focus:border-blue-500" />
                </form>

                <div class="flex gap-3">
                    <button id="addLocationBtn"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-opacity-90 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Lokasi</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Lokasi -->
            <div class="overflow-x-auto" id="location-table-container">
                @include('admin.lokasi.table')
            </div>
        </div>
    </section>

    <!-- Add/Edit Modal -->
    <div id="locationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <form id="locationForm">
                    @csrf
                    <input type="hidden" id="locationId" name="id">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4" id="modalTitle">Tambah
                            Lokasi Bank Sampah</h3>
                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lokasi</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-3 py-2 bg-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <textarea name="address" id="address" rows="2"
                                class="w-full px-3 py-2 bg-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="url_maps"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Embed Google
                                Maps</label>
                            <textarea name="url_maps" id="url_maps" rows="4"
                                class="w-full px-3 py-2 bg-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Salin embed iframe dari Google Maps</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Preview
                                Peta</label>
                            <div id="mapPreview"
                                class="w-full h-64 bg-gray-100 dark:bg-gray-700 rounded-md overflow-hidden">
                                <p class="text-center text-gray-500 dark:text-gray-400 mt-28">Preview peta akan muncul di
                                    sini</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" id="cancelBtn"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // CSRF Token for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Event listener untuk tombol tambah
            $('#addLocationBtn').click(openAddModal);

            // Event listener untuk tombol batal
            $('#cancelBtn').click(closeModal);

            // Search Functionality
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                loadLocations($('input[name="search"]').val());
            });

            $('input[name="search"]').on('keyup', function() {
                if ($(this).val() === '') {
                    loadLocations('');
                }
            });

            // Load locations with pagination
            function loadLocations(search = '') {
                $('#location-table-container').html(
                    '<div class="text-center py-10 text-gray-500">Memuat data...</div>');
                $.get('{{ route('lokasi.index') }}', {
                    search: search
                }, function(data) {
                    $('#location-table-container').html($(data).find('#location-table-container').html());
                });
            }

            // Pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let search = $('input[name="search"]').val();
                fetchLocations(page, search);
            });

            function fetchLocations(page, search) {
                $('#location-table-container').html(
                    '<div class="text-center py-10 text-gray-500">Memuat data halaman...</div>');
                $.get(`{{ route('lokasi.index') }}?page=${page}&search=${search}`, function(data) {
                    $('#location-table-container').html($(data).find('#location-table-container').html());
                });
            }

            // Update map preview
            $('#url_maps').on('input', function() {
                let iframe = $(this).val();
                if (iframe.includes('<iframe')) {
                    $('#mapPreview').html(iframe);
                } else {
                    $('#mapPreview').html(
                        '<p class="text-center text-gray-500 dark:text-gray-400 mt-28">Kode embed tidak valid</p>'
                    );
                }
            });

            // Modal Functions
            function openAddModal() {
                $('#modalTitle').text('Tambah Lokasi Bank Sampah');
                $('#locationId').val('');
                $('#name').val('');
                $('#address').val('');
                $('#url_maps').val('');
                $('#mapPreview').html(
                    '<p class="text-center text-gray-500 dark:text-gray-400 mt-28">Preview peta akan muncul di sini</p>'
                );
                $('#locationModal').removeClass('hidden');
            }

            // Tambahkan ini untuk membuat fungsi global
            window.openEditModal = function(id) {
                console.log('Opening edit modal for ID:', id);

                const editBtn = $(`button[data-id="${id}"]`);
                const originalHtml = editBtn.html();
                editBtn.html(`
                    <span class="inline-block w-4 h-4 mr-2 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                    `).prop('disabled', true);

                $.ajax({
                    url: '{{ url('admin/lokasi') }}/' + id,
                    type: 'GET',
                    success: function(data) {
                        editBtn.html(originalHtml).prop('disabled', false);

                        if (data) {
                            $('#modalTitle').text('Edit Lokasi Bank Sampah');
                            $('#locationId').val(data.id);
                            $('#name').val(data.name);
                            $('#address').val(data.address);
                            $('#url_maps').val(data.url_maps);

                            $('#mapPreview').empty();
                            if (data.url_maps.includes('<iframe')) {
                                $('#mapPreview').html(data.url_maps);
                            } else {
                                $('#mapPreview').html(
                                    '<p class="text-center text-gray-500 dark:text-gray-400 mt-28">Preview peta tidak valid</p>'
                                );
                            }

                            $('#locationModal').removeClass('hidden');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Data lokasi tidak ditemukan'
                            });
                        }
                    },
                    error: function(xhr) {
                        editBtn.html(originalHtml).prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memuat data'
                        });
                    }
                });
            };

            function closeModal() {
                $('#locationModal').addClass('hidden');
            }

            // Form Submission
            $('#locationForm').on('submit', function(e) {
                e.preventDefault();

                const submitBtn = $(this).find('button[type="submit"]');
                const originalBtnHtml = submitBtn.html();
                submitBtn.html('<span class="spinner mr-2"></span>Menyimpan...').prop('disabled', true);

                let formData = $(this).serialize();
                let id = $('#locationId').val();
                let url = id ? '{{ route('lokasi.update', ':id') }}'.replace(':id', id) :
                    '{{ route('lokasi.store') }}';
                let method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        submitBtn.html(originalBtnHtml).prop('disabled', false);
                        closeModal();
                        loadLocations($('input[name="search"]').val());

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        submitBtn.html(originalBtnHtml).prop('disabled', false);

                        let errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan';
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMessage
                        });
                    }
                });
            });

            // Delete Function
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Hapus Lokasi?',
                    text: `Anda yakin ingin menghapus "${name}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('lokasi.destroy', ':id') }}'.replace(':id', id),
                            type: 'DELETE',
                            success: function(response) {
                                loadLocations($('input[name="search"]').val());

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan saat menghapus'
                                });
                            }
                        });
                    }
                });
            });

            // Edit button event delegation
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                openEditModal(id);
            });
        });
    </script>
@endsection
