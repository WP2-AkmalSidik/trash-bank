<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanPenarikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekening_nasabah_id',
        'jumlah_diajukan',
        'metode',
        'jenis_e_wallet',
        'nomor_e_wallet',
        'status'
    ];

    public function rekeningNasabah()
    {
        return $this->belongsTo(RekeningNasabah::class);
    }
}
