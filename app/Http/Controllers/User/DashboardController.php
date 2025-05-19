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
    /**
     * Display user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user account details
        $memberAccount = $user->memberAccount;
        
        if (!$memberAccount) {
            // If user doesn't have an account yet
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
        
        // Get member balance
        $balance = $memberAccount->balance;
        
        // Calculate monthly growth percentage
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
            $monthlyGrowth = 100; // If there were no deposits last month but there are this month
        }
        
        // Get waste types with price changes
        $wasteTypes = WasteType::all();
        
        // Calculate price changes for each waste type (simulate previous prices for demo)
        foreach ($wasteTypes as $wasteType) {
            // In a real application, you'd get the previous price from a price history table
            // For demo purposes, we'll generate a random previous price to show the percentage change
            $previousPrice = $wasteType->price_per_kg * (1 - (rand(-10, 10) / 100));
            $priceChange = (($wasteType->price_per_kg - $previousPrice) / $previousPrice) * 100;
            $wasteType->price_change = round($priceChange, 1);
            $wasteType->is_increase = $priceChange > 0;
        }
        
        // Get the last 5 transactions (deposits and withdrawals)
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
            
        // Combine and sort transactions
        $allTransactions = $depositTransactions->concat($withdrawalTransactions)
            ->sortByDesc('created_at')
            ->take(5);
        
        // Get the latest 3 news/announcements
        $news = News::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        // Get list of waste bank locations
        $locations = Location::all();
        
        // Minimum balance required for withdrawals
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