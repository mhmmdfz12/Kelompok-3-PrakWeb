<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    public function index(Request $request)
    {
        $query = Kader::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jabatan
        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }

        $kaders = $query->latest()->paginate(10);
        return view('kader.index', compact('kaders'));
    }

    public function create()
    {
        return view('kader.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kader' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:kaders,nik',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'jabatan' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota',
            'tgl_bergabung' => 'nullable|date',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        Kader::create($validated);

        return redirect()->route('kader.index')->with('success', 'Data kader berhasil ditambahkan');
    }

    public function show(Kader $kader)
    {
        return view('kader.show', compact('kader'));
    }

    public function edit(Kader $kader)
    {
        return view('kader.edit', compact('kader'));
    }

    public function update(Request $request, Kader $kader)
    {
        $validated = $request->validate([
            'nama_kader' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:kaders,nik,' . $kader->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'jabatan' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota',
            'tgl_bergabung' => 'nullable|date',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $kader->update($validated);

        return redirect()->route('kader.index')->with('success', 'Data kader berhasil diupdate');
    }

    public function destroy(Kader $kader)
    {
        $kader->delete();
        return redirect()->route('kader.index')->with('success', 'Data kader berhasil dihapus');
    }
}
