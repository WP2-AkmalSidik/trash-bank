@extends('admin.app')
@section('title', 'Pengajuan Penarikan Saldo')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
            <div class="mx-auto">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Pengajuan Penarikan Saldo</h1>
                    
                    <!-- Filter Controls -->
                    <div class="flex items-center gap-3">
                        <form action="{{ route('pengajuan.filter') }}" method="GET" class="flex items-center gap-3">
                            <div class="relative">
                                <select id="status-filter" name="status" class="pl-3 pr-8 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-700 text-gray-800 dark:text-white appearance-none" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </form>
                        
                        <!-- Refresh Button -->
                        <a href="{{ route('pengajuan.index') }}" id="refresh-btn" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            <i class="fas fa-sync-alt text-gray-700 dark:text-gray-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <i onclick="document.getElementById('alert-success').classList.add('hidden')" class="fas fa-times cursor-pointer"></i>
                        </span>
                    </div>
                @endif

                @if(session('error'))
                    <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <i onclick="document.getElementById('alert-error').classList.add('hidden')" class="fas fa-times cursor-pointer"></i>
                        </span>
                    </div>
                @endif

                <!-- Withdrawal Table -->
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nasabah</th>
                                <th class="px-4 py-3">No. Rekening</th>
                                <th class="px-4 py-3">Jumlah</th>
                                <th class="px-4 py-3">Metode</th>
                                <th class="px-4 py-3">Detail E-Wallet</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @forelse($withdrawals as $index => $withdrawal)
                            <tr class="text-gray-700 dark:text-gray-300">
                                <td class="px-4 py-3">{{ $index + $withdrawals->firstItem() }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 flex items-center justify-center font-semibold mr-2">
                                            {{ substr($withdrawal->memberAccount->user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $withdrawal->memberAccount->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $withdrawal->memberAccount->account_number }}</td>
                                <td class="px-4 py-3 font-semibold">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full {{ $withdrawal->method == 'cash' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }} text-xs">
                                        {{ $withdrawal->method == 'cash' ? 'Tunai' : 'E-Wallet' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($withdrawal->method == 'ewallet')
                                        <div class="text-sm">
                                            <div><span class="font-medium">{{ $withdrawal->ewallet_type }}</span></div>
                                            <div>{{ $withdrawal->ewallet_number }}</div>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full 
                                        @if($withdrawal->status == 'approved') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 
                                        @elseif($withdrawal->status == 'rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 
                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 
                                        @endif text-xs">
                                        {{ $withdrawal->status == 'approved' ? 'Disetujui' : ($withdrawal->status == 'rejected' ? 'Ditolak' : 'Menunggu') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($withdrawal->status == 'pending')
                                        <div class="flex items-center space-x-2">
                                            <button onclick="openApproveModal({{ $withdrawal->id }})" class="px-2 py-1 rounded-md bg-green-500 text-white hover:bg-green-600 transition-colors flex items-center text-xs">
                                                <i class="fas fa-check mr-1"></i> Setujui
                                            </button>
                                            <button onclick="openRejectModal({{ $withdrawal->id }})" class="px-2 py-1 rounded-md bg-red-500 text-white hover:bg-red-600 transition-colors flex items-center text-xs">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    Tidak ada data pengajuan penarikan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-4 py-3 border-t dark:border-gray-700">
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </section>

        <!-- Modal Approve -->
        <div id="approveModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
                <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Konfirmasi Persetujuan</h3>
                    <button onclick="closeApproveModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-5">
                    <p class="text-gray-600 dark:text-gray-300 mb-4">Anda yakin ingin menyetujui pengajuan penarikan ini?</p>
                    <p class="text-gray-600 dark:text-gray-300 mb-4"><strong>Catatan:</strong> Saldo nasabah akan otomatis dikurangi sesuai dengan jumlah penarikan.</p>
                    <form id="approveForm" action="" method="POST">
                        @csrf
                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeApproveModal()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                                Setujui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Reject -->
        <div id="rejectModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
                <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Konfirmasi Penolakan</h3>
                    <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-5">
                    <p class="text-gray-600 dark:text-gray-300 mb-2">Anda yakin ingin menolak pengajuan penarikan ini?</p>
                    <form id="rejectForm" action="" method="POST">
                        @csrf
                        <textarea id="rejection_reason" name="rejection_reason" placeholder="Alasan penolakan (opsional)" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg mb-4 bg-white dark:bg-gray-700 text-gray-800 dark:text-white"></textarea>
                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeRejectModal()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                                Tolak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal Functions
        function openApproveModal(id) {
            document.getElementById('approveModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Set form action
            document.getElementById('approveForm').action = `/admin/pengajuan/${id}/approve`;
        }
        
        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function openRejectModal(id) {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Set form action
            document.getElementById('rejectForm').action = `/admin/pengajuan/${id}/reject`;
        }
        
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('rejection_reason').value = '';
        }
    </script>
@endsection