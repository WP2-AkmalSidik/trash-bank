<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSampah extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function bankSampah()
    {
        return $this->belongsToMany(BankSampah::class, 'bank_sampah_jenis_sampah')
            ->withPivot('harga_per_kg')
            ->withTimestamps();
    }

    public function transaksiTabungan()
    {
        return $this->hasMany(TransaksiTabungan::class);
    }
}
