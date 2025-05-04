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
    });
</script>
