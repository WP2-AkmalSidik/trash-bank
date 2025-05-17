<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Withdrawal;
use App\Models\MemberAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    /**
     * Menampilkan halaman pengajuan penarikan
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Optimized query with select only needed columns
        $withdrawals = Withdrawal::with([
            'memberAccount' => function($query) {
                $query->select('id', 'user_id', 'account_number');
            },
            'memberAccount.user' => function($query) {
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
     * 
     * @param int $id ID withdrawal
     * @return \Illuminate\Http\JsonResponse
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
     * 
     * @param Request $request
     * @param int $id ID withdrawal
     * @return \Illuminate\Http\JsonResponse
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
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $status = $request->input('status');
        
        $query = Withdrawal::with([
            'memberAccount' => function($query) {
                $query->select('id', 'user_id', 'account_number');
            },
            'memberAccount.user' => function($query) {
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
}