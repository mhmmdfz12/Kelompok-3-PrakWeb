<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPosyandu::latest('tanggal')->paginate(10);
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tempat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:Dijadwalkan,Selesai,Dibatalkan',
        ]);

        JadwalPosyandu::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal posyandu berhasil ditambahkan');
    }

    public function show(JadwalPosyandu $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(JadwalPosyandu $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalPosyandu $jadwal)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tempat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:Dijadwalkan,Selesai,Dibatalkan',
        ]);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal posyandu berhasil diupdate');
    }

    public function destroy(JadwalPosyandu $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal posyandu berhasil dihapus');
    }
}
