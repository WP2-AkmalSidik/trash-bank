<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>@yield('title', 'Bank Sampah')</title>
    @include('user.assets.style')

</head>

<body class="bg-light min-h-screen">
    @yield('content')

    <!-- Bottom Navigation -->
    @include('user.components.navigation')

    @stack('scripts')
    <script>
        function showPage(pageId) {
            window.location.href = pageId.replace('-page', '');
        }
    </script>
</body>

</html>
