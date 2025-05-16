<?php

namespace App\Models;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WasteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_kg',
    ];

    protected $casts = [
        'price_per_kg' => 'decimal:2',
    ];

    // Relasi: 1 WasteType memiliki banyak Deposit
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
