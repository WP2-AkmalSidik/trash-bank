<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Location;
use App\Models\News;
use App\Models\Withdrawal;
use App\Models\WasteType;
use App\Models\MemberAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $memberAccount = $user->memberAccount;

        if (!$memberAccount) {
            return view('user.beranda', [
                'user' => $user,
                'memberAccount' => null,
                'balance' => 0,
                'monthlyGrowth' => 0,
                'transactions' => collect(),
                'wasteTypes' => WasteType::all(),
                'news' => News::orderBy('created_at', 'desc')->take(3)->get(),
                'locations' => Location::all(),
                'minimumBalance' => 10000,
                'withdrawableAmount' => 0
            ]);
        }

        $memberAccount->load([
            'deposits' => function ($query) {
                $query->select('member_account_id', DB::raw('SUM(total_price) as total'))
                    ->groupBy('member_account_id');
            },
            'withdrawals' => function ($query) {
                $query->where('status', 'approved')
                    ->select('member_account_id', DB::raw('SUM(amount) as total'))
                    ->groupBy('member_account_id');
            }
        ]);

        $totalDeposits = $memberAccount->deposits->first()->total ?? 0;
        $totalWithdrawals = $memberAccount->withdrawals->first()->total ?? 0;
        $balance = $totalDeposits - $totalWithdrawals;

        if ($memberAccount->balance != $balance) {
            $memberAccount->balance = $balance;
            $memberAccount->save();
        }

        $monthlyGrowth = $this->calculateMonthlyGrowth($memberAccount->id);

        $transactions = $this->getLatestTransactions($memberAccount->id);

        $wasteTypes = WasteType::all();
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        $locations = Location::all();
        $minimumBalance = 10000;
        $withdrawableAmount = max(0, $balance - $minimumBalance);

        return view('user.beranda', [
            'user' => $user,
            'memberAccount' => $memberAccount,
            'balance' => $balance,
            'monthlyGrowth' => $monthlyGrowth,
            'transactions' => $transactions,
            'wasteTypes' => $wasteTypes,
            'news' => $news,
            'locations' => $locations,
            'minimumBalance' => $minimumBalance,
            'withdrawableAmount' => $withdrawableAmount
        ]);
    }

    private function calculateMonthlyGrowth($accountId)
    {
        $currentMonth = now()->month;
        $lastMonth = now()->subMonth()->month;

        $currentMonthDeposits = Deposit::where('member_account_id', $accountId)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_price');

        $lastMonthDeposits = Deposit::where('member_account_id', $accountId)
            ->whereMonth('created_at', $lastMonth)
            ->sum('total_price');

        $monthlyGrowth = 0;
        if ($lastMonthDeposits > 0) {
            $monthlyGrowth = (($currentMonthDeposits - $lastMonthDeposits) / $lastMonthDeposits) * 100;
        } elseif ($currentMonthDeposits > 0) {
            $monthlyGrowth = 100;
        }

        return round($monthlyGrowth, 1);
    }

    private function getLatestTransactions($accountId)
    {
        $deposits = Deposit::where('member_account_id', $accountId)
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

        $withdrawals = Withdrawal::where('member_account_id', $accountId)
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

        return $deposits->concat($withdrawals)
            ->sortByDesc('created_at')
            ->take(5);
    }

    public static function syncAccountBalance($accountId)
    {
        $account = MemberAccount::findOrFail($accountId);

        $totalDeposits = Deposit::where('member_account_id', $accountId)
            ->sum('total_price');

        $totalWithdrawals = Withdrawal::where('member_account_id', $accountId)
            ->where('status', 'approved')
            ->sum('amount');

        $balance = $totalDeposits - $totalWithdrawals;

        $account->balance = $balance;
        $account->save();

        return $balance;
    }
    public function getAnnouncement($id)
    {
        $announcement = News::findOrFail($id);

        return response()->json([
            'title' => $announcement->title,
            'content' => $announcement->content,
            'created_at' => $announcement->created_at
        ]);
    }
}