<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MemberAccount;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    // Menampilkan halaman pengajuan dengan data saldo dan riwayat
    public function index()
    {
        $user = Auth::user();
        $memberAccount = MemberAccount::where('user_id', $user->id)->first();
        
        if (!$memberAccount) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda belum memiliki rekening. Hubungi admin untuk membuat rekening.');
        }
        
        // Update saldo terlebih dahulu
        $memberAccount->updateBalance();
        
        // Mengambil data withdrawal/penarikan
        $withdrawals = Withdrawal::where('member_account_id', $memberAccount->id)
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(10); // Changed to paginate for better performance
        
        // Minimal saldo yang harus tersisa setelah penarikan
        $minimumBalance = 10000; // Changed to 100,000 to match your create view
        
        return view('user.pengajuan', [
            'memberAccount' => $memberAccount,
            'withdrawals' => $withdrawals,
            'minimumBalance' => $minimumBalance,
            'withdrawableAmount' => max(0, $memberAccount->balance - $minimumBalance)
        ]);
    }
    
    // Menampilkan form pengajuan penarikan dana
    public function create()
    {
        $user = Auth::user();
        $memberAccount = MemberAccount::where('user_id', $user->id)->first();
        
        if (!$memberAccount) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda belum memiliki rekening. Hubungi admin untuk membuat rekening.');
        }
        
        // Update saldo terlebih dahulu
        $memberAccount->updateBalance();
        
        // Minimal saldo yang harus tersisa setelah penarikan
        $minimumBalance = 10000;
        $withdrawableAmount = max(0, $memberAccount->balance - $minimumBalance);
        
        if ($withdrawableAmount <= 0) {
            return redirect()->route('user.pengajuan')
                ->with('error', 'Saldo Anda tidak mencukupi untuk melakukan penarikan.');
        }
        
        return view('user.pengajuan.create', [
            'memberAccount' => $memberAccount,
            'withdrawableAmount' => $withdrawableAmount
        ]);
    }
    
    // Menyimpan data pengajuan penarikan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10000',
            'method' => 'required|in:cash,ewallet',
            'ewallet_type' => 'required_if:method,ewallet',
            'ewallet_number' => 'required_if:method,ewallet'
        ]);
        
        $user = Auth::user();
        $memberAccount = MemberAccount::where('user_id', $user->id)->first();
        
        if (!$memberAccount) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda belum memiliki rekening. Hubungi admin untuk membuat rekening.');
        }
        
        // Update saldo terlebih dahulu
        $memberAccount->updateBalance();
        
        // Cek ketersediaan saldo dengan minimum balance
        $minimumBalance = 10000;
        if (!$memberAccount->hasSufficientBalance($validated['amount'], $minimumBalance)) {
            return redirect()->route('user.pengajuan')
                ->with('error', 'Saldo tidak mencukupi untuk melakukan penarikan sebesar ini.')
                ->withInput();
        }
        
        // Simpan data withdrawal
        $withdrawal = new Withdrawal();
        $withdrawal->member_account_id = $memberAccount->id;
        $withdrawal->amount = $validated['amount'];
        $withdrawal->method = $validated['method'];
        
        if ($validated['method'] === 'ewallet') {
            $withdrawal->ewallet_type = $validated['ewallet_type'];
            $withdrawal->ewallet_number = $validated['ewallet_number'];
        }
        
        $withdrawal->status = 'pending';
        $withdrawal->save();
        
        return redirect()->route('user.pengajuan')
            ->with('success', 'Pengajuan penarikan berhasil dibuat. Silakan tunggu persetujuan dari admin.');
    }
    
    // Menampilkan detail pengajuan penarikan
    public function show($id)
    {
        $user = Auth::user();
        $memberAccount = MemberAccount::where('user_id', $user->id)->first();
        
        if (!$memberAccount) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda belum memiliki rekening. Hubungi admin untuk membuat rekening.');
        }
        
        $withdrawal = Withdrawal::where('id', $id)
                                ->where('member_account_id', $memberAccount->id)
                                ->firstOrFail();
        
        return view('user.pengajuan.show', [
            'withdrawal' => $withdrawal,
            'memberAccount' => $memberAccount
        ]);
    }
}