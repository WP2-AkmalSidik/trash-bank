<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const inputs = document.querySelectorAll("#email, #password");

        inputs.forEach(input => {
            input.addEventListener("input", () => {
                if (input.value.trim() !== "") {
                    input.classList.add("input-valid");
                } else {
                    input.classList.remove("input-valid");
                }
            });
        });

        // Handle form submission with AJAX
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            
            const submitButton = $(this).find('button[type="submit"]');
            const originalText = submitButton.text();
            
            // Show loading state
            submitButton.prop('disabled', true);
            submitButton.html(`
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sedang memproses...
            `);

            $.ajax({
                url: "{{ route('login.post') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.redirect) {
                        Swal.fire({
                            title: 'Login Berhasil!',
                            text: 'Anda akan diarahkan ke dashboard...',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                                window.location.href = response.redirect;
                            }
                        });
                    }
                },
                error: function(xhr) {
                    submitButton.prop('disabled', false);
                    submitButton.text(originalText);
                    
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        
                        for (const key in errors) {
                            errorMessage += errors[key][0] + '<br>';
                        }
                        
                        Swal.fire({
                            title: 'Error!',
                            html: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (xhr.status === 401) {
                        Swal.fire({
                            title: 'Login Gagal!',
                            text: 'Email atau password salah.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
</script>
