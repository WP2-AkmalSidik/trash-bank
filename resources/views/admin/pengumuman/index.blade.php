@extends('admin.app')
@section('title', 'Pengumuman')
@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Search and Actions -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <form id="searchForm" class="relative w-full md:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Pengumuman..."
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 bg-white placeholder-gray-400 dark:placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-primary dark:text-white focus:ring-blue-500 dark:focus:ring-blue-500 focus:border-blue-500 dark:focus:border-blue-500" />
                </form>

                <div class="flex gap-3">
                    <button onclick="openAddModal()"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-opacity-90 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Pengumuman</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Pengumuman -->
            <div class="overflow-x-auto" id="news-table-container">
                @include('admin.pengumuman.table')
            </div>
        </div>
    </section>

    <!-- Add/Edit Modal -->
    <div id="newsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="newsForm">
                    @csrf
                    <input type="hidden" id="newsId" name="id">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4" id="modalTitle">Tambah
                            Pengumuman</h3>
                        <div class="mb-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                            <input type="text" name="title" id="title"
                                class="w-full px-3 py-2 bg-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="content"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                            <textarea name="content" id="content" rows="4"
                                class="w-full px-3 py-2 bg-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" onclick="closeModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // CSRF Token for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Search Functionality
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            loadNews($('input[name="search"]').val());
        });

        $('input[name="search"]').on('keyup', function() {
            if ($(this).val() === '') {
                loadNews('');
            }
        });

        // Load news with pagination
        function loadNews(search = '') {
            $.get('{{ route('pengumuman.index') }}', {
                search: search
            }, function(data) {
                $('#news-table-container').html($(data).find('#news-table-container').html());
            });
        }

        // Pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let search = $('input[name="search"]').val();
            fetchNews(page, search);
        });

        function fetchNews(page, search) {
            $.get('{{ route('pengumuman.index') }}?page=' + page + '&search=' + search, function(data) {
                $('#news-table-container').html($(data).find('#news-table-container').html());
            });
        }

        // Modal Functions
        function openAddModal() {
            $('#modalTitle').text('Tambah Pengumuman');
            $('#newsId').val('');
            $('#title').val('');
            $('#content').val('');
            $('#newsModal').removeClass('hidden');
        }

        function openEditModal(id) {
            $.ajax({
                url: '{{ route('pengumuman.index') }}/' + id,
                type: 'GET',
                success: function(data) {
                    $('#modalTitle').text('Edit Pengumuman');
                    $('#newsId').val(data.id);
                    $('#title').val(data.title);
                    $('#content').val(data.content);
                    $('#newsModal').removeClass('hidden');
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal memuat data pengumuman'
                    });
                }
            });
        }

        function closeModal() {
            $('#newsModal').addClass('hidden');
        }

        // Form Submission
        $('#newsForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let id = $('#newsId').val();
            let url = id ? '{{ route('pengumuman.update', ':id') }}'.replace(':id', id) :
                '{{ route('pengumuman.store') }}';
            let method = id ? 'PUT' : 'POST';

            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function(response) {
                    closeModal();
                    loadNews($('input[name="search"]').val());

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
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
        function openDeleteModal(id, title) {
            Swal.fire({
                title: 'Hapus Pengumuman?',
                text: `Anda yakin ingin menghapus "${title}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ route('pengumuman.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        success: function(response) {
                            loadNews($('input[name="search"]').val());

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
        }
    </script>
@endsection
