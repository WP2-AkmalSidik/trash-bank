<!-- resources/views/admin/transaksi/components/modal-tambah-transaksi.blade.php -->
<!-- Modal Backdrop -->
<div id="modal-backdrop" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"></div>

<!-- Modal -->
<div id="transaction-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-xl mx-4 overflow-hidden">
        <!-- Modal Header -->
        <div class="border-b dark:border-gray-700 px-6 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Transaksi Setoran Sampah</h2>
            <button onclick="closeTransactionModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="px-6 py-4">
            <form id="transaction-form" action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="member_account_id" id="member_account_id">
                
                <div class="mb-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Nasabah</p>
                    <p id="member-name" class="text-lg font-semibold text-gray-800 dark:text-white"></p>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Saldo Saat Ini</p>
                    <p id="current-balance" class="text-lg font-semibold text-green-600 dark:text-green-400"></p>
                </div>

                <div class="mb-4">
                    <label for="waste_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Jenis Sampah
                    </label>
                    <select name="waste_type_id" id="waste_type_id" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg p-2 focus:ring-primary focus:border-primary bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                        <option value="">Pilih Jenis Sampah</option>
                        @foreach ($wasteTypes as $wasteType)
                            <option value="{{ $wasteType->id }}" data-price="{{ $wasteType->price_per_kg }}">
                                {{ $wasteType->name }} - Rp {{ number_format($wasteType->price_per_kg, 0, ',', '.') }}/kg
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="weight_kg" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Berat (kg)
                    </label>
                    <div class="flex rounded-md shadow-sm">
                        <input type="number" name="weight_kg" id="weight_kg" required step="0.01" min="0.01"
                            class="flex-grow border border-gray-300 dark:border-gray-600 rounded-l-lg p-2 focus:ring-primary focus:border-primary bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                            placeholder="0.00">
                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-400">
                            kg
                        </span>
                    </div>
                </div>
                
                <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 dark:text-gray-300">Harga per kg:</span>
                        <span id="price-per-kg" class="font-medium">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-gray-700 dark:text-gray-300">Total nilai:</span>
                        <span id="total-amount" class="font-semibold text-lg text-green-600 dark:text-green-400">Rp 0</span>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeTransactionModal()"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Batal
                    </button>
                    <button type="button" onclick="submitTransaction()"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openTransactionModal(memberId, memberName, memberAccountId) {
        document.getElementById('modal-backdrop').classList.remove('hidden');
        document.getElementById('transaction-modal').classList.remove('hidden');
        document.getElementById('member-name').textContent = memberName;
        document.getElementById('member_account_id').value = memberAccountId;
        
        // Fetch member balance
        fetch(`{{ route('transaksi.get-member-data') }}?member_id=${memberId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('current-balance').textContent = `Rp ${data.balance}`;
            })
            .catch(error => {
                console.error('Error fetching member data:', error);
                showErrorAlert('Gagal memuat data nasabah. Silakan coba lagi.');
            });
            
        // Reset form fields
        document.getElementById('waste_type_id').value = '';
        document.getElementById('weight_kg').value = '';
        document.getElementById('price-per-kg').textContent = 'Rp 0';
        document.getElementById('total-amount').textContent = 'Rp 0';
    }
    
    function closeTransactionModal() {
        document.getElementById('modal-backdrop').classList.add('hidden');
        document.getElementById('transaction-modal').classList.add('hidden');
    }
    
    // Calculate total amount when waste type or weight changes
    document.getElementById('waste_type_id').addEventListener('change', calculateTotal);
    document.getElementById('weight_kg').addEventListener('input', calculateTotal);
    
    function calculateTotal() {
        const wasteTypeSelect = document.getElementById('waste_type_id');
        const weightInput = document.getElementById('weight_kg');
        
        if (wasteTypeSelect.value && weightInput.value) {
            const selectedOption = wasteTypeSelect.options[wasteTypeSelect.selectedIndex];
            const pricePerKg = parseFloat(selectedOption.dataset.price);
            const weight = parseFloat(weightInput.value);
            
            const total = pricePerKg * weight;
            
            document.getElementById('price-per-kg').textContent = 'Rp ' + pricePerKg.toLocaleString('id-ID');
            document.getElementById('total-amount').textContent = 'Rp ' + total.toLocaleString('id-ID', {maximumFractionDigits: 0});
        } else {
            document.getElementById('price-per-kg').textContent = 'Rp 0';
            document.getElementById('total-amount').textContent = 'Rp 0';
        }
    }
    
    // Submit transaction form with AJAX and SweetAlert
    function submitTransaction() {
        // Form validation
        const form = document.getElementById('transaction-form');
        const wasteTypeSelect = document.getElementById('waste_type_id');
        const weightInput = document.getElementById('weight_kg');
        
        // Basic validation
        if (!wasteTypeSelect.value) {
            showErrorAlert('Pilih jenis sampah terlebih dahulu!');
            return;
        }
        
        if (!weightInput.value || parseFloat(weightInput.value) <= 0) {
            showErrorAlert('Masukkan berat sampah yang valid!');
            return;
        }
        
        // Show loading state
        Swal.fire({
            title: 'Memproses...',
            text: 'Sedang menyimpan transaksi',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Prepare form data
        const formData = new FormData(form);
        
        // Send AJAX request
        fetch('{{ route('transaksi.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close modal
                closeTransactionModal();
                
                // Show success message
                showSuccessAlert(data.message, function() {
                    // Refresh the page to show updated data
                    window.location.reload();
                });
            } else {
                showErrorAlert(data.message || 'Terjadi kesalahan. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error submitting transaction:', error);
            showErrorAlert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
</script>