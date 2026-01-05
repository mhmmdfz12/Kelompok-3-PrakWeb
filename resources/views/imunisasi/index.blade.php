@extends('layout')
@section('title', 'Data Imunisasi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold page-title mb-0">Data Imunisasi Balita</h2>
    <a href="{{ route('imunisasi.create') }}" class="btn btn-success shadow"><i class="fas fa-plus me-2"></i> Tambah Imunisasi</a>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ $message }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card card-glass">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr><th>No</th><th>Nama Balita</th><th>Jenis Imunisasi</th><th>Tanggal</th><th>Tempat</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($imunisasis as $imunisasi)
                    <tr>
                        <td>{{ $loop->iteration + ($imunisasis->currentPage()-1) * $imunisasis->perPage() }}</td>
                        <td class="fw-bold">{{ $imunisasi->balita->nama_balita }}</td>
                        <td><span class="badge bg-info">{{ $imunisasi->jenis_imunisasi }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($imunisasi->tanggal)->format('d M Y') }}</td>
                        <td>{{ $imunisasi->tempat ?? '-' }}</td>
                        <td>
                            <form action="{{ route('imunisasi.destroy', $imunisasi) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada data imunisasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $imunisasis->links() }}</div>
    </div>
</div>
@endsection
