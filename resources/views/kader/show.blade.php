@extends('layout')
@section('title', 'Detail Kader')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i> Detail Kader</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><th width="30%">Nama</th><td>: {{ $kader->nama_kader }}</td></tr>
                    <tr><th>NIK</th><td>: {{ $kader->nik }}</td></tr>
                    <tr><th>Jabatan</th><td>: <span class="badge bg-primary">{{ $kader->jabatan }}</span></td></tr>
                    <tr><th>Status</th><td>: <span class="badge bg-{{ $kader->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $kader->status }}</span></td></tr>
                    <tr><th>No HP</th><td>: {{ $kader->no_hp ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td>: {{ $kader->alamat ?? '-' }}</td></tr>
                    <tr><th>Tanggal Bergabung</th><td>: {{ $kader->tgl_bergabung ? \Carbon\Carbon::parse($kader->tgl_bergabung)->format('d M Y') : '-' }}</td></tr>
                </table>
                <a href="{{ route('kader.index') }}" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
