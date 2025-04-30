<?php

namespace App\Models;

use App\Models\WasteType;
use App\Models\MemberAccount;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'member_account_id',
        'waste_type_id',
        'weight_kg',
        'total_price',
        'deposited_at',
    ];

    // Relasi: 1 Deposit milik 1 MemberAccount
    public function memberAccount()
    {
        return $this->belongsTo(MemberAccount::class);
    }

    // Relasi: 1 Deposit milik 1 WasteType
    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }
}
