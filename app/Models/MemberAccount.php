<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAccount extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
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
}
