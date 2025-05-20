<div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    No</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Nasabah</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    No. Rek</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Jumlah</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Metode</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Detail E-Wallet</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status</th>
                <th
                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($withdrawals as $index => $withdrawal)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                    id="withdrawal-row-{{ $withdrawal->id }}">
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        {{ $index + $withdrawals->firstItem() }}</td>

                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center font-medium text-blue-800 dark:text-blue-200">
                                {{ substr($withdrawal->memberAccount->user->name, 0, 1) }}
                            </div>
                            <div class="ml-2">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $withdrawal->memberAccount->user->name }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        {{ $withdrawal->memberAccount->account_number }}</td>

                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                        Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                    </td>

                    <td class="px-4 py-3 whitespace-nowrap">
                        <span
                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $withdrawal->method == 'cash' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }}">
                            {{ $withdrawal->method == 'cash' ? 'Tunai' : 'E-Wallet' }}
                        </span>
                    </td>

                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        @if ($withdrawal->method == 'ewallet')
                            <div>
                                <div class="font-medium">{{ $withdrawal->ewallet_type }}</div>
                                <div>{{ $withdrawal->ewallet_number }}</div>
                                @if ($withdrawal->proof_of_transfer)
                                    <button onclick="viewProofOfTransfer('{{ $withdrawal->id }}')"
                                        class="mt-1 text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 underline">
                                        Lihat Bukti Transfer
                                    </button>
                                @else
                                    <div class="mt-1">
                                        <span class="text-xs text-orange-500">Belum ada bukti</span>
                                        @if ($withdrawal->status == 'pending')
                                            <button onclick="showProofUploadModal('{{ $withdrawal->id }}')"
                                                class="ml-1 text-xs text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 underline">
                                                Upload
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="px-4 py-3 whitespace-nowrap">
                        <span
                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if ($withdrawal->status == 'approved') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 
                            @elseif($withdrawal->status == 'rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 
                            @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @endif">
                            {{ $withdrawal->status == 'approved' ? 'Disetujui' : ($withdrawal->status == 'rejected' ? 'Ditolak' : 'Menunggu') }}
                        </span>
                    </td>

                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                        @if ($withdrawal->status == 'pending')
                            <div class="flex space-x-1">
                                <button onclick="approveWithdrawal({{ $withdrawal->id }})"
                                    class="p-1 rounded bg-green-500 text-white hover:bg-green-600 transition-colors 
                                    {{ $withdrawal->method == 'ewallet' && !$withdrawal->proof_of_transfer ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    title="Setujui">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <button onclick="showRejectForm({{ $withdrawal->id }})"
                                    class="p-1 rounded bg-red-500 text-white hover:bg-red-600 transition-colors"
                                    title="Tolak">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <span class="text-gray-400 text-xs">Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada data pengajuan penarikan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
