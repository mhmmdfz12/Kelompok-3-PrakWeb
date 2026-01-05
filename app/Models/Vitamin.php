<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    protected $fillable = [
        'balita_id',
        'jenis_vitamin',
        'tanggal',
        'keterangan',
    ];

    // Relasi: Vitamin milik satu balita
    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}
