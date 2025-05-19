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
        'price_per_kg',
        'total_price',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'total_price' => 'decimal:2',
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