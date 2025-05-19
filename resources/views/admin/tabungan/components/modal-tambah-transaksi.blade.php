<!-- Modal Tambah Transaksi -->
<div id="modal-tambah-transaksi"
    class="fixed inset-0 hidden z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative w-11/12 md:w-3/4 lg:w-1/2 mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Tambah Transaksi Tabungan
            </h3>
            <button type="button" class="close-modal text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <div id="member-info" class="mb-4 hidden">
            <div class="grid grid-cols-3 gap-2 text-sm">
                <div class="space-y-0">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Saldo</p>
                    <p class="font-bold text-green-600 truncate" id="member-balance">Rp. 0</p>
                </div>
                <div class="space-y-0">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama Nasabah</p>
                    <p class="font-medium text-gray-900 dark:text-white truncate" id="member-name">-</p>
                </div>
                <div class="space-y-0">
                    <p class="text-sm text-gray-500 dark:text-gray-400">No. Rekening</p>
                    <p class="font-medium text-gray-900 dark:text-white" id="member-account">-</p>
                </div>
            </div>
        </div>

        <form id="form-transaksi" method="POST" action="{{ route('transaksi.store') }}">
            @csrf
            <input type="hidden" name="member_account_id" id="member_account_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Field Jenis Sampah -->
                <div>
                    <label for="waste_type_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jenis Sampah
                    </label>
                    <select name="waste_type_id" id="waste_type_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-secondary dark:focus:border-secondary">
                        <option value="">Pilih Jenis Sampah</option>
                        @foreach ($wasteTypes as $wasteType)
                            <option value="{{ $wasteType->id }}">{{ $wasteType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Field Berat -->
                <div>
                    <label for="weight_kg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Berat (Kg)
                    </label>
                    <input type="number" step="0.01" min="0.01" name="weight_kg" id="weight_kg"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-secondary dark:focus:border-secondary"
                        placeholder="Masukkan berat dalam kilogram">
                </div>
            </div>

            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Harga per Kg
                </label>
                <div class="flex items-center p-2.5 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <span class="text-gray-900 dark:text-white">Rp</span>
                    <span id="price-per-kg" class="ml-2 font-medium text-gray-900 dark:text-white">0</span>
                </div>
            </div>

            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Total Harga
                </label>
                <div class="flex items-center p-2.5 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <span class="text-gray-900 dark:text-white">Rp</span>
                    <span id="total-price" class="ml-2 font-medium text-gray-900 dark:text-white">0</span>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button"
                    class="close-modal mr-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-800">
                    Batal
                </button>
                <button type="submit" id="btn-submit-transaksi"
                    class="px-4 py-2 bg-primary hover:bg-primary-dark rounded-lg text-white">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Inisialisasi variabel untuk harga sampah
    let wastePrice = 0;
    let totalPrice = 0;

    // Fungsi untuk membuka modal
    function openTransactionModal(memberId) {
        // Reset form
        $('#form-transaksi')[0].reset();
        $('#waste_type_id').val('');
        $('#price-per-kg').text('0');
        $('#total-price').text('0');

        // Tampilkan loading
        $('#member-info').addClass('hidden');
        $('#member-name').text('-');
        $('#member-account').text('-');
        $('#member-balance').text('Rp 0');

        // Ambil data member
        $.ajax({
            url: "{{ route('transaksi.get-member-data') }}",
            type: "GET",
            data: {
                member_id: memberId
            },
            success: function(response) {
                $('#member_account_id').val(response.member.member_account.id);
                $('#member-name').text(response.member.name);
                $('#member-account').text(response.member.member_account.account_number);
                $('#member-balance').text('Rp ' + response.balance);
                $('#member-info').removeClass('hidden');
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                showErrorAlert('Gagal memuat data nasabah. Silakan coba lagi.');
            }
        });

        // Tampilkan modal
        $('#modal-tambah-transaksi').removeClass('hidden');
    }

    // Event handler untuk menutup modal
    $('.close-modal').on('click', function() {
        $('#modal-tambah-transaksi').addClass('hidden');
    });

    // Event handler untuk membuka modal dari tombol di tabel
    $(document).on('click', '.btn-tambah-transaksi', function() {
        const memberId = $(this).data('id');
        openTransactionModal(memberId);
    });

    // Event handler untuk perubahan jenis sampah
    $('#waste_type_id').on('change', function() {
        const wasteTypeId = $(this).val();
        if (wasteTypeId) {
            // Ambil harga sampah
            $.ajax({
                url: "{{ route('transaksi.get-waste-price') }}",
                type: "GET",
                data: {
                    waste_type_id: wasteTypeId
                },
                success: function(response) {
                    wastePrice = parseFloat(response.price);

                    // Format dan tampilkan harga per kg
                    $('#price-per-kg').text(wastePrice.toLocaleString('id-ID'));

                    // Hitung total jika berat sudah diisi
                    const weightKg = parseFloat($('#weight_kg').val()) || 0;
                    calculateTotal(weightKg);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    showErrorAlert('Gagal memuat harga sampah. Silakan coba lagi.');
                }
            });
        } else {
            wastePrice = 0;
            $('#price-per-kg').text('0');
            calculateTotal(0);
        }
    });

    // Event handler untuk perubahan berat
    $('#weight_kg').on('input', function() {
        const weightKg = parseFloat($(this).val()) || 0;
        calculateTotal(weightKg);
    });

    // Fungsi untuk menghitung total harga
    function calculateTotal(weightKg) {
        totalPrice = weightKg * wastePrice;
        $('#total-price').text(totalPrice.toLocaleString('id-ID'));
    }

    // Event handler untuk submit form
    // Fungsi untuk menampilkan SweetAlert sukses
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            timer: 2000,
            showConfirmButton: false
        });
    }

    // Fungsi untuk menampilkan SweetAlert error
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: message,
            confirmButtonColor: '#3085d6',
        });
    }

    // Event handler untuk submit form
    $('#form-transaksi').on('submit', function(e) {
        e.preventDefault();

        const submitBtn = $('#btn-submit-transaksi');
        const originalBtnText = submitBtn.html();

        // Tampilkan loading indicator
        submitBtn.prop('disabled', true);
        submitBtn.html(`
            <span class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            </span>
        `);

        // Validasi
        const weightKg = parseFloat($('#weight_kg').val());
        const wasteTypeId = $('#waste_type_id').val();
        const memberAccountId = $('#member_account_id').val();

        if (!memberAccountId) {
            submitBtn.prop('disabled', false);
            submitBtn.html(originalBtnText);
            showErrorAlert('Data nasabah tidak valid');
            return;
        }

        if (!wasteTypeId) {
            submitBtn.prop('disabled', false);
            submitBtn.html(originalBtnText);
            showErrorAlert('Silakan pilih jenis sampah');
            return;
        }

        if (!weightKg || weightKg <= 0) {
            submitBtn.prop('disabled', false);
            submitBtn.html(originalBtnText);
            showErrorAlert('Silakan masukkan berat sampah yang valid');
            return;
        }

        // Submit form melalui AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                if (response.success) {
                    // Tutup modal
                    $('#modal-tambah-transaksi').addClass('hidden');

                    // Tampilkan pesan sukses
                    showSuccessAlert(response.message);

                    // Buka cetak bon di tab baru
                    const receiptUrl = "{{ route('transaksi.print-receipt', ':id') }}".replace(
                        ':id', response.deposit_id);
                    window.open(receiptUrl, '_blank');

                    // Reload halaman setelah delay
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showErrorAlert(response.message);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                let errorMessage = 'Gagal menyimpan transaksi. Silakan coba lagi.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showErrorAlert(errorMessage);
            }
        });
    });

    // Perbaikan untuk AJAX error handling lainnya
    $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
        $('#btn-submit-transaksi').prop('disabled', false);
        $('#btn-submit-transaksi').html('Simpan Transaksi');

        if (jqxhr.status === 422) {
            // Handle validation errors
            const errors = jqxhr.responseJSON.errors;
            let errorMessage = '';
            for (const key in errors) {
                errorMessage += errors[key][0] + '\n';
            }
            showErrorAlert(errorMessage);
        } else if (jqxhr.status === 500) {
            showErrorAlert('Terjadi kesalahan server. Silakan coba lagi nanti.');
        }
    });
</script>
