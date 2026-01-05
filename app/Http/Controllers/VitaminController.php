<?php

namespace App\Http\Controllers;

use App\Models\Vitamin;
use App\Models\Balita;
use Illuminate\Http\Request;

class VitaminController extends Controller
{
    public function index()
    {
        $vitamins = Vitamin::with('balita')->latest()->paginate(15);
        return view('vitamin.index', compact('vitamins'));
    }

    public function create()
    {
        $balitas = Balita::all();
        return view('vitamin.create', compact('balitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'balita_id' => 'required|exists:balitas,id',
            'jenis_vitamin' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Vitamin::create($validated);

        return redirect()->route('vitamin.index')->with('success', 'Data vitamin berhasil ditambahkan');
    }

    public function destroy(Vitamin $vitamin)
    {
        $vitamin->delete();
        return redirect()->back()->with('success', 'Data vitamin berhasil dihapus');
    }
}
