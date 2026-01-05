<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Ibu;
use App\Models\Kader;
use App\Models\JadwalPosyandu;
use App\Models\Penimbangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalBalita = Balita::count();
        $totalIbu = Ibu::count();
        $totalKaderAktif = Kader::where('status', 'Aktif')->count();
        
        // Jadwal terdekat (7 hari ke depan)
        $jadwalTerdekat = JadwalPosyandu::terdekat()
            ->where('status', 'Dijadwalkan')
            ->take(5)
            ->get();

        // Data status gizi untuk pie chart
        $statusGizi = Penimbangan::selectRaw('status_gizi, COUNT(*) as total')
            ->whereNotNull('status_gizi')
            ->groupBy('status_gizi')
            ->get();

        return view('dashboard', compact(
            'totalBalita',
            'totalIbu',
            'totalKaderAktif',
            'jadwalTerdekat',
            'statusGizi'
        ));
    }
}
