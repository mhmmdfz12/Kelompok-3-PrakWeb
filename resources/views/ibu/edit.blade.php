@extends('layout')

@section('title', 'Edit Data Ibu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Data Ibu</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ibu.update', $ibu) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Ibu <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu', $ibu->nama_ibu) }}" required>
                        @error('nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIK (16 digit) <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $ibu->nik) }}" maxlength="16" required>
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $ibu->alamat) }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No HP</label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $ibu->no_hp) }}">
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', $ibu->tgl_lahir) }}" required>
                            @error('tgl_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i> Update
                        </button>
                        <a href="{{ route('ibu.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
