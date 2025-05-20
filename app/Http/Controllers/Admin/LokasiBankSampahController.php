<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiBankSampahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $locations = Location::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(5);

        return view('admin.lokasi.index', compact('locations', 'search'));
    }

    public function show($id)
    {
        $location = Location::findOrFail($id);
        return response()->json($location);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'url_maps' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $location = Location::create($request->only(['name', 'address', 'url_maps']));

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi berhasil ditambahkan',
            'data' => $location
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'url_maps' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $location = Location::findOrFail($id);
        $location->update($request->only(['name', 'address', 'url_maps']));

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi berhasil diperbarui',
            'data' => $location
        ]);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi berhasil dihapus'
        ]);
    }
}