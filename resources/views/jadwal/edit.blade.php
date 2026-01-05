@extends('layout')
@section('title', 'Edit Jadwal')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-warning text-white"><h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Jadwal Posyandu</h5></div>
            <div class="card-body">
                <form action="{{ route('jadwal.update', $jadwal) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tempat <span class="text-danger">*</span></label>
                        <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $jadwal->tempat) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="Dijadwalkan" {{ $jadwal->status == 'Dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                            <option value="Selesai" {{ $jadwal->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ $jadwal->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i> Update</button>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
