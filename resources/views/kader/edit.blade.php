@extends('layout')
@section('title', 'Edit Kader')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Data Kader</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kader.update', $kader) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kader <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kader" class="form-control" value="{{ old('nama_kader', $kader->nama_kader) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIK (16 digit) <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control" value="{{ old('nik', $kader->nik) }}" maxlength="16" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jabatan <span class="text-danger">*</span></label>
                            <select name="jabatan" class="form-select" required>
                                <option value="Ketua" {{ $kader->jabatan == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                <option value="Sekretaris" {{ $kader->jabatan == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                                <option value="Bendahara" {{ $kader->jabatan == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                                <option value="Anggota" {{ $kader->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="Aktif" {{ $kader->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ $kader->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $kader->no_hp) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Bergabung</label>
                            <input type="date" name="tgl_bergabung" class="form-control" value="{{ old('tgl_bergabung', $kader->tgl_bergabung) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $kader->alamat) }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i> Update</button>
                        <a href="{{ route('kader.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
