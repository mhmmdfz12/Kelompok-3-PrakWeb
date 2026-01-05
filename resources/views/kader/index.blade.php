@extends('layout')

@section('title', 'Data Kader')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold page-title mb-0">Data Kader Posyandu</h2>
    <a href="{{ route('kader.create') }}" class="btn btn-success shadow">
        <i class="fas fa-plus me-2"></i> Tambah Kader
    </a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card card-glass">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kader</th>
                        <th>Jabatan</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kaders as $kader)
                    <tr>
                        <td>{{ $loop->iteration + ($kaders->currentPage()-1) * $kaders->perPage() }}</td>
                        <td class="fw-bold">{{ $kader->nama_kader }}</td>
                        <td><span class="badge bg-primary">{{ $kader->jabatan }}</span></td>
                        <td>{{ $kader->no_hp ?? '-' }}</td>
                        <td>
                            @if($kader->status == 'Aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('kader.show', $kader) }}" class="btn btn-sm btn-info text-white">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('kader.edit', $kader) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kader.destroy', $kader) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data kader</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $kaders->links() }}
        </div>
    </div>
</div>
@endsection
