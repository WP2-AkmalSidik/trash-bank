<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankSampah extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'telepon'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jenisSampah()
    {
        return $this->belongsToMany(JenisSampah::class, 'bank_sampah_jenis_sampah')
            ->withPivot('harga_per_kg')
            ->withTimestamps();
    }

    public function rekeningNasabah()
    {
        return $this->hasMany(RekeningNasabah::class);
    }
}
