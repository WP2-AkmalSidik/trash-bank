<!-- Loading Overlay (hanya untuk konten halaman) -->
<div id="loading-overlay"
     class="fixed left-0 right-0 top-0 flex items-center justify-center z-40 hidden"
     style="bottom: 64px; background-color: rgba(255, 255, 255, 0.5);">
    <div class="relative w-12 h-12">
        <div class="absolute inset-0 rounded-full border-4 border-t-transparent border-r-transparent border-l-primary border-b-primary animate-spin"
             style="border-color: transparent transparent #0D723B #0D723B;"></div>
        <div class="absolute inset-2 bg-white rounded-full"></div>
    </div>
</div>


<!-- Bottom Navigation -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around p-3 z-50">
    <!-- Beranda -->
    <a href="{{ route('user.dashboard') }}" 
       onclick="showLoading()"
       class="flex flex-col items-center {{ request()->routeIs('user.dashboard') ? 'text-primary' : 'text-gray-400' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-xs mt-1">Beranda</span>
    </a>

    <!-- Pengajuan -->
    <a href="{{ route('user.pengajuan') }}" 
       onclick="showLoading()"
       class="flex flex-col items-center {{ request()->routeIs('user.pengajuan') ? 'text-primary' : 'text-gray-400' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
        </svg>
        <span class="text-xs mt-1">Pengajuan</span>
    </a>

    <!-- Transaksi -->
    <a href="{{ route('user.transaksi') }}" 
       onclick="showLoading()"
       class="flex flex-col items-center {{ request()->routeIs('user.transaksi') ? 'text-primary' : 'text-gray-400' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="text-xs mt-1">Transaksi</span>
    </a>

    <!-- Profil -->
    <a href="{{ route('user.profile') }}" 
       onclick="showLoading()"
       class="flex flex-col items-center {{ request()->routeIs('user.profile') ? 'text-primary' : 'text-gray-400' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="text-xs mt-1">Profil</span>
    </a>
</div>

<script>
    function showLoading() {
        document.getElementById('loading-overlay').classList.remove('hidden');
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loading-overlay').classList.add('hidden');
    });

    window.addEventListener('beforeunload', () => {
        document.getElementById('loading-overlay').classList.remove('hidden');
    });
</script>