<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Bank Sampah Ciherang Tunas Mulia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    @include('admin.assets.script')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>

<body class="font-sans antialiased min-h-screen bg-light transition-colors duration-300">
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
        <footer class="bg-white shadow-md mt-6">
            <div class="max-w-full mx-auto px-4 py-6 md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start">
                    <span class="text-sm text-gray-500">© 2025 Bank Sampah - Ciherang Tunas Mulia</span>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <!-- Chart.js script -->
    @if (request()->routeIs('admin.dashboard'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @include('admin.assets.chart')
    @endif


</body>

</html>
