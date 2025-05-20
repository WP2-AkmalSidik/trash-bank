<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $news = News::when($search, function($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('content', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(5);

        return view('admin.pengumuman.index', compact('news', 'search'));
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $news = News::create($request->only(['title', 'content']));

        return response()->json([
            'status' => 'success',
            'message' => 'Pengumuman berhasil ditambahkan',
            'data' => $news
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $news = News::findOrFail($id);
        $news->update($request->only(['title', 'content']));

        return response()->json([
            'status' => 'success',
            'message' => 'Pengumuman berhasil diperbarui',
            'data' => $news
        ]);
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pengumuman berhasil dihapus'
        ]);
    }
}
