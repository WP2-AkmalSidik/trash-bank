<script>
    // Approve withdrawal with SweetAlert confirmation
    function approveWithdrawal(id) {
        // Check if the withdrawal is e-wallet type and has proof before allowing approval
        const row = document.getElementById(`withdrawal-row-${id}`);
        const isEwallet = row.querySelector('td:nth-child(5) span').textContent.trim() === 'E-Wallet';
        const hasProofText = row.querySelector('td:nth-child(6)').textContent.includes('Lihat Bukti Transfer');

        if (isEwallet && !hasProofText) {
            Swal.fire({
                title: 'Bukti Transfer Diperlukan',
                text: 'Pengajuan e-wallet harus menyertakan bukti transfer terlebih dahulu.',
                icon: 'warning',
                confirmButtonColor: '#10B981'
            });
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Persetujuan',
            html: `<p>Anda yakin ingin menyetujui pengajuan penarikan ini?</p>
                       <p class="text-sm text-gray-500 mt-2"><strong>Catatan:</strong> Saldo nasabah akan otomatis dikurangi sesuai dengan jumlah penarikan.</p>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(`/admin/pengajuan/${id}/approve`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            }
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: result.value.message,
                        icon: 'success',
                        confirmButtonColor: '#10B981'
                    }).then(() => {
                        // Update the row without reloading the page
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: result.value.message,
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                }
            }
        });
    }

    // Show reject form in SweetAlert
    function showRejectForm(id) {
        Swal.fire({
            title: 'Konfirmasi Penolakan',
            html: `<p>Anda yakin ingin menolak pengajuan penarikan ini?</p>
                       <textarea id="swal-rejection-reason" class="swal2-textarea mt-2" placeholder="Alasan penolakan (opsional)"></textarea>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            preConfirm: () => {
                const reason = document.getElementById('swal-rejection-reason').value;

                return fetch(`/admin/pengajuan/${id}/reject`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            rejection_reason: reason
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            }
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: result.value.message,
                        icon: 'success',
                        confirmButtonColor: '#10B981'
                    }).then(() => {
                        // Update the row without reloading the page
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: result.value.message,
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                }
            }
        });
    }

    // Show proof upload modal
    function showProofUploadModal(id) {
        document.getElementById('withdrawal_id').value = id;
        document.getElementById('upload-prompt').classList.remove('hidden');
        document.getElementById('image-preview-container').classList.add('hidden');
        document.getElementById('proof_file').value = '';
        document.getElementById('file-error').classList.add('hidden');

        document.getElementById('proofUploadModal').classList.remove('hidden');
    }

    // Close modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Upload proof of transfer
    function uploadProofOfTransfer() {
        const withdrawalId = document.getElementById('withdrawal_id').value;
        const fileInput = document.getElementById('proof_file');
        const errorContainer = document.getElementById('file-error');

        // Validate file
        if (!fileInput.files || fileInput.files.length === 0) {
            errorContainer.textContent = 'Harap pilih file bukti transfer';
            errorContainer.classList.remove('hidden');
            return;
        }

        const file = fileInput.files[0];
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!allowedTypes.includes(file.type)) {
            errorContainer.textContent = 'Format file tidak valid. Gunakan PNG, JPG, atau JPEG';
            errorContainer.classList.remove('hidden');
            return;
        }

        if (file.size > maxSize) {
            errorContainer.textContent = 'Ukuran file melebihi batas maksimum (2MB)';
            errorContainer.classList.remove('hidden');
            return;
        }

        // Submit form with AJAX
        const formData = new FormData();
        formData.append('proof_file', file);
        formData.append('_token', '{{ csrf_token() }}');

        // Show loading indicator
        Swal.fire({
            title: 'Mengupload...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Use the correct route
        fetch(`/admin/pengajuan/${withdrawalId}/upload-proof`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();

                if (data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Bukti transfer berhasil diunggah',
                        icon: 'success',
                        confirmButtonColor: '#10B981'
                    }).then(() => {
                        // Close modal and reload page
                        closeModal('proofUploadModal');
                        location.reload();
                    });
                } else {
                    errorContainer.textContent = data.message || 'Terjadi kesalahan saat mengupload bukti transfer';
                    errorContainer.classList.remove('hidden');
                }
            })
            .catch(error => {
                Swal.close();
                errorContainer.textContent = 'Terjadi kesalahan saat mengupload bukti transfer';
                errorContainer.classList.remove('hidden');
                console.error('Error:', error);
            });
    }

    // View proof of transfer
    function viewProofOfTransfer(id) {
        // Show loading indicator
        Swal.fire({
            title: 'Memuat bukti transfer...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Use the correct route
        fetch(`/admin/pengajuan/${id}/proof`, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();

                if (data.success) {
                    // Set the image source and show modal
                    document.querySelector('#proofViewModal img').src = data.proof_url;
                    document.getElementById('proofViewModal').classList.remove('hidden');
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                }
            })
            .catch(error => {
                Swal.close();
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat memuat bukti transfer',
                    icon: 'error',
                    confirmButtonColor: '#EF4444'
                });
                console.error('Error:', error);
            });
    }

    // File upload preview
    document.getElementById('proof_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('image-preview').src = event.target.result;
            document.getElementById('file-name').textContent = file.name;
            document.getElementById('upload-prompt').classList.add('hidden');
            document.getElementById('image-preview-container').classList.remove('hidden');
            document.getElementById('file-error').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });

    // Remove file
    document.getElementById('remove-file').addEventListener('click', function() {
        document.getElementById('proof_file').value = '';
        document.getElementById('upload-prompt').classList.remove('hidden');
        document.getElementById('image-preview-container').classList.add('hidden');
        document.getElementById('file-error').classList.add('hidden');
    });

    // Drag and drop handling
    const dropzone = document.getElementById('dropzone');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropzone.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
    }

    function unhighlight() {
        dropzone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
    }

    dropzone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            document.getElementById('proof_file').files = files;
            // Trigger change event manually
            const event = new Event('change');
            document.getElementById('proof_file').dispatchEvent(event);
        }
    }
</script>
