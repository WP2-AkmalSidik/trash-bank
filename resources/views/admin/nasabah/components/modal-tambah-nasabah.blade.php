<!-- Modal Tambah Nasabah -->
<div id="tambahNasabahModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
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
                    Tambah Nasabah Baru
                </h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <!-- Modal body -->
            <form id="tambahNasabahForm">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                            Lengkap</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>

                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>

                    <div>
                        <label for="phone_number"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor HP</label>
                        <input type="tel" id="phone_number" name="phone_number" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>

                    <div class="flex gap-2">
                        <div class="flex-1">
                            <label for="account_number"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor
                                Rekening</label>
                            <input type="text" id="account_number" name="account_number" required readonly
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 dark:text-white">
                        </div>
                        <button type="button" onclick="generateAccountNumber()"
                            class="mt-6 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            Generate
                        </button>
                    </div>

                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:text-white">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-600 dark:text-white dark:border-gray-600">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-primary rounded-md hover:bg-opacity-90 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function openModal() {
        document.getElementById('tambahNasabahModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        generateAccountNumber(); // Auto generate account number when modal opens
    }

    function closeModal() {
        document.getElementById('tambahNasabahModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Generate account number
    function generateAccountNumber() {
        fetch("{{ route('nasabah.generate-account') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('account_number').value = data.account_number;
            });
    }

    // Form submission
    document.getElementById('tambahNasabahForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;

        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i> Memproses...
        `;

        const formData = new FormData(this);

        fetch("{{ route('nasabah.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
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
                        html: data.message || 'Terjadi kesalahan saat menambahkan nasabah',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data'
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

    #tambahNasabahModal {
        animation: modalFadeIn 0.3s ease-out;
    }
</style>
