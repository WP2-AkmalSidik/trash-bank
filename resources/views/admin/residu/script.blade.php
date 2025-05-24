<script>
    // Global variables
    let currentResiduId = null;
    let searchTimer;

    // Modal functions
    function openAddModal() {
        document.getElementById('addResiduModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAddModal() {
        document.getElementById('addResiduModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('addResiduForm').reset();
    }

    function openEditModal(id) {
        currentResiduId = id;

        // Show modal with loading state
        document.getElementById('editResiduModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        showLoading('#editResiduForm');

        // Fetch residu data
        $.ajax({
            url: `/admin/residu/${id}`,
            type: "GET",
            success: function(response) {
                if (response.status === 'success') {
                    const residu = response.data;

                    // Fill form
                    $('#edit_residu_id').val(residu.id);
                    $('#edit_name').val(residu.name);
                    $('#edit_weight_kg').val(residu.weight_kg);

                    hideLoading('#editResiduForm');
                }
            },
            error: function() {
                closeEditModal();
                showErrorAlert('Gagal memuat data residu');
            }
        });
    }

    function closeEditModal() {
        document.getElementById('editResiduModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('editResiduForm').reset();
        hideLoading('#editResiduForm');
    }

    function openDeleteModal(id, name) {
        currentResiduId = id;
        document.getElementById('delete-confirmation-text').textContent =
            `Apakah Anda yakin ingin menghapus residu "${name}"?`;
        document.getElementById('deleteResiduModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteResiduModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentResiduId = null;
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

    // Form submissions
    $(document).ready(function() {
        // Search with debounce
        $('input[name="search"]').on('keyup', function() {
            clearTimeout(searchTimer);
            let search = $(this).val();

            searchTimer = setTimeout(() => {
                loadResiduTable({
                    search
                });
            }, 300);
        });

        // Pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let search = $('input[name="search"]').val();

            loadResiduTable({
                url,
                search
            });
        });

        // Add form
        $('#addResiduForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('button[type="submit"]');

            // Set loading state
            button.prop('disabled', true);
            button.html('<div class="spinner mr-2 inline-block"></div>Simpan...');

            $.ajax({
                url: "{{ route('residu.store') }}",
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    showSuccessAlert(response.message);
                    closeAddModal();
                    loadResiduTable();
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
        $('#editResiduForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('button[type="submit"]');

            // Set loading state
            button.prop('disabled', true);
            button.html('<div class="spinner mr-2 inline-block"></div>Perbarui...');

            $.ajax({
                url: `/admin/residu/${currentResiduId}`,
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    showSuccessAlert(response.message);
                    closeEditModal();
                    loadResiduTable();
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
            if (!currentResiduId) return;

            showDeleteLoading();

            $.ajax({
                url: `/admin/residu/${currentResiduId}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    showSuccessAlert(response.message);
                    closeDeleteModal();
                    loadResiduTable();
                },
                error: function(xhr) {
                    let error = xhr.responseJSON?.message || 'Gagal menghapus residu';
                    showErrorAlert(error);
                },
                complete: function() {
                    hideDeleteLoading();
                }
            });
        });
    });

    // Helper function to load residu table
    function loadResiduTable(params = {}) {
        $.ajax({
            url: params.url || "{{ route('residu.index') }}",
            type: "GET",
            data: {
                search: params.search
            },
            success: function(data) {
                $('#residu-table-container').html(data);
            },
            error: function() {
                showErrorAlert('Gagal memuat data terbaru');
            }
        });
    }
</script>
