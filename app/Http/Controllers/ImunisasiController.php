<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\Balita;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function index()
    {
        $imunisasis = Imunisasi::with('balita')->latest()->paginate(15);
        return view('imunisasi.index', compact('imunisasis'));
    }

    public function create()
    {
        $balitas = Balita::all();
        return view('imunisasi.create', compact('balitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'balita_id' => 'required|exists:balitas,id',
            'jenis_imunisasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tempat' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Imunisasi::create($validated);

        return redirect()->route('imunisasi.index')->with('success', 'Data imunisasi berhasil ditambahkan');
    }

    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();
        return redirect()->back()->with('success', 'Data imunisasi berhasil dihapus');
    }
}
