@extends('layout')
@section('title', 'Tambah Balita')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-glass">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i> Tambah Data Balita</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('balita.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Ibu (Opsional)</label>
                        <select name="ibu_id" class="form-select">
                            <option value="">- Pilih Ibu dari Database atau Isi Manual di Bawah -</option>
                            @foreach($ibus as $ibu)
                                <option value="{{ $ibu->id }}">{{ $ibu->nama_ibu }} (NIK: {{ $ibu->nik }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Jika ibu sudah terdaftar, pilih dari dropdown. Jika belum, isi nama ibu di bawah.</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Balita <span class="text-danger">*</span></label>
                            <input type="text" name="nama_balita" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Ibu <span class="text-danger">*</span></label>
                            <input type="text" name="nama_ibu" class="form-control" required>
                            <small class="text-muted">Wajib diisi meskipun sudah pilih dari dropdown</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">- Pilih -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Berat Lahir (Kg) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="berat_badan_lahir" class="form-control" placeholder="3.5" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Anak Ke-</label>
                            <input type="text" name="anak_ke" class="form-control" placeholder="Contoh: 1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select">
                                <option value="-">Belum Diketahui</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> Simpan</button>
                        <a href="{{ route('balita.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection