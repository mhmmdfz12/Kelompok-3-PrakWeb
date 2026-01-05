<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    protected $fillable = [
        'nama_kader',
        'nik',
        'no_hp',
        'alamat',
        'jabatan',
        'tgl_bergabung',
        'status',
    ];

    // Scope untuk filter kader aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
}
