<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Illuminate\Http\Request;

class IbuController extends Controller
{
    public function index()
    {
        $ibus = Ibu::latest()->paginate(10);
        return view('ibu.index', compact('ibus'));
    }

    public function create()
    {
        return view('ibu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ibu' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:ibus,nik',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'tgl_lahir' => 'required|date',
        ]);

        Ibu::create($validated);

        return redirect()->route('ibu.index')->with('success', 'Data ibu berhasil ditambahkan');
    }

    public function show(Ibu $ibu)
    {
        $ibu->load('balitas');
        return view('ibu.show', compact('ibu'));
    }

    public function edit(Ibu $ibu)
    {
        return view('ibu.edit', compact('ibu'));
    }

    public function update(Request $request, Ibu $ibu)
    {
        $validated = $request->validate([
            'nama_ibu' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:ibus,nik,' . $ibu->id,
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'tgl_lahir' => 'required|date',
        ]);

        $ibu->update($validated);

        return redirect()->route('ibu.index')->with('success', 'Data ibu berhasil diupdate');
    }

    public function destroy(Ibu $ibu)
    {
        $ibu->delete();
        return redirect()->route('ibu.index')->with('success', 'Data ibu berhasil dihapus');
    }
}
