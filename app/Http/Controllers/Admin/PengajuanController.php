<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Withdrawal;
use App\Models\MemberAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Menampilkan halaman pengajuan penarikan
     */
    public function index()
    {
        $withdrawals = Withdrawal::with([
            'memberAccount' => function ($query) {
                $query->select('id', 'user_id', 'account_number');
            },
            'memberAccount.user' => function ($query) {
                $query->select('id', 'name');
            }
        ])
            ->select('withdrawals.*')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pengajuan.index', compact('withdrawals'));
    }

    /**
     * Menyetujui pengajuan penarikan
     */
    public function approve($id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            // Cek apakah status masih pending
            if ($withdrawal->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan ini sudah diproses sebelumnya.'
                ]);
            }

            // Validasi khusus untuk e-wallet
            if ($withdrawal->method === 'ewallet' && empty($withdrawal->proof_of_transfer)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan e-wallet harus menyertakan bukti transfer terlebih dahulu.'
                ]);
            }

            // Update status withdrawal
            $withdrawal->status = 'approved';
            $withdrawal->save();

            // Kurangi saldo member
            $success = $withdrawal->approveWithdrawal();

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengajuan penarikan berhasil disetujui dan saldo nasabah telah dikurangi.'
                ]);
            } else {
                // Kembalikan status ke pending jika gagal
                $withdrawal->status = 'pending';
                $withdrawal->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyetujui pengajuan. Saldo nasabah tidak mencukupi.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Menolak pengajuan penarikan
     */
    public function reject(Request $request, $id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            // Cek apakah status masih pending
            if ($withdrawal->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan ini sudah diproses sebelumnya.'
                ]);
            }

            // Tolak pengajuan dengan alasan yang diberikan
            $rejection_reason = $request->input('rejection_reason');
            $withdrawal->rejectWithdrawal($rejection_reason);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan penarikan berhasil ditolak.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Mengubah tampilan berdasarkan filter status
     */
    public function filter(Request $request)
    {
        $status = $request->input('status');

        $query = Withdrawal::with([
            'memberAccount' => function ($query) {
                $query->select('id', 'user_id', 'account_number');
            },
            'memberAccount.user' => function ($query) {
                $query->select('id', 'name');
            }
        ])
            ->select('withdrawals.*');

        // Filter berdasarkan status jika ada
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $withdrawals = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pengajuan.index', compact('withdrawals'));
    }

    // Di App\Http\Controllers\Admin\PengajuanController

    /**
     * Upload bukti transfer untuk penarikan e-wallet
     */
    /**
     * Handle proof of transfer upload
     */
    public function uploadProof(Request $request, $id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            // Validasi
            $validator = \Validator::make($request->all(), [
                'proof_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            // Simpan file
            if ($request->hasFile('proof_file')) {
                // Delete old proof if exists
                if ($withdrawal->proof_of_transfer && Storage::disk('public')->exists($withdrawal->proof_of_transfer)) {
                    Storage::disk('public')->delete($withdrawal->proof_of_transfer);
                }

                $path = $request->file('proof_file')->store('proofs', 'public');
                $withdrawal->proof_of_transfer = $path;
                $withdrawal->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Bukti transfer berhasil diunggah'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada file yang diunggah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
    public function showProof($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if (!$withdrawal->proof_of_transfer) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada bukti transfer untuk pengajuan ini.'
            ]);
        }

        $proofUrl = Storage::url($withdrawal->proof_of_transfer);

        return response()->json([
            'success' => true,
            'proof_url' => $proofUrl
        ]);
    }
}