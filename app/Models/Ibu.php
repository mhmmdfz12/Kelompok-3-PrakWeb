<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ibu extends Model
{
    protected $fillable = [
        'nama_ibu',
        'nik',
        'alamat',
        'no_hp',
        'tgl_lahir',
    ];

    // Relasi: Satu ibu punya banyak balita
    public function balitas()
    {
        return $this->hasMany(Balita::class);
    }
}
