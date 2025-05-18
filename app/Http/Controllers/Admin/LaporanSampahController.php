<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Deposit;
use App\Models\WasteType;
use App\Models\MemberAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class LaporanSampahController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $wasteTypeId = $request->input('waste_type_id');

        if ($request->has('export')) {
            return $this->export($request);
        }

        // Cache waste types to improve performance
        $wasteTypes = Cache::remember('waste_types', 60*24, function() {
            return WasteType::all();
        });

        // Generate a cache key based on filter parameters
        $cacheKey = "waste_data_{$month}_{$year}_" . ($wasteTypeId ?? 'all');
        
        // Cache waste data for 30 minutes
        $wasteData = Cache::remember($cacheKey, 30, function() use ($month, $year, $wasteTypeId) {
            return $this->getWasteTypeData($month, $year, $wasteTypeId);
        });

        // Cache available years for 24 hours
        $years = Cache::remember('available_years', 60*24, function() {
            return $this->getAvailableYears();
        });
        
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Cache summary data
        $summaryCacheKey = "summary_data_{$month}_{$year}_" . ($wasteTypeId ?? 'all');
        $summary = Cache::remember($summaryCacheKey, 30, function() use ($month, $year, $wasteTypeId) {
            return $this->getSummaryData($month, $year, $wasteTypeId);
        });

        if ($request->ajax()) {
            return response()->json([
                'wasteData' => $wasteData,
                'summary' => $summary
            ]);
        }

        return view('admin.sampah.index', [
            'wasteData' => $wasteData,
            'wasteTypes' => $wasteTypes,
            'years' => $years,
            'months' => $months,
            'selectedMonth' => $month,
            'selectedYear' => $year,
            'selectedWasteTypeId' => $wasteTypeId,
            'summary' => $summary
        ]);
    }

    public function export(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $wasteTypeId = $request->input('waste_type_id');

        // Use cached data if available
        $cacheKey = "waste_data_{$month}_{$year}_" . ($wasteTypeId ?? 'all');
        $wasteData = Cache::remember($cacheKey, 30, function() use ($month, $year, $wasteTypeId) {
            return $this->getWasteTypeData($month, $year, $wasteTypeId);
        });

        $summaryCacheKey = "summary_data_{$month}_{$year}_" . ($wasteTypeId ?? 'all');
        $summary = Cache::remember($summaryCacheKey, 30, function() use ($month, $year, $wasteTypeId) {
            return $this->getSummaryData($month, $year, $wasteTypeId);
        });

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $reportTitle = $this->getReportTitle($month, $year, $wasteTypeId, $wasteData);

        try {
            $pdf = PDF::loadView('admin.sampah.pdf', [
                'wasteData' => $wasteData,
                'summary' => $summary,
                'reportTitle' => $reportTitle,
                'month' => isset($months[$month]) ? $months[$month] : '',
                'year' => $year
            ]);
            
            return $pdf->download('laporan-sampah-' . now()->format('Ymd-His') . '.pdf');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Gagal mengekspor PDF: ' . $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Gagal mengekspor PDF: ' . $e->getMessage());
        }
    }

    
    private function getWasteTypeData($month, $year, $wasteTypeId = null)
    {
        $query = WasteType::query();

        if ($wasteTypeId) {
            $query->where('id', $wasteTypeId);
        }

        // Optimize query with eager loading if needed
        $wasteTypes = $query->get();

        $result = [];

        foreach ($wasteTypes as $wasteType) {
            // Use query builder efficiently with proper indexing
            $depositsQuery = Deposit::where('waste_type_id', $wasteType->id);

            if ($month && $year) {
                $depositsQuery->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year);
            } elseif ($year) {
                $depositsQuery->whereYear('created_at', $year);
            }

            // Use a single query to get all aggregates instead of multiple queries
            $aggregates = $depositsQuery->selectRaw('
                COUNT(*) as transaction_count, 
                SUM(weight_kg) as total_weight, 
                SUM(total_price) as total_price
            ')->first();

            if ($aggregates && $aggregates->transaction_count > 0) {
                $result[] = [
                    'id' => $wasteType->id,
                    'name' => $wasteType->name,
                    'total_weight' => $aggregates->total_weight,
                    'transaction_count' => $aggregates->transaction_count,
                    'total_price' => $aggregates->total_price
                ];
            }
        }

        usort($result, function ($a, $b) {
            return $b['total_weight'] <=> $a['total_weight'];
        });

        return $result;
    }

    
    private function getSummaryData($month, $year, $wasteTypeId = null)
    {
        $query = Deposit::query();

        if ($month && $year) {
            $query->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
        } elseif ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($wasteTypeId) {
            $query->where('waste_type_id', $wasteTypeId);
        }

        // Use a single query to get all aggregates
        $aggregates = $query->selectRaw('
            COUNT(DISTINCT DATE(created_at)) as total_days,
            COUNT(*) as total_transactions,
            SUM(weight_kg) as total_weight,
            SUM(total_price) as total_price
        ')->first();

        return [
            'total_days' => $aggregates->total_days ?? 0,
            'total_transactions' => $aggregates->total_transactions ?? 0,
            'total_weight' => $aggregates->total_weight ?? 0,
            'total_price' => $aggregates->total_price ?? 0
        ];
    }

    
    private function getAvailableYears()
    {
        // Using index on created_at for better performance
        $years = Deposit::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (empty($years)) {
            $years = [Carbon::now()->year];
        }

        return $years;
    }

    
    private function getReportTitle($month, $year, $wasteTypeId, $wasteData)
    {
        $title = 'Laporan Sampah';

        if ($month && $year) {
            $monthName = Carbon::createFromDate($year, $month, 1)->translatedFormat('F');
            $title .= " - {$monthName} {$year}";
        } elseif ($year) {
            $title .= " - Tahun {$year}";
        }

        if ($wasteTypeId && count($wasteData) > 0) {
            $title .= " - Jenis: {$wasteData[0]['name']}";
        }

        return $title;
    }

    // New method for search functionality with AJAX
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Use query builder for more efficient search
        $wasteTypes = WasteType::where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name']);

        return response()->json($wasteTypes);
    }
}