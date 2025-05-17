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
        // Mengambil semua data withdrawal dengan relasi memberAccount dan user
        $withdrawals = Withdrawal::with(['memberAccount.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.pengajuan.index', compact('withdrawals'));
    }
    
    /**
     * Menyetujui pengajuan penarikan
     * 
     * @param int $id ID withdrawal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        // Cek apakah status masih pending
        if ($withdrawal->status !== 'pending') {
            return redirect()->route('pengajuan.index')
                ->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }
        
        // Update status withdrawal
        $withdrawal->status = 'approved';
        $withdrawal->save();
        
        // Kurangi saldo member
        $success = $withdrawal->approveWithdrawal();
        
        if ($success) {
            return redirect()->route('pengajuan.index')
                ->with('success', 'Pengajuan penarikan berhasil disetujui dan saldo nasabah telah dikurangi.');
        } else {
            // Kembalikan status ke pending jika gagal
            $withdrawal->status = 'pending';
            $withdrawal->save();
            
            return redirect()->route('pengajuan.index')
                ->with('error', 'Gagal menyetujui pengajuan. Saldo nasabah tidak mencukupi.');
        }
    }
    
    /**
     * Menolak pengajuan penarikan
     * 
     * @param Request $request
     * @param int $id ID withdrawal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        // Cek apakah status masih pending
        if ($withdrawal->status !== 'pending') {
            return redirect()->route('pengajuan.index')
                ->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }
        
        // Tolak pengajuan dengan alasan yang diberikan
        $rejection_reason = $request->input('rejection_reason');
        $withdrawal->rejectWithdrawal($rejection_reason);
        
        return redirect()->route('pengajuan.index')
            ->with('success', 'Pengajuan penarikan berhasil ditolak.');
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
        
        $query = Withdrawal::with(['memberAccount.user']);
        
        // Filter berdasarkan status jika ada
        if (!empty($status)) {
            $query->where('status', $status);
        }
        
        $withdrawals = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.pengajuan.index', compact('withdrawals'));
    }
}