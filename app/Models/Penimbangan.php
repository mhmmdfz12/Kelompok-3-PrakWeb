<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'balita_id', 
        'tgl_timbang', 
        'berat_badan', 
        'tinggi_badan', 
        'lingkar_kepala',
        'status_gizi',
        'keterangan'
    ];

    // Relasi: Penimbangan milik satu balita
    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}