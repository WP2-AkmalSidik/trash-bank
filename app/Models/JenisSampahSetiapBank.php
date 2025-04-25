<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSampahSetiapBank extends Model
{
    use HasFactory;

    protected $fillable = ['bank_sampah_id', 'jenis_sampah_id', 'harga_per_kg'];

    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class);
    }

    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class);
    }
}
