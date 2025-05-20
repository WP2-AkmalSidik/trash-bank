<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Bank Sampah Ciherang Tunas Mulia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    @include('admin.assets.script')
    @include('admin.assets.style')
</head>

<body
    class="font-sans antialiased min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    @include('admin.components.sidebar')
    <!-- Main Content -->
    <div class="lg:ml-64 transition-all duration-300">
        @include('admin.components.topbar')

        <main class="container mx-auto px-4 py-6 animate-fadeIn">
            <!-- Page Header -->
            @include('admin.components.header')
            <!-- Stats Cards -->
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 shadow-md mt-6">
            <div class="max-w-full mx-auto px-4 py-6 md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start">
                    <span class="text-sm text-gray-500 dark:text-gray-400">© 2025 Bank Sampah - Ciherang Tunas
                        Mulia</span>
                </div>
            </div>
        </footer>
    </div>
    @include('admin.assets.sidebarjs')
    <!-- Chart.js script -->
    @if (request()->routeIs('admin.dashboard'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            Chart.defaults.color = document.documentElement.classList.contains('dark') ? '#f3f4f6' : '#374151';
        </script>
        @include('admin.assets.chart')
    @endif
    <script>
        function showSuccessAlert(message, callback = null) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed && callback) {
                    callback();
                }
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        function showConfirmationAlert(title, text, confirmButtonText, callback) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }
        function showToast(message, icon = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: icon,
                title: message
            });
        }
    </script>
</body>

</html>
