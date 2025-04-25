<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekeningNasabah extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bank_sampah_id', 'saldo', 'tanggal_dibuat'];

    protected $casts = [
        'saldo' => 'float',
        'tanggal_dibuat' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class);
    }

    public function transaksiTabungan()
    {
        return $this->hasMany(TransaksiTabungan::class);
    }

    public function pengajuanPenarikan()
    {
        return $this->hasMany(PengajuanPenarikan::class);
    }

    public function bisaDitarik()
    {
        return now()->diffInMonths($this->tanggal_dibuat) >= 6;
    }
}
