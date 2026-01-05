@extends('layout')
@section('title', 'Data Vitamin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold page-title mb-0">Data Vitamin Balita</h2>
    <a href="{{ route('vitamin.create') }}" class="btn btn-success shadow"><i class="fas fa-plus me-2"></i> Tambah Vitamin</a>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ $message }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card card-glass">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr><th>No</th><th>Nama Balita</th><th>Jenis Vitamin</th><th>Tanggal</th><th>Keterangan</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($vitamins as $vitamin)
                    <tr>
                        <td>{{ $loop->iteration + ($vitamins->currentPage()-1) * $vitamins->perPage() }}</td>
                        <td class="fw-bold">{{ $vitamin->balita->nama_balita }}</td>
                        <td><span class="badge bg-warning text-dark">{{ $vitamin->jenis_vitamin }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($vitamin->tanggal)->format('d M Y') }}</td>
                        <td>{{ $vitamin->keterangan ?? '-' }}</td>
                        <td>
                            <form action="{{ route('vitamin.destroy', $vitamin) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada data vitamin</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $vitamins->links() }}</div>
    </div>
</div>
@endsection
