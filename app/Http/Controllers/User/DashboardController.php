<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Location;
use App\Models\News;
use App\Models\Withdrawal;
use App\Models\WasteType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        
        $memberAccount = $user->memberAccount;
        
        if (!$memberAccount) {
            return view('user.beranda', [
                'user' => $user,
                'balance' => 0,
                'transactions' => [],
                'wasteTypes' => [],
                'news' => [],
                'locations' => [],
                'monthlyGrowth' => 0
            ]);
        }
        
        $balance = $memberAccount->balance;
        
        $currentMonth = now()->month;
        $lastMonth = now()->subMonth()->month;
        
        $currentMonthDeposits = Deposit::where('member_account_id', $memberAccount->id)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_price');
            
        $lastMonthDeposits = Deposit::where('member_account_id', $memberAccount->id)
            ->whereMonth('created_at', $lastMonth)
            ->sum('total_price');
            
        $monthlyGrowth = 0;
        if ($lastMonthDeposits > 0) {
            $monthlyGrowth = (($currentMonthDeposits - $lastMonthDeposits) / $lastMonthDeposits) * 100;
        } elseif ($currentMonthDeposits > 0) {
            $monthlyGrowth = 100;
        }
        
        $wasteTypes = WasteType::all();
        
        $depositTransactions = Deposit::where('member_account_id', $memberAccount->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($deposit) {
                return [
                    'id' => $deposit->id,
                    'type' => 'deposit',
                    'description' => 'Setoran Sampah',
                    'amount' => $deposit->total_price,
                    'created_at' => $deposit->created_at
                ];
            });
            
        $withdrawalTransactions = Withdrawal::where('member_account_id', $memberAccount->id)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($withdrawal) {
                return [
                    'id' => $withdrawal->id,
                    'type' => 'withdrawal',
                    'description' => 'Tarik Dana (' . ($withdrawal->ewallet_type ?? 'Tunai') . ')',
                    'amount' => -$withdrawal->amount,
                    'created_at' => $withdrawal->created_at
                ];
            });
            
        $allTransactions = $depositTransactions->concat($withdrawalTransactions)
            ->sortByDesc('created_at')
            ->take(5);
        
        $news = News::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        $locations = Location::all();
        
        $minimumBalance = 10000;
        $withdrawableAmount = max(0, $balance - $minimumBalance);
        
        return view('user.beranda', [
            'user' => $user,
            'memberAccount' => $memberAccount,
            'balance' => $balance,
            'monthlyGrowth' => round($monthlyGrowth, 1),
            'transactions' => $allTransactions,
            'wasteTypes' => $wasteTypes,
            'news' => $news,
            'locations' => $locations,
            'minimumBalance' => $minimumBalance,
            'withdrawableAmount' => $withdrawableAmount
        ]);
    }
}