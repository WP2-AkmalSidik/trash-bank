<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Residue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidueController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $residues = Residue::when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        if ($request->ajax()) {
            return view('admin.residu.components.residu-table', compact('residues'))->render();
        }
        
        return view('admin.residu.index', compact('residues'));
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
}