<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Deposit;
use App\Models\Residue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResidueController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month'); // bisa null artinya semua bulan
        $search = $request->input('search');

        $query = Residue::query();

        // Filter tahun
        $query->whereYear('created_at', $year);

        // Filter bulan jika dipilih
        if (!empty($month)) {
            $query->whereMonth('created_at', $month);
        }

        // Filter pencarian
        if (!empty($search)) {
            $query->where('name', 'like', "%$search%");
        }

        // Ambil data dan summary
        $residues = $query->latest()->get();
        $totalResidu = $residues->sum('weight_kg');

        $totalDeposit = Deposit::query()
            ->whereYear('created_at', $year)
            ->when($month, fn($q) => $q->whereMonth('created_at', $month))
            ->sum('weight_kg');

        $cleanWaste = $totalDeposit - $totalResidu;

        // Buat daftar bulan dan tahun untuk dropdown
        $months = collect(range(1, 12))->mapWithKeys(function ($m) {
            return [$m => Carbon::create()->month($m)->locale('id')->isoFormat('MMMM')];
        });

        $years = Residue::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year')->sortDesc();

        if ($request->ajax()) {
            return view('admin.residu.components.residu-table', compact('residues'));
        }

        return view('admin.residu.index', compact(
            'residues',
            'totalResidu',
            'totalDeposit',
            'cleanWaste',
            'months',
            'years',
            'month',
            'year'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight_kg' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            Residue::create($request->only(['name', 'weight_kg']));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data residu berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data residu'
            ], 500);
        }
    }

    public function show(Residue $residu)
    {
        return response()->json([
            'status' => 'success',
            'data' => $residu
        ]);
    }

    public function update(Request $request, Residue $residu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight_kg' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $residu->update($request->only(['name', 'weight_kg']));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data residu berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data residu'
            ], 500);
        }
    }

    public function destroy(Residue $residu)
    {
        try {
            DB::beginTransaction();

            $residu->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data residu berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data residu'
            ], 500);
        }
    }

    public function report(Request $request)
    {
        // Default bulan dan tahun sekarang jika tidak ada filter
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Ambil data residu berdasarkan filter
        $residues = Residue::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung total residu
        $totalResidu = $residues->sum('weight_kg');

        // Ambil data deposit (sampah masuk) berdasarkan filter
        $deposits = Deposit::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        // Hitung total deposit
        $totalDeposit = $deposits->sum('weight_kg');

        // Hitung sampah bersih
        $cleanWaste = $totalDeposit - $totalResidu;

        // Data untuk filter dropdown
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

        $years = range(date('Y'), 2020); // Dari tahun sekarang sampai 2020

        return view('admin.residu.index', compact(
            'residues',
            'totalResidu',
            'deposits',
            'totalDeposit',
            'cleanWaste',
            'month',
            'year',
            'months',
            'years'
        ));
    }

    public function printReport(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$year) {
            return redirect()->back()->with('error', 'Silakan pilih tahun terlebih dahulu');
        }

        $residuesQuery = Residue::whereYear('created_at', $year);
        $depositsQuery = Deposit::whereYear('created_at', $year);

        $monthName = 'Semua Bulan';

        if (!empty($month)) {
            $residuesQuery->whereMonth('created_at', $month);
            $depositsQuery->whereMonth('created_at', $month);
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
        }

        $residues = $residuesQuery->get();
        $deposits = $depositsQuery->get();

        $totalResidu = $residues->sum('weight_kg');
        $totalDeposit = $deposits->sum('weight_kg');
        $cleanWaste = $totalDeposit - $totalResidu;

        $pdf = pdf::loadView('admin.residu.print', compact(
            'residues',
            'totalResidu',
            'deposits',
            'totalDeposit',
            'cleanWaste',
            'month',
            'year',
            'monthName'
        ));

        return $pdf->stream('laporan-residu-' . strtolower($monthName) . '-' . $year . '.pdf');
    }

}