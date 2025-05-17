<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAccount extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'balance',
    ];

    // Relasi: 1 MemberAccount milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 MemberAccount memiliki banyak Deposit
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    // Relasi: 1 MemberAccount memiliki banyak Withdrawal
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function calculateBalance()
    {
        // Menghitung total deposit
        $totalDeposits = $this->deposits()->sum('total_price');
        
        // Menghitung total withdrawal yang disetujui
        $totalWithdrawals = $this->withdrawals()
            ->where('status', 'approved')
            ->sum('amount');
        
        // Menghitung saldo
        $balance = $totalDeposits - $totalWithdrawals;
        
        return $balance;
    }

    public function updateBalance()
    {
        $this->balance = $this->calculateBalance();
        $this->save();
    }

    public function hasSufficientBalance($amount, $minimumBalance = 0)
    {
        $this->updateBalance();
        return ($this->balance - $amount) >= $minimumBalance;
    }
}