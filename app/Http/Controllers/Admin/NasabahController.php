<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\MemberAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class NasabahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $nasabahQuery = User::where('role', 'member')
            ->with('memberAccount')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone_number', 'like', "%$search%")
                        ->orWhereHas('memberAccount', function ($q) use ($search) {
                            $q->where('account_number', 'like', "%$search%");
                        });
                });
            });

        $nasabahList = $nasabahQuery->paginate(10);

        return view('admin.nasabah.management-nasabah', compact('nasabahList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8',
            'account_number' => 'required|string|unique:member_accounts,account_number'
        ]);

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'role' => 'member'
            ]);

            // Create member account
            $user->memberAccount()->create([
                'account_number' => $request->account_number
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Nasabah berhasil ditambahkan',
                'redirect' => route('nasabah')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan nasabah: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generateAccountNumber()
    {
        $accountNumber = 'BS' . date('Ymd') . Str::random(4);

        return response()->json([
            'account_number' => $accountNumber
        ]);
    }
    public function edit($id)
    {
        $nasabah = User::with('memberAccount')->findOrFail($id);
        return response()->json($nasabah);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:15|unique:users,phone_number,' . $id,
            'password' => 'nullable|string|min:8'
        ]);

        try {
            $user = User::findOrFail($id);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ];

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data nasabah berhasil diperbarui',
                'redirect' => route('nasabah')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }
    // app/Http/Controllers/Admin/NasabahController.php
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Hapus member account terlebih dahulu jika ada
            if ($user->memberAccount) {
                $user->memberAccount->delete();
            }

            // Hapus user
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Nasabah berhasil dihapus',
                'redirect' => route('nasabah')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus nasabah: ' . $e->getMessage()
            ], 500);
        }
    }
}
