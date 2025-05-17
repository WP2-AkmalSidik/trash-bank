<!-- Modal Konfirmasi Hapus -->
<div id="deleteNasabahModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity"></div>

    <!-- Modal Container -->
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Modal Content -->
        <div
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Konfirmasi Hapus Nasabah
                </h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <p class="text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus nasabah ini? Data yang
                    sudah dihapus tidak dapat dikembalikan.</p>
                <p class="text-gray-700 dark:text-gray-300 mt-2 font-medium" id="nasabahToDelete"></p>
            </div>

            <!-- Modal footer -->
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-600 dark:text-white dark:border-gray-600">
                    Batal
                </button>
                <button type="button" onclick="processDelete()" id="deleteButton"
                    class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 transition">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Variabel global untuk menyimpan ID yang akan dihapus
    let nasabahIdToDelete = null;

    // Modal Hapus functions
    function openDeleteModal(id, name) {
        nasabahIdToDelete = id;
        document.getElementById('nasabahToDelete').textContent = `Nasabah: ${name}`;
        document.getElementById('deleteNasabahModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteNasabahModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        nasabahIdToDelete = null;
    }

    function processDelete() {
        if (!nasabahIdToDelete) return;

        const deleteButton = document.getElementById('deleteButton');
        const originalText = deleteButton.innerHTML;
        
        // Show loading state
        deleteButton.disabled = true;
        deleteButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i> Menghapus...
        `;

        fetch(`/admin/nasabah/${nasabahIdToDelete}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-HTTP-Method-Override': 'DELETE'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = data.redirect;
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Gagal menghapus nasabah',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat menghapus data'
            });
        })
        .finally(() => {
            closeDeleteModal();
            deleteButton.disabled = false;
            deleteButton.innerHTML = originalText;
        });
    }
</script>

<style>
    /* Untuk animasi modal */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #deleteNasabahModal {
        animation: modalFadeIn 0.3s ease-out;
    }

    /* Warna tombol hapus */
    .bg-red-600 {
        background-color: #dc2626;
    }
    .hover\:bg-red-700:hover {
        background-color: #b91c1c;
    }
</style>