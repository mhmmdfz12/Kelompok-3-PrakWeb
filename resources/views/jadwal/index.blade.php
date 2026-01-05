@extends('layout')
@section('title', 'Jadwal Posyandu')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold page-title mb-0">Jadwal Posyandu</h2>
    <a href="{{ route('jadwal.create') }}" class="btn btn-success shadow"><i class="fas fa-plus me-2"></i> Tambah Jadwal</a>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ $message }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card card-glass">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr><th>Tanggal</th><th>Waktu</th><th>Tempat</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($jadwals as $jadwal)
                    <tr>
                        <td class="fw-bold">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        <td>{{ $jadwal->tempat }}</td>
                        <td>
                            @if($jadwal->status == 'Dijadwalkan')
                                <span class="badge bg-primary">Dijadwalkan</span>
                            @elseif($jadwal->status == 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('jadwal.edit', $jadwal) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada jadwal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $jadwals->links() }}</div>
    </div>
</div>
@endsection
