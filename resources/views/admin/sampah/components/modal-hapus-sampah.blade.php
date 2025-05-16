<!-- Modal Hapus Jenis Sampah -->
<div id="deleteWasteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
        <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Konfirmasi Hapus</h3>
            <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="p-5">
            <div class="flex items-center gap-4 mb-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-red-100 text-red-600">
                    <i class="fa-solid fa-trash text-xl"></i>
                </div>
                <div>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Hapus Jenis Sampah</h4>
                    <p class="text-gray-600 dark:text-gray-300" id="delete-confirmation-text">
                        Apakah Anda yakin ingin menghapus jenis sampah ini?
                    </p>
                </div>
            </div>
            
            <!-- Loading Indicator (hidden by default) -->
            <div id="delete-loading" class="hidden mb-4">
                <div class="flex items-center justify-center gap-2 text-blue-600 dark:text-blue-400">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-600"></div>
                    <span>Sedang menghapus...</span>
                </div>
            </div>
            
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeDeleteModal()" id="cancel-delete-btn"
                    class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="button" id="confirm-delete-btn"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition flex items-center justify-center gap-2">
                    <span id="delete-btn-text">Hapus</span>
                    <i id="delete-btn-icon" class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    let deleteWasteId = null;
    
    function openDeleteModal(id, name) {
        deleteWasteId = id;
        document.getElementById('delete-confirmation-text').textContent = `Apakah Anda yakin ingin menghapus jenis sampah "${name}"?`;
        document.getElementById('deleteWasteModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Reset loading state saat modal dibuka
        resetDeleteLoadingState();
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteWasteModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        deleteWasteId = null;
    }
    
    function showDeleteLoading() {
        document.getElementById('delete-loading').classList.remove('hidden');
        document.getElementById('confirm-delete-btn').disabled = true;
        document.getElementById('confirm-delete-btn').classList.add('opacity-75');
        document.getElementById('cancel-delete-btn').disabled = true;
        document.getElementById('cancel-delete-btn').classList.add('opacity-75');
        document.getElementById('delete-btn-text').textContent = 'Menghapus...';
        document.getElementById('delete-btn-icon').classList.replace('fa-trash', 'fa-spinner', 'fa-spin');
    }
    
    function resetDeleteLoadingState() {
        document.getElementById('delete-loading').classList.add('hidden');
        document.getElementById('confirm-delete-btn').disabled = false;
        document.getElementById('confirm-delete-btn').classList.remove('opacity-75');
        document.getElementById('cancel-delete-btn').disabled = false;
        document.getElementById('cancel-delete-btn').classList.remove('opacity-75');
        document.getElementById('delete-btn-text').textContent = 'Hapus';
        document.getElementById('delete-btn-icon').classList.replace('fa-spinner', 'fa-trash');
        document.getElementById('delete-btn-icon').classList.remove('fa-spin');
    }
    
    $(document).ready(function() {
        $('#confirm-delete-btn').on('click', function() {
            if (!deleteWasteId) return;
            
            // Show loading state
            showDeleteLoading();
            
            $.ajax({
                url: `{{ url('admin/sampah') }}/${deleteWasteId}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Refresh the table
                        $.ajax({
                            url: "{{ route('sampah.index') }}",
                            type: "GET",
                            success: function(data) {
                                $('.overflow-x-auto').html(data);
                                
                                // Show success notification
                                showNotification('success', response.message);
                                
                                // Close modal
                                closeDeleteModal();
                            },
                            error: function() {
                                showNotification('error', 'Gagal memuat data terbaru');
                                resetDeleteLoadingState();
                            }
                        });
                    } else {
                        showNotification('error', response.message || 'Gagal menghapus jenis sampah');
                        resetDeleteLoadingState();
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Gagal menghapus jenis sampah';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showNotification('error', errorMessage);
                    resetDeleteLoadingState();
                }
            });
        });
    });
</script>