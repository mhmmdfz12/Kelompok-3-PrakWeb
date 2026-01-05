<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    protected $fillable = [
        'balita_id',
        'jenis_imunisasi',
        'tanggal',
        'tempat',
        'keterangan',
    ];

    // Relasi: Imunisasi milik satu balita
    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}
