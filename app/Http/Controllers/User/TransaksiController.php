<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Bonus;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $filter = $request->get('filter', 'all');
        
        $groupedTransactions = $this->getTransactions($user, $filter);
        
        if ($request->ajax()) {
            return view('user.partials.transaksi.list-transaksi', [
                'groupedTransactions' => $groupedTransactions,
                'activeFilter' => $filter
            ]);
        }
        
        return view('user.transaksi', [
            'groupedTransactions' => $groupedTransactions,
            'activeFilter' => $filter
        ]);
    }
    
    public function filter(Request $request)
    {
        $user = auth()->user();
        $filter = $request->get('filter', 'all');
        
        $groupedTransactions = $this->getTransactions($user, $filter);
        
        return view('user.partials.transaksi.list-transaksi', [
            'groupedTransactions' => $groupedTransactions,
            'activeFilter' => $filter
        ]);
    }
    
    protected function getTransactions($user, $filter)
    {
        $transactions = collect();
        
        if ($filter === 'all' || $filter === 'tabungan') {
            $deposits = Deposit::with(['wasteType', 'memberAccount'])
                ->whereHas('memberAccount', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get()
                ->map(function($deposit) {
                    return [
                        'type' => 'deposit',
                        'title' => 'Setoran Sampah (' . $deposit->wasteType->name . ')',
                        'amount' => $deposit->total_price,
                        'date' => $deposit->created_at,
                        'status' => 'success',
                        'icon' => 'green',
                        'icon_svg' => 'M12 6v6m0 0v6m0-6h6m-6 0H6'
                    ];
                });
                
            $transactions = $transactions->merge($deposits);
        }
        
        if ($filter === 'all' || $filter === 'penarikan') {
            $withdrawals = Withdrawal::with('memberAccount')
                ->whereHas('memberAccount', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where('status', 'approved')
                ->get()
                ->map(function($withdrawal) {
                    return [
                        'type' => 'withdrawal',
                        'title' => 'Penarikan Dana (' . $withdrawal->method . ')',
                        'amount' => $withdrawal->amount,
                        'date' => $withdrawal->updated_at,
                        'status' => 'success',
                        'icon' => 'red',
                        'icon_svg' => 'M5 13l4 4L19 7'
                    ];
                });
                
            $transactions = $transactions->merge($withdrawals);
        }
        
        // Urutkan berdasarkan tanggal descending
        $transactions = $transactions->sortByDesc('date');
        
        // Kelompokkan berdasarkan bulan
        return $transactions->groupBy(function($item) {
            return Carbon::parse($item['date'])->format('F Y');
        });
    }
}