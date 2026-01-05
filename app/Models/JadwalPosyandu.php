<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'tempat',
        'keterangan',
        'status',
    ];

    // Scope untuk jadwal terdekat
    public function scopeTerdekat($query)
    {
        return $query->where('tanggal', '>=', now()->toDateString())
                     ->orderBy('tanggal', 'asc');
    }
}
