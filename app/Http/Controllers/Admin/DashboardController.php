<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\WasteType;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = User::where('role', 'member')->count();

        $lastMonthMembers = User::where('role', 'member')
            ->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->count();
        $currentMonthMembers = User::where('role', 'member')
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->count();
        $memberGrowthPercentage = $lastMonthMembers > 0
            ? round((($currentMonthMembers - $lastMonthMembers) / $lastMonthMembers) * 100)
            : 0;

        $totalWasteWeight = Deposit::sum('weight_kg');

        $lastWeekWeight = Deposit::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ])->sum('weight_kg');
        $currentWeekWeight = Deposit::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->sum('weight_kg');
        $wasteGrowthPercentage = $lastWeekWeight > 0
            ? round((($currentWeekWeight - $lastWeekWeight) / $lastWeekWeight) * 100)
            : 0;

        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');

        $lastWeekWithdrawals = Withdrawal::where('status', 'approved')
            ->whereBetween('created_at', [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ])->sum('amount');
        $currentWeekWithdrawals = Withdrawal::where('status', 'approved')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->sum('amount');
        $withdrawalsGrowthPercentage = $lastWeekWithdrawals > 0
            ? round((($currentWeekWithdrawals - $lastWeekWithdrawals) / $lastWeekWithdrawals) * 100)
            : 0;

        $totalDeposits = Deposit::count();

        $newDeposits = Deposit::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        $topWasteTypes = WasteType::select('waste_types.id', 'waste_types.name')
            ->join('deposits', 'waste_types.id', '=', 'deposits.waste_type_id')
            ->groupBy('waste_types.id', 'waste_types.name')
            ->orderByRaw('SUM(deposits.weight_kg) DESC')
            ->limit(3)
            ->get();

        $topWasteTypeIds = $topWasteTypes->pluck('id')->toArray();

        $latestWithdrawals = Withdrawal::with(['memberAccount.user'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $latestWithdrawalsData = $latestWithdrawals->map(function ($withdrawal) {
            $elapsed = Carbon::parse($withdrawal->created_at)->diffForHumans();
            $amount = number_format($withdrawal->amount, 0, ',', '.');

            return [
                'id' => $withdrawal->id,
                'user_name' => $withdrawal->memberAccount->user->name ?? 'Unknown',
                'bank_name' => 'Bank Sampah ' . ucfirst(str_shuffle('abcdefgh')), // Simulated bank name
                'amount' => $amount,
                'method' => $withdrawal->ewallet_type ?? ($withdrawal->method === 'cash' ? 'Tunai' : 'Transfer'),
                'time_elapsed' => $elapsed
            ];
        });

        $wasteStatistics = WasteType::select('waste_types.name')
            ->leftJoin('deposits', 'waste_types.id', '=', 'deposits.waste_type_id')
            ->groupBy('waste_types.name')
            ->selectRaw('SUM(COALESCE(deposits.weight_kg, 0)) as total_weight')
            ->orderBy('total_weight', 'desc')
            ->get()
            ->map(function ($item) use ($totalWasteWeight) {
                $percentage = $totalWasteWeight > 0 ? round(($item->total_weight / $totalWasteWeight) * 100) : 0;
                return [
                    'name' => $item->name,
                    'weight' => round($item->total_weight, 2),
                    'percentage' => $percentage
                ];
            });

        $weeklyData = $this->getWeeklyData($topWasteTypeIds);
        $monthlyData = $this->getMonthlyData($topWasteTypeIds);
        $yearlyData = $this->getYearlyData($topWasteTypeIds);

        $balanceGrowthData = $this->getBalanceGrowthData();

        return view('admin.dashboard', compact(
            'totalMembers',
            'memberGrowthPercentage',
            'totalWasteWeight',
            'wasteGrowthPercentage',
            'totalWithdrawals',
            'withdrawalsGrowthPercentage',
            'totalDeposits',
            'newDeposits',
            'topWasteTypes',
            'weeklyData',
            'monthlyData',
            'yearlyData',
            'latestWithdrawalsData',
            'wasteStatistics',
            'balanceGrowthData'
        ));
    }

    private function getWeeklyData($topWasteTypeIds)
    {
        $endDate = Carbon::now()->endOfWeek();
        $startDate = Carbon::now()->subWeeks(6)->startOfWeek();

        $periods = collect();
        $currentDate = clone $startDate;

        while ($currentDate <= $endDate) {
            $weekStart = clone $currentDate;
            $weekEnd = clone $currentDate->endOfWeek();

            $periods->push([
                'start' => $weekStart,
                'end' => $weekEnd,
                'label' => 'Week ' . $weekStart->format('W')
            ]);

            $currentDate->addWeek();
        }

        $result = [
            'labels' => $periods->pluck('label')->toArray(),
            'datasets' => []
        ];

        foreach ($topWasteTypeIds as $index => $wasteTypeId) {
            $wasteType = WasteType::find($wasteTypeId);

            if (!$wasteType)
                continue;

            $data = $periods->map(function ($period) use ($wasteTypeId) {
                return Deposit::where('waste_type_id', $wasteTypeId)
                    ->whereBetween('created_at', [$period['start'], $period['end']])
                    ->sum('weight_kg');
            })->toArray();

            $colors = [
                '#10b981',
                '#3b82f6',
                '#f59e0b',
            ];

            $result['datasets'][] = [
                'label' => $wasteType->name . ' (kg)',
                'data' => $data,
                'borderColor' => $colors[$index % count($colors)],
                'backgroundColor' => $this->hexToRgba($colors[$index % count($colors)], 0.1)
            ];
        }

        return $result;
    }

    private function getMonthlyData($topWasteTypeIds)
    {
        // Get data for the last 12 months
        $months = collect();
        $endDate = Carbon::now();

        for ($i = 11; $i >= 0; $i--) {
            $date = clone $endDate;
            $date->subMonths($i);

            $months->push([
                'start' => (clone $date)->startOfMonth(),
                'end' => (clone $date)->endOfMonth(),
                'label' => $date->format('M')
            ]);
        }

        // Prepare result structure
        $result = [
            'labels' => $months->pluck('label')->toArray(),
            'datasets' => []
        ];

        // Get data for each waste type
        foreach ($topWasteTypeIds as $index => $wasteTypeId) {
            $wasteType = WasteType::find($wasteTypeId);

            if (!$wasteType)
                continue;

            $data = $months->map(function ($month) use ($wasteTypeId) {
                return Deposit::where('waste_type_id', $wasteTypeId)
                    ->whereBetween('created_at', [$month['start'], $month['end']])
                    ->sum('weight_kg');
            })->toArray();

            $colors = [
                '#10b981',
                '#3b82f6',
                '#f59e0b',
            ];

            $result['datasets'][] = [
                'label' => $wasteType->name . ' (kg)',
                'data' => $data,
                'borderColor' => $colors[$index % count($colors)],
                'backgroundColor' => $this->hexToRgba($colors[$index % count($colors)], 0.1)
            ];
        }

        return $result;
    }

    private function getYearlyData($topWasteTypeIds)
    {
        $years = collect();
        $currentYear = Carbon::now()->year;

        for ($i = 4; $i >= 0; $i--) {
            $year = $currentYear - $i;

            $years->push([
                'start' => Carbon::createFromDate($year, 1, 1)->startOfYear(),
                'end' => Carbon::createFromDate($year, 12, 31)->endOfYear(),
                'label' => (string) $year
            ]);
        }

        $result = [
            'labels' => $years->pluck('label')->toArray(),
            'datasets' => []
        ];

        foreach ($topWasteTypeIds as $index => $wasteTypeId) {
            $wasteType = WasteType::find($wasteTypeId);

            if (!$wasteType)
                continue;

            $data = $years->map(function ($year) use ($wasteTypeId) {
                return Deposit::where('waste_type_id', $wasteTypeId)
                    ->whereBetween('created_at', [$year['start'], $year['end']])
                    ->sum('weight_kg');
            })->toArray();

            $colors = [
                '#10b981',
                '#3b82f6',
                '#f59e0b',
            ];

            $result['datasets'][] = [
                'label' => $wasteType->name . ' (kg)',
                'data' => $data,
                'borderColor' => $colors[$index % count($colors)],
                'backgroundColor' => $this->hexToRgba($colors[$index % count($colors)], 0.1)
            ];
        }

        return $result;
    }

    private function getBalanceGrowthData()
    {
        $months = collect();
        $endDate = Carbon::now();

        for ($i = 5; $i >= 0; $i--) {
            $date = clone $endDate;
            $date->subMonths($i);

            $months->push([
                'start' => (clone $date)->startOfMonth(),
                'end' => (clone $date)->endOfMonth(),
                'label' => $date->format('M')
            ]);
        }

        $deposits = $months->map(function ($month) {
            return Deposit::whereBetween('created_at', [$month['start'], $month['end']])
                ->sum('total_price');
        })->toArray();

        $withdrawals = $months->map(function ($month) {
            return Withdrawal::where('status', 'approved')
                ->whereBetween('created_at', [$month['start'], $month['end']])
                ->sum('amount');
        })->toArray();

        return [
            'labels' => $months->pluck('label')->toArray(),
            'deposits' => $deposits,
            'withdrawals' => $withdrawals
        ];
    }

    private function hexToRgba($hex, $opacity = 1)
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return "rgba($r, $g, $b, $opacity)";
    }
}