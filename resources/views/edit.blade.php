@extends('layout')
@section('title', 'Edit Balita')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-glass">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Data Balita</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('balita.update', $balita) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Ibu (Opsional)</label>
                        <select name="ibu_id" class="form-select">
                            <option value="">- Pilih Ibu dari Database atau Isi Manual di Bawah -</option>
                            @foreach($ibus as $ibu)
                                <option value="{{ $ibu->id }}" {{ $balita->ibu_id == $ibu->id ? 'selected' : '' }}>{{ $ibu->nama_ibu }} (NIK: {{ $ibu->nik }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Balita <span class="text-danger">*</span></label>
                            <input type="text" name="nama_balita" class="form-control" value="{{ $balita->nama_balita }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Ibu <span class="text-danger">*</span></label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ $balita->nama_ibu }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="L" {{ $balita->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $balita->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $balita->tgl_lahir }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Berat Lahir (Kg) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="berat_badan_lahir" class="form-control" value="{{ $balita->berat_badan_lahir }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Anak Ke-</label>
                            <input type="text" name="anak_ke" class="form-control" value="{{ $balita->anak_ke }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select">
                                <option value="-" {{ $balita->golongan_darah == '-' ? 'selected' : '' }}>Belum Diketahui</option>
                                <option value="A" {{ $balita->golongan_darah == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $balita->golongan_darah == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ $balita->golongan_darah == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ $balita->golongan_darah == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i> Update</button>
                        <a href="{{ route('balita.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection