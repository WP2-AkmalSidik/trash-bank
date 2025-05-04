<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Bank Sampah</title>
    @vite('resources/css/app.css')
    @include('auth.assets.style')
    @include('auth.assets.script')
</head>

<body class="min-h-screen bg-light flex justify-center overflow-x-hidden">
    <!-- Background blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="blob bg-primary w-64 h-64 top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="blob bg-secondary w-80 h-80 bottom-0 right-0 translate-x-1/3 translate-y-1/3"></div>
        <div class="blob bg-accent/30 w-72 h-72 bottom-0 left-1/4 translate-y-1/2"></div>
    </div>

    <!-- Main content -->
    <div class="w-full max-w-5xl px-4 relative z-10">
        <div class="flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden bg-white/80 backdrop-blur-lg">
            <!-- Left side - Illustration -->
            <div class="w-full md:w-1/2 animated-bg p-8 flex flex-col justify-center items-center text-white">
                <div class="max-w-md mx-auto py-12 px-4 sm:px-6">
                    <div class="text-center mb-8">
                        <div
                            class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full p-4 mx-auto mb-6 flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">Bank Sampah</h2>
                        <p class="text-white/80 text-lg">Tabung sampahmu untuk lingkungan yang lebih baik</p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-4 p-4 rounded-xl bg-white/10 backdrop-blur-sm">
                            <div class="p-2 bg-white/20 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium">Tabung Sambil Menjaga Bumi</h3>
                                <p class="text-sm text-white/70">Nilai ekonomis dari sampahmu</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 rounded-xl bg-white/10 backdrop-blur-sm">
                            <div class="p-2 bg-white/20 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium">Cairkan Kapan Saja</h3>
                                <p class="text-sm text-white/70">Transfer atau ambil tunai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Login Form -->
            <div class="w-full md:w-1/2 bg-white p-8 flex items-center">
                <div class="max-w-md mx-auto w-full py-8 px-4 sm:px-6">
                    <div class="text-center mb-10">
                        <h1 class="text-3xl font-extrabold text-dark">Selamat Datang</h1>
                        <p class="mt-2 text-gray-500">Masuk ke akun Anda untuk melanjutkan</p>
                    </div>

                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                    class="pl-10 w-full py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 outline-none bg-gray-50"
                                    placeholder="email@contoh.com">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="pl-10 w-full py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 outline-none bg-gray-50"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword()" class="focus:outline-none">
                                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hidden"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                            </div>
                            <a href="#" class="text-sm font-medium text-primary hover:text-green-700 transition-colors">Lupa
                                kata sandi?</a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary to-green-600 text-white py-3 px-4 rounded-xl hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-300 font-medium text-base">
                            Masuk
                        </button>

                        <!-- Social Login -->
                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">atau lanjutkan dengan</span>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <div>
                                    <a href="#"
                                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12.545 10.239v3.821h5.445c-0.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866 0.549 3.921 1.453l2.814-2.814c-1.803-1.594-4.182-2.571-6.735-2.571-5.632 0-10.2 4.568-10.2 10.2s4.568 10.2 10.2 10.2c8.492 0 10.2-7.969 10.2-13.032 0-0.799-0.065-1.393-0.2-2h-10v3.835z">
                                            </path>
                                        </svg>
                                        Google
                                    </a>
                                </div>

                                <div>
                                    <a href="#"
                                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.514c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.125-5.864 10.125-11.854z" />
                                        </svg>
                                        Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <p class="mt-8 text-center text-gray-600 text-sm">
                        Belum memiliki akun?
                        <a href="#" class="font-semibold text-primary hover:text-green-700 transition-colors">Daftar
                            sekarang</a>
                    </p>

                    <!-- Footer -->
                    <div class="mt-10 pt-6 border-t border-gray-200 flex justify-center space-x-6">
                        <a href="#" class="text-xs text-gray-500 hover:text-primary transition-colors">Syarat &
                            Ketentuan</a>
                        <a href="#" class="text-xs text-gray-500 hover:text-primary transition-colors">Kebijakan
                            Privasi</a>
                        <a href="#" class="text-xs text-gray-500 hover:text-primary transition-colors">Bantuan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Credits -->
        <p class="text-center text-gray-500 text-xs mt-6">
            © 2025 Bank Sampah. Semua Hak Dilindungi.
        </p>
    </div>
</body>

</html>
