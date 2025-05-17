<!-- Modal Edit Nasabah -->
<div id="editNasabahModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
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
                    Edit Data Nasabah
                </h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <!-- Modal body -->
            <form id="editNasabahForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="p-6 space-y-4">
                    <div>
                        <label for="edit_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                        <input type="text" id="edit_name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>

                    <div>
                        <label for="edit_email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" id="edit_email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>

                    <div>
                        <label for="edit_phone_number"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor HP</label>
                        <input type="tel" id="edit_phone_number" name="phone_number" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>

                    <div>
                        <label for="edit_account_number"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor
                            Rekening</label>
                        <input type="text" id="edit_account_number" name="account_number" readonly
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="edit_password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password (Kosongkan
                            jika tidak ingin mengubah)</label>
                        <input type="password" id="edit_password" name="password"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-600 dark:text-white dark:border-gray-600">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-primary rounded-md hover:bg-opacity-90 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Modal Edit functions
    function openEditModal(id) {
        fetch(`/admin/nasabah/${id}/edit`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_phone_number').value = data.phone_number;
                document.getElementById('edit_account_number').value = data.member_account?.account_number || '-';

                document.getElementById('editNasabahModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data nasabah');
            });
    }

    function closeEditModal() {
        document.getElementById('editNasabahModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Form submission edit
    // Form submission edit
    document.getElementById('editNasabahForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;

        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i> Memproses...
        `;

        const formData = new FormData(this);
        const id = document.getElementById('edit_id').value;

        fetch(`/admin/nasabah/${id}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
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
                        html: data.message || 'Terjadi kesalahan saat memperbarui data',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan perubahan'
                });
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
    });
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

    to {
        opacity: 1;
        transform: translateY(0);
    }

    #tambahNasabahModal {
        animation: modalFadeIn 0.3s ease-out;
    }
</style>
