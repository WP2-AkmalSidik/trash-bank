<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteType;
use Illuminate\Support\Facades\Validator;

class SampahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        
        $wasteTypes = WasteType::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);
        
        if ($request->ajax()) {
            return view('admin.sampah.components.waste-table', compact('wasteTypes'))->render();
        }
        
        return view('admin.sampah.management-sampah', compact('wasteTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:waste_types',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $wasteType = WasteType::create($request->only(['name', 'price_per_kg']));

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis sampah berhasil ditambahkan',
            'data' => $wasteType
        ]);
    }

    public function show($id)
    {
        $wasteType = WasteType::findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $wasteType
        ]);
    }

    public function update(Request $request, $id)
    {
        $wasteType = WasteType::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:waste_types,name,' . $id,
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $wasteType->update($request->only(['name', 'price_per_kg']));

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis sampah berhasil diperbarui',
            'data' => $wasteType
        ]);
    }

    public function destroy($id)
    {
        $wasteType = WasteType::findOrFail($id);
        $wasteType->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis sampah berhasil dihapus'
        ]);
    }
}