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
        'status',
    ];

    // Relasi: 1 Withdrawal milik 1 MemberAccount
    public function memberAccount()
    {
        return $this->belongsTo(MemberAccount::class);
    }

    // Method untuk mengurangi saldo jika penarikan disetujui
    public function approveWithdrawal()
    {
        if ($this->status === 'approved') {
            $memberAccount = $this->memberAccount;
            $memberAccount->balance -= $this->amount;
            $memberAccount->save();
        }
    }
}
