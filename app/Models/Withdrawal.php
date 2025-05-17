<?php

namespace App\Models;

use App\Models\MemberAccount;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'member_account_id',
        'amount',
        'method',
        'ewallet_type',
        'ewallet_number',
        'rejection_reason',
        'status',
    ];

    // Relasi: 1 Withdrawal milik 1 MemberAccount
    public function memberAccount()
    {
        return $this->belongsTo(MemberAccount::class);
    }

    /**
     * Method untuk mengurangi saldo jika penarikan disetujui
     *
     * @return bool
     */
    public function approveWithdrawal()
    {
        // Pastikan status adalah approved
        if ($this->status === 'approved') {
            $memberAccount = $this->memberAccount;
            
            // Periksa apakah saldo mencukupi
            if ($memberAccount->hasSufficientBalance($this->amount, 0)) {
                // Update saldo
                $memberAccount->updateBalance();
                return true;
            }
            return false;
        }
        return false;
    }
    
    /**
     * Method untuk menolak penarikan
     *
     * @param string|null $reason Alasan penolakan
     * @return bool
     */
    public function rejectWithdrawal($reason = null)
    {
        // Update status menjadi rejected
        $this->status = 'rejected';
        $this->rejection_reason = $reason;
        return $this->save();
    }
}