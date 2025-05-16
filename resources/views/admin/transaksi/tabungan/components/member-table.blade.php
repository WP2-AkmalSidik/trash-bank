<!-- resources/views/admin/transaksi/components/member-table.blade.php -->
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <th class="px-4 py-3">Nasabah</th>
                    <th class="px-4 py-3">No. Rekening</th>
                    <th class="px-4 py-3">No. Telepon</th>
                    <th class="px-4 py-3">Saldo</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($members as $member)
                    <tr class="text-gray-700 dark:text-gray-300">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-700 dark:text-gray-300 font-semibold text-lg mr-3">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $member->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            {{ $member->memberAccount->account_number }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $member->phone_number ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-semibold">
                                <?php 
                                $totalDeposits = $member->memberAccount->deposits->sum('total_price');
                                echo 'Rp ' . number_format($totalDeposits, 0, ',', '.'); 
                                ?>
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-2">
                                <button 
                                    onclick="openTransactionModal({{ $member->id }}, '{{ $member->name }}', {{ $member->memberAccount->id }})"
                                    class="px-2 py-1 rounded-md bg-green-500 text-white hover:bg-green-600 transition-colors flex items-center">
                                    <i class="fa-solid fa-plus mr-1"></i>Saldo
                                </button>
                                <a href="{{ route('transaksi.history', $member->id) }}" 
                                   class="px-2 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-600 transition-colors flex items-center">
                                    <i class="fa-solid fa-clock-rotate-left me-1"></i>Riwayat
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center">
                            Tidak ada data nasabah
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-t dark:border-gray-700">
        {{ $members->links() }}
    </div>
</div>