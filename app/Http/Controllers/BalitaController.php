<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Ibu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BalitaController extends Controller
{
    // ===================== INDEX =====================
    public function index()
    {
        $balitas = Balita::latest()->paginate(5);
        return view('index', compact('balitas'));
    }

    // ===================== CREATE =====================
    public function create()
    {
        $ibus = Ibu::all();
        return view('create', compact('ibus'));
    }

    // ===================== STORE =====================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ibu_id' => 'nullable|exists:ibus,id',
            'nama_balita' => 'required',
            'nama_ibu' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'berat_badan_lahir' => 'required|numeric',
            'anak_ke' => 'nullable|string',
            'golongan_darah' => 'nullable|in:A,B,AB,O,-',
        ]);

        Balita::create($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data Balita Berhasil Disimpan.');
    }

    // ===================== SHOW (DETAIL) =====================
    public function show(Balita $balita)
    {
        // Muat semua relasi
        $balita->load([
            'penimbangans' => function ($query) {
                $query->orderBy('tgl_timbang', 'desc');
            },
            'imunisasis' => function ($query) {
                $query->orderBy('tanggal', 'desc');
            },
            'vitamins' => function ($query) {
                $query->orderBy('tanggal', 'desc');
            },
            'ibu'
        ]);

        return view('show', compact('balita'));
    }

    // ===================== EDIT =====================
    public function edit(Balita $balita)
    {
        $ibus = Ibu::all();
        return view('edit', compact('balita', 'ibus'));
    }

    // ===================== UPDATE =====================
    public function update(Request $request, Balita $balita)
    {
        $validated = $request->validate([
            'ibu_id' => 'nullable|exists:ibus,id',
            'nama_balita' => 'required',
            'nama_ibu' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'berat_badan_lahir' => 'required|numeric',
            'anak_ke' => 'nullable|string',
            'golongan_darah' => 'nullable|in:A,B,AB,O,-',
        ]);

        $balita->update($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data Balita Berhasil Diupdate!');
    }

    // ===================== CETAK PDF =====================
    public function cetakPdf()
    {
        $balitas = Balita::all();

        if ($balitas->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Maaf, belum ada data balita. Tidak dapat mencetak laporan.');
        }

        $pdf = Pdf::loadView('cetak_pdf', compact('balitas'));
        return $pdf->download('laporan-data-balita.pdf');
    }

    // ===================== DESTROY =====================
    public function destroy(Balita $balita)
    {
        $balita->delete();
        return redirect()->route('balita.index')
            ->with('success', 'Data Balita Berhasil Dihapus!');
    }
}
