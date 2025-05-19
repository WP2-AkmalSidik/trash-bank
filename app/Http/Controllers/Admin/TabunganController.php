<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposit;
use App\Models\WasteType;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\MemberAccount;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TabunganController extends Controller
{
    /**
     * Display the transaction form
     */
    public function index(Request $request)
    {
        $members = User::where('role', 'member')
            ->whereHas('memberAccount')
            ->with('memberAccount')
            ->when($request->has('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhereHas('memberAccount', function ($q) use ($request) {
                        $q->where('account_number', 'like', '%' . $request->search . '%');
                    });
            })
            ->orderBy('name')
            ->paginate(10);

        $wasteTypes = WasteType::orderBy('name')->get();

        if ($request->ajax()) {
            return view('admin.tabungan.components.member-table', compact('members'));
        }

        return view('admin.tabungan.index', compact('members', 'wasteTypes'));
    }

    /**
     * Get member data for the transaction form
     */
    public function getMemberData(Request $request)
    {
        $member = User::where('role', 'member')
            ->with([
                'memberAccount.deposits',
                'memberAccount.withdrawals' => function ($q) {
                    $q->where('status', 'approved'); // hanya withdrawal yang disetujui
                }
            ])
            ->findOrFail($request->member_id);

        $totalDeposits = $member->memberAccount->deposits->sum('total_price');
        $totalWithdrawals = $member->memberAccount->withdrawals->sum('amount');
        $balance = $totalDeposits - $totalWithdrawals;

        return response()->json([
            'member' => $member,
            'balance' => number_format($balance, 0, ',', '.'),
        ]);
    }

    /**
     * Get waste type price
     */
    public function getWastePrice(Request $request)
    {
        $wasteType = WasteType::findOrFail($request->waste_type_id);
        return response()->json([
            'price' => $wasteType->price_per_kg,
        ]);
    }

    /**
     * Store new deposit transaction
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_account_id' => 'required|exists:member_accounts,id',
            'waste_type_id' => 'required|exists:waste_types,id',
            'weight_kg' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();
        try {
            $wasteType = WasteType::findOrFail($request->waste_type_id);
            $pricePerKg = $wasteType->price_per_kg;
            $totalPrice = $pricePerKg * $request->weight_kg;

            $deposit = Deposit::create([
                'member_account_id' => $request->member_account_id,
                'waste_type_id' => $request->waste_type_id,
                'weight_kg' => $request->weight_kg,
                'price_per_kg' => $pricePerKg, // Store current price at time of deposit
                'total_price' => $totalPrice,
            ]);

            $memberAccount = MemberAccount::with('user')->find($request->member_account_id);
            $memberName = $memberAccount->user->name ?? 'Nasabah';

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi setoran sampah berhasil disimpan!',
                    'deposit_id' => $deposit->id
                ]);
            }

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi setoran sampah berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show transaction history for a specific member
     */
    public function history(Request $request, $memberId)
    {
        $member = User::where('role', 'member')
            ->with([
                'memberAccount.deposits',
                'memberAccount.withdrawals' => function ($q) {
                    $q->where('status', 'approved');
                }
            ])
            ->findOrFail($memberId);

        // Dapatkan ID account member
        $accountId = $member->memberAccount->id;

        // Query untuk deposits dengan pagination
        $depositsQuery = DB::table('deposits')
            ->where('member_account_id', $accountId)
            ->select(
                'id',
                'member_account_id',
                'waste_type_id',
                'weight_kg',
                'price_per_kg', // Add price_per_kg to select
                'total_price',
                'created_at',
                'updated_at',
                DB::raw('"deposit" as type')
            );

        // Query untuk withdrawals yang approved dengan pagination
        $withdrawalsQuery = DB::table('withdrawals')
            ->where('member_account_id', $accountId)
            ->where('status', 'approved')
            ->select(
                'id',
                'member_account_id',
                DB::raw('NULL as waste_type_id'),
                DB::raw('NULL as weight_kg'),
                DB::raw('NULL as price_per_kg'), // Add price_per_kg field for consistency
                DB::raw('amount as total_price'),
                'created_at',
                'updated_at',
                DB::raw('"withdrawal" as type')
            );

        // Gabungkan menggunakan unionAll
        $transactionsQuery = $depositsQuery->unionAll($withdrawalsQuery);

        // Buat query utama untuk pagination
        $transactions = DB::table(DB::raw("({$transactionsQuery->toSql()}) as merged_transactions"))
            ->mergeBindings($transactionsQuery)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Load wasteType untuk deposit
        $wasteTypes = WasteType::whereIn(
            'id',
            collect($transactions->items())
                ->where('type', 'deposit')
                ->pluck('waste_type_id')
        )->get()->keyBy('id');

        // Tambahkan wasteType ke hasil
        $transactions->getCollection()->transform(function ($item) use ($wasteTypes) {
            if ($item->type === 'deposit') {
                $item->wasteType = $wasteTypes[$item->waste_type_id] ?? null;
            }
            return $item;
        });

        // Hitung total saldo
        $totalDeposits = $member->memberAccount->deposits->sum('total_price');
        $totalWithdrawals = $member->memberAccount->withdrawals->sum('amount');
        $totalBalance = $totalDeposits - $totalWithdrawals;

        if ($request->ajax()) {
            return view('admin.tabungan.components.history-table', compact('transactions'));
        }

        return view('admin.tabungan.history', compact('member', 'transactions', 'totalBalance'));
    }

    /**
     * Print transaction receipt
     */
    public function printReceipt($id)
    {
        $deposit = Deposit::with(['memberAccount.user', 'wasteType'])
            ->findOrFail($id);

        return view('admin.tabungan.components.receipt', compact('deposit'));
    }

    /**
     * Print all transaction history as PDF
     */
    public function printHistory($memberId)
    {
        $member = User::where('role', 'member')
            ->with([
                'memberAccount.deposits.wasteType',
                'memberAccount.withdrawals' => function ($q) {
                    $q->where('status', 'approved');
                }
            ])
            ->findOrFail($memberId);

        // Dapatkan ID account member
        $accountId = $member->memberAccount->id;

        // Query untuk deposits
        $deposits = Deposit::with('wasteType')
            ->where('member_account_id', $accountId)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'deposit',
                    'waste_type' => $item->wasteType,
                    'weight_kg' => $item->weight_kg,
                    'price_per_kg' => $item->price_per_kg, // Include price_per_kg
                    'total_price' => $item->total_price,
                    'created_at' => $item->created_at
                ];
            });

        // Query untuk withdrawals yang approved
        $withdrawals = Withdrawal::where('member_account_id', $accountId)
            ->where('status', 'approved')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'withdrawal',
                    'waste_type' => null,
                    'weight_kg' => null,
                    'price_per_kg' => null, // Include price_per_kg field for consistency
                    'total_price' => $item->amount,
                    'created_at' => $item->created_at
                ];
            });

        // Gabungkan dan urutkan
        $transactions = $deposits->merge($withdrawals)
            ->sortByDesc('created_at');

        $totalDeposits = $member->memberAccount->deposits->sum('total_price');
        $totalWithdrawals = $member->memberAccount->withdrawals->sum('amount');
        $totalBalance = $totalDeposits - $totalWithdrawals;

        $pdf = PDF::loadView('admin.tabungan.components.history-pdf', [
            'member' => $member,
            'transactions' => $transactions,
            'totalDeposits' => $totalDeposits,
            'totalWithdrawals' => $totalWithdrawals,
            'totalBalance' => $totalBalance,
            'printedAt' => now()->format('d F Y H:i:s')
        ]);

        return $pdf->download('riwayat-transaksi-' . $member->memberAccount->account_number . '.pdf');
    }

    /**
     * Delete a deposit transaction
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $deposit = Deposit::findOrFail($id);

            // Dapatkan data member untuk response
            $memberAccount = $deposit->memberAccount;
            $memberId = $memberAccount->user_id;

            // Hapus transaksi
            $deposit->delete();

            DB::commit();

            // Hitung ulang saldo
            $totalDeposits = $memberAccount->deposits()->sum('total_price');
            $totalWithdrawals = $memberAccount->withdrawals()
                ->where('status', 'approved')
                ->sum('amount');
            $balance = $totalDeposits - $totalWithdrawals;

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dihapus!',
                'balance' => 'Rp ' . number_format($balance, 0, ',', '.'),
                'transaction_id' => $id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}