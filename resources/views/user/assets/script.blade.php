<script>
    // Fungsi untuk menampilkan halaman tertentu
    function showPage(pageId) {
        // Sembunyikan semua halaman
        const pages = document.querySelectorAll('.page');
        pages.forEach(page => {
            page.classList.remove('active');
        });

        // Tampilkan halaman yang dipilih
        document.getElementById(pageId).classList.add('active');

        // Update status nav button
        const navButtons = document.querySelectorAll('.fixed.bottom-0 button');
        navButtons.forEach(button => {
            button.classList.remove('text-primary');
            button.classList.add('text-gray-400');
        });

        // Set active nav button
        const activeButton = document.querySelector(`.fixed.bottom-0 button[onclick="showPage('${pageId}')"]`);
        activeButton.classList.remove('text-gray-400');
        activeButton.classList.add('text-primary');
    }
</script>
