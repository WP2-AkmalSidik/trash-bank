<?php

namespace App\Models;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Model;

class WasteType extends Model
{
    protected $fillable = [
        'name',
        'price_per_kg',
    ];

    // Relasi: 1 WasteType memiliki banyak Deposit
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
