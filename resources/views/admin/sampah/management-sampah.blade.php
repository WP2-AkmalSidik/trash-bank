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
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 bg-white placeholder-gray-400 dark:placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-primary dark:text-white dark:focus:ring-secondary focus:border-primary dark:focus:border-secondary" />
                </form>

                <div class="flex gap-3">
                    <button onclick="openAddModal()"
                        class="px-4 py-2 rounded-lg bg-primary text-secondary hover:bg-opacity-90 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Jenis</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Jenis Sampah -->
            <div class="overflow-x-auto" id="waste-table-container">
                @include('admin.sampah.components.waste-table')
            </div>
        </div>
    </section>
    
    @include('admin.sampah.components.modal-tambah-sampah')
    @include('admin.sampah.components.modal-edit-sampah')
    @include('admin.sampah.components.modal-hapus-sampah')
<script>
    // Global variables
    let currentWasteId = null;
    let searchTimer;
    
    // Initialize modals
    const addModal = document.getElementById('addWasteModal');
    const editModal = document.getElementById('editWasteModal');
    const deleteModal = document.getElementById('deleteWasteModal');
    
    // Modal functions
    function openAddModal() {
        addModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeAddModal() {
        addModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('addWasteForm').reset();
    }
    
    function openEditModal(id) {
        currentWasteId = id;
        
        // Show modal with loading state
        editModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        showLoading('#editWasteForm');
        
        // Fetch waste type data
        $.ajax({
            url: `/admin/sampah/${id}`,
            type: "GET",
            success: function(response) {
                if (response.status === 'success') {
                    const wasteType = response.data;
                    
                    // Fill form
                    $('#edit_waste_id').val(wasteType.id);
                    $('#edit_name').val(wasteType.name);
                    $('#edit_price_per_kg').val(wasteType.price_per_kg);
                    
                    hideLoading('#editWasteForm');
                }
            },
            error: function() {
                closeEditModal();
                showErrorAlert('Gagal memuat data jenis sampah');
            }
        });
    }
    
    function closeEditModal() {
        editModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('editWasteForm').reset();
        hideLoading('#editWasteForm');
    }
    
    function openDeleteModal(id, name) {
        currentWasteId = id;
        document.getElementById('delete-confirmation-text').textContent = 
            `Apakah Anda yakin ingin menghapus jenis sampah "${name}"?`;
        deleteModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteModal() {
        deleteModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentWasteId = null;
    }
    
    // Loading states
    function showLoading(selector) {
        const container = document.querySelector(selector);
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.id = 'loadingOverlay';
        
        const spinner = document.createElement('div');
        spinner.className = 'spinner';
        spinner.style.width = '30px';
        spinner.style.height = '30px';
        
        loadingOverlay.appendChild(spinner);
        container.style.position = 'relative';
        container.appendChild(loadingOverlay);
    }
    
    function hideLoading(selector) {
        const loadingOverlay = document.querySelector(`${selector} #loadingOverlay`);
        if (loadingOverlay) {
            loadingOverlay.remove();
        }
    }
    
    function showDeleteLoading() {
        document.getElementById('delete-loading').classList.remove('hidden');
        document.getElementById('confirm-delete-btn').disabled = true;
        document.getElementById('confirm-delete-btn').classList.add('opacity-75');
        document.getElementById('cancel-delete-btn').disabled = true;
        document.getElementById('cancel-delete-btn').classList.add('opacity-75');
    }
    
    function hideDeleteLoading() {
        document.getElementById('delete-loading').classList.add('hidden');
        document.getElementById('confirm-delete-btn').disabled = false;
        document.getElementById('confirm-delete-btn').classList.remove('opacity-75');
        document.getElementById('cancel-delete-btn').disabled = false;
        document.getElementById('cancel-delete-btn').classList.remove('opacity-75');
    }
    
    // Alert functions
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: message,
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
    
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
    
    // Form submissions
    $(document).ready(function() {
        // Search with debounce
        $('input[name="search"]').on('keyup', function() {
            clearTimeout(searchTimer);
            let search = $(this).val();
            
            searchTimer = setTimeout(() => {
                loadWasteTable({ search });
            }, 300);
        });
        
        // Pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let search = $('input[name="search"]').val();
            
            loadWasteTable({ url, search });
        });
        
        // Add form
        $('#addWasteForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('button[type="submit"]');
            
            // Set loading state
            button.prop('disabled', true);
            button.html('<div class="spinner"></div>Menyimpan...');
            
            $.ajax({
                url: "{{ route('sampah.store') }}",
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    showSuccessAlert(response.message);
                    closeAddModal();
                    loadWasteTable();
                },
                error: function(xhr) {
                    let error = xhr.responseJSON?.message || 'Terjadi kesalahan';
                    showErrorAlert(error);
                },
                complete: function() {
                    button.prop('disabled', false);
                    button.html('Simpan');
                }
            });
        });
        
        // Edit form
        $('#editWasteForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('button[type="submit"]');
            
            // Set loading state
            button.prop('disabled', true);
            button.html('<div class="spinner"></div>Memperbarui...');
            
            $.ajax({
                url: `/admin/sampah/${currentWasteId}`,
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    showSuccessAlert(response.message);
                    closeEditModal();
                    loadWasteTable();
                },
                error: function(xhr) {
                    let error = xhr.responseJSON?.message || 'Terjadi kesalahan';
                    showErrorAlert(error);
                },
                complete: function() {
                    button.prop('disabled', false);
                    button.html('Perbarui');
                }
            });
        });
        
        // Delete confirmation
        $('#confirm-delete-btn').on('click', function() {
            if (!currentWasteId) return;
            
            showDeleteLoading();
            
            $.ajax({
                url: `/admin/sampah/${currentWasteId}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    showSuccessAlert(response.message);
                    closeDeleteModal();
                    loadWasteTable();
                },
                error: function(xhr) {
                    let error = xhr.responseJSON?.message || 'Gagal menghapus jenis sampah';
                    showErrorAlert(error);
                },
                complete: function() {
                    hideDeleteLoading();
                }
            });
        });
    });
    
    // Helper function to load waste table
    function loadWasteTable(params = {}) {
        $.ajax({
            url: params.url || "{{ route('sampah.index') }}",
            type: "GET",
            data: { search: params.search },
            success: function(data) {
                $('#waste-table-container').html(data);
            },
            error: function() {
                showErrorAlert('Gagal memuat data terbaru');
            }
        });
    }
</script>
@endsection