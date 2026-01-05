@extends('layout')

@section('title', 'Data Ibu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold page-title mb-0">Data Ibu</h2>
    <a href="{{ route('ibu.create') }}" class="btn btn-success shadow">
        <i class="fas fa-plus me-2"></i> Tambah Data Ibu
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
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ibu</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ibus as $ibu)
                    <tr>
                        <td>{{ $loop->iteration + ($ibus->currentPage()-1) * $ibus->perPage() }}</td>
                        <td class="fw-bold">{{ $ibu->nama_ibu }}</td>
                        <td>{{ $ibu->nik }}</td>
                        <td>{{ Str::limit($ibu->alamat, 30) }}</td>
                        <td>{{ $ibu->no_hp ?? '-' }}</td>
                        <td>
                            <a href="{{ route('ibu.show', $ibu) }}" class="btn btn-sm btn-info text-white">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('ibu.edit', $ibu) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('ibu.destroy', $ibu) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data ibu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $ibus->links() }}
        </div>
    </div>
</div>
@endsection
