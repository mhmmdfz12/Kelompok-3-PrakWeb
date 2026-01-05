<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Penimbangan;
use Illuminate\Http\Request;

class PenimbanganController extends Controller
{
    /**
     * 1. TAMPILKAN SEMUA RIWAYAT (Untuk Menu Sidebar)
     */
    public function index()
    {
        // Mengambil data penimbangan terbaru beserta data balitanya (Eager Loading)
        // Tampilkan 15 data per halaman
        $penimbangan = Penimbangan::with('balita')->latest()->paginate(15);
        
        // Mengarah ke resources/views/penimbangan/index.blade.php
        return view('penimbangan.index', compact('penimbangan'));
    }

    /**
     * 2. SIMPAN DATA TIMBANGAN (Dari Form Detail Balita)
     */
    public function store(Request $request, Balita $balita)
    {
        $request->validate([
            'tgl_timbang' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'keterangan'  => 'nullable|string'
        ]);

        // Tentukan status gizi berdasarkan berat badan
        $status_gizi = $this->hitungStatusGizi($balita, $request->berat_badan);

        // Simpan via relasi yang ada di model Balita
        $balita->penimbangans()->create([
            'tgl_timbang' => $request->tgl_timbang,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'status_gizi' => $status_gizi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data penimbangan berhasil ditambahkan');
    }

    /**
     * Helper: Hitung status gizi sederhana
     * Berdasarkan WHO, menggunakan pendekatan sederhana
     */
    private function hitungStatusGizi($balita, $beratBadan)
    {
        $umurBulan = $balita->umur_bulan;
        
        // Standar berat rata-rata per umur (simplified)
        // 0-6 bulan: 3-8kg, 6-12 bulan: 8-10kg, 1-2 tahun: 10-12kg, 2-5 tahun: 12-18kg
        if ($umurBulan <= 6) {
            $beratIdeal = 3 + ($umurBulan * 0.8);
        } elseif ($umurBulan <= 12) {
            $beratIdeal = 8 + (($umurBulan - 6) * 0.3);
        } elseif ($umurBulan <= 24) {
            $beratIdeal = 10 + (($umurBulan - 12) * 0.15);
        } else {
            $beratIdeal = 12 + (($umurBulan - 24) * 0.1);
        }

        $persentase = ($beratBadan / $beratIdeal) * 100;

        if ($persentase < 70) {
            return 'Gizi Buruk';
        } elseif ($persentase < 80) {
            return 'Gizi Kurang';
        } elseif ($persentase <= 120) {
            return 'Gizi Baik';
        } elseif ($persentase <= 140) {
            return 'Gizi Lebih';
        } else {
            return 'Obesitas';
        }
    }

    /**
     * 3. HAPUS DATA TIMBANGAN
     */
    public function destroy(Penimbangan $penimbangan)
    {
        $penimbangan->delete();
        return redirect()->back()->with('success', 'Data penimbangan dihapus');
    }
}