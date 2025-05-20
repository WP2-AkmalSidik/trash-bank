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
        'proof_of_transfer',
        'rejection_reason',
        'status',
    ];

    // Aturan validasi
    public static $rules = [
        'amount' => 'required|numeric|min:10000',
        'method' => 'required|in:cash,ewallet',
        'ewallet_type' => 'required_if:method,ewallet',
        'ewallet_number' => 'required_if:method,ewallet',
        'proof_of_transfer' => 'required_if:method,ewallet|image|mimes:jpeg,png,jpg|max:2048',
    ];

    public function memberAccount()
    {
        return $this->belongsTo(MemberAccount::class);
    }

    public function approveWithdrawal()
    {
        if ($this->status === 'approved') {
            $memberAccount = $this->memberAccount;
            
            if ($memberAccount->hasSufficientBalance($this->amount, 0)) {
                $memberAccount->updateBalance();
                return true;
            }
            return false;
        }
        return false;
    }
    
    public function rejectWithdrawal($reason = null)
    {
        // Update status menjadi rejected
        $this->status = 'rejected';
        $this->rejection_reason = $reason;
        return $this->save();
    }

    public function requiresProofOfTransfer()
    {
        return $this->method === 'ewallet';
    }
}