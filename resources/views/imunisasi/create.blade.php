@extends('layout')
@section('title', 'Tambah Imunisasi')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-success text-white"><h5 class="mb-0"><i class="fas fa-syringe me-2"></i> Tambah Data Imunisasi</h5></div>
            <div class="card-body">
                <form action="{{ route('imunisasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Balita <span class="text-danger">*</span></label>
                        <select name="balita_id" class="form-select" required>
                            <option value="">- Pilih Balita -</option>
                            @foreach($balitas as $balita)
                                <option value="{{ $balita->id }}">{{ $balita->nama_balita }} (Ibu: {{ $balita->nama_ibu }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Imunisasi <span class="text-danger">*</span></label>
                            <select name="jenis_imunisasi" class="form-select" required>
                                <option value="">- Pilih -</option>
                                <option value="BCG">BCG</option>
                                <option value="Polio 1">Polio 1</option>
                                <option value="Polio 2">Polio 2</option>
                                <option value="Polio 3">Polio 3</option>
                                <option value="Polio 4">Polio 4</option>
                                <option value="DPT 1">DPT 1</option>
                                <option value="DPT 2">DPT 2</option>
                                <option value="DPT 3">DPT 3</option>
                                <option value="Campak">Campak</option>
                                <option value="Hepatitis B">Hepatitis B</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tempat</label>
                        <input type="text" name="tempat" class="form-control" placeholder="Contoh: Posyandu">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> Simpan</button>
                        <a href="{{ route('imunisasi.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
