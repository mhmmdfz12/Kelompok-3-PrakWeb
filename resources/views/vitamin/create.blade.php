@extends('layout')
@section('title', 'Tambah Vitamin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-success text-white"><h5 class="mb-0"><i class="fas fa-pills me-2"></i> Tambah Data Vitamin</h5></div>
            <div class="card-body">
                <form action="{{ route('vitamin.store') }}" method="POST">
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
                            <label class="form-label fw-bold">Jenis Vitamin <span class="text-danger">*</span></label>
                            <select name="jenis_vitamin" class="form-select" required>
                                <option value="">- Pilih -</option>
                                <option value="Vitamin A">Vitamin A</option>
                                <option value="Vitamin C">Vitamin C</option>
                                <option value="Vitamin D">Vitamin D</option>
                                <option value="Vitamin E">Vitamin E</option>
                                <option value="Multivitamin">Multivitamin</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> Simpan</button>
                        <a href="{{ route('vitamin.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
