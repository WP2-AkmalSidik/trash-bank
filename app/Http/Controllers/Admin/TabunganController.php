<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Deposit;
use App\Models\WasteType;
use Illuminate\Http\Request;
use App\Models\MemberAccount;
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
            return view('admin.transaksi.tabungan.components.member-table', compact('members'));
        }

        return view('admin.transaksi.tabungan.index', compact('members', 'wasteTypes'));
    }

    /**
     * Get member data for the transaction form
     */
    public function getMemberData(Request $request)
    {
        $member = User::where('role', 'member')
            ->with(['memberAccount', 'memberAccount.deposits'])
            ->findOrFail($request->member_id);

        // Calculate total balance from deposits
        $totalDeposits = $member->memberAccount->deposits->sum('total_price');

        return response()->json([
            'member' => $member,
            'balance' => number_format($totalDeposits, 0, ',', '.'),
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
            $totalPrice = $wasteType->price_per_kg * $request->weight_kg;

            Deposit::create([
                'member_account_id' => $request->member_account_id,
                'waste_type_id' => $request->waste_type_id,
                'weight_kg' => $request->weight_kg,
                'total_price' => $totalPrice,
            ]);

            DB::commit();

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi setoran sampah berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
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
            ->with('memberAccount')
            ->findOrFail($memberId);

        $deposits = Deposit::with(['wasteType'])
            ->where('member_account_id', $member->memberAccount->id)
            ->latest()
            ->paginate(10);

        // Calculate total balance
        $totalBalance = $deposits->sum('total_price');

        if ($request->ajax()) {
            return view('admin.transaksi.components.history-table', compact('deposits'));
        }

        return view('admin.transaksi.tabungan.history', compact('member', 'deposits', 'totalBalance'));
    }

    /**
     * Print transaction receipt
     */
    public function printReceipt($id)
    {
        $deposit = Deposit::with(['memberAccount.user', 'wasteType'])
            ->findOrFail($id);

        return view('admin.transaksi.tabungan.components.receipt', compact('deposit'));
    }

    /**
     * Print all transaction history as PDF
     */
    public function printHistory($memberId)
    {
        $member = User::where('role', 'member')
            ->with('memberAccount')
            ->findOrFail($memberId);

        $deposits = Deposit::with(['wasteType'])
            ->where('member_account_id', $member->memberAccount->id)
            ->latest()
            ->get();

        $totalBalance = $deposits->sum('total_price');

        $pdf = PDF::loadView('admin.transaksi.tabungan.components.history-pdf', [
            'member' => $member,
            'deposits' => $deposits,
            'totalBalance' => $totalBalance,
            'printedAt' => now()->format('d F Y H:i:s')
        ]);

        return $pdf->download('riwayat-transaksi-' . $member->memberAccount->account_number . '.pdf');
    }
}