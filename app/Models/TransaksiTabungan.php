<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiTabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekening_nasabah_id',
        'jenis_sampah_id',
        'tipe',
        'berat_kg',
        'jumlah_rupiah',
    ];

    public function rekeningNasabah()
    {
        return $this->belongsTo(RekeningNasabah::class);
    }

    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class);
    }
}
