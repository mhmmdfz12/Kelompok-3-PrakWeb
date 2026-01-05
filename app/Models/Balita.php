<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $fillable = [
        'ibu_id',
        'nama_balita',
        'nama_ibu',
        'jenis_kelamin',
        'tgl_lahir',
        'berat_badan_lahir',
        'anak_ke',
        'golongan_darah',
    ];

    // Relasi: Balita milik satu ibu
    public function ibu()
    {
        return $this->belongsTo(Ibu::class);
    }

    // Relasi: Satu balita punya banyak data penimbangan
    public function penimbangans()
    {
        return $this->hasMany(Penimbangan::class);
    }

    // Relasi: Satu balita punya banyak data imunisasi
    public function imunisasis()
    {
        return $this->hasMany(Imunisasi::class);
    }

    // Relasi: Satu balita punya banyak data vitamin
    public function vitamins()
    {
        return $this->hasMany(Vitamin::class);
    }

    // Method untuk menghitung umur dalam bulan
    public function getUmurBulanAttribute()
    {
        return \Carbon\Carbon::parse($this->tgl_lahir)->diffInMonths(now());
    }
}