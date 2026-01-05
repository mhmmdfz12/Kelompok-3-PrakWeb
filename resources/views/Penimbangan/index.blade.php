@extends('layout') {{-- Menggunakan file layout.blade.php sebagai induk --}}

@section('content')
<style>
    /* Optimasi untuk tabel dengan banyak data */
    .table-wrapper {
        max-height: calc(100vh - 280px);
        overflow-y: auto;
    }
    
    .table-wrapper::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    .table thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #fff;
    }
</style>
<div class="container-fluid p-3">
    
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark shadow-sm">Riwayat Penimbangan</h2>
            <p class="text-muted mb-0">Daftar lengkap riwayat timbangan balita posyandu.</p>
        </div>

        <div class="d-flex gap-3 align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
            </a>

            <span class="badge bg-primary text-white fs-6 shadow-sm px-3 py-2 rounded-pill">
                <i class="fas fa-balance-scale me-2"></i> Total: {{ $penimbangan->count() }} Data
            </span>
        </div>
    </div>

    <div class="card card-glass border-0 shadow">
        <div class="card-body p-4">
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr class="text-uppercase small">
                                <th class="py-3 ps-4">Tanggal Timbang</th>
                                <th class="py-3">Nama Balita</th>
                                <th class="py-3">Berat (kg)</th>
                                <th class="py-3">Tinggi (cm)</th>
                                <th class="py-3">Keterangan</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penimbangan as $data)
                            <tr>
                                <td class="ps-4">{{ \Carbon\Carbon::parse($data->tgl_timbang)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $data->balita->nama_balita }}</div>
                                    <small class="text-muted">ID Balita: {{ $data->balita_id }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark rounded-pill px-3">{{ $data->berat_badan }} kg</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border rounded-pill px-3">{{ $data->tinggi_badan }} cm</span>
                                </td>
                                <td><small class="text-muted">{{ $data->keterangan ?? '-' }}</small></td>
                                <td class="text-center">
                                    <form action="{{ route('penimbangan.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Hapus riwayat ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                    <p class="mb-0">Belum ada riwayat penimbangan yang tercatat.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($penimbangan->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <div class="text-muted small">
                    Menampilkan {{ $penimbangan->firstItem() }} - {{ $penimbangan->lastItem() }} dari {{ $penimbangan->total() }} data
                </div>
                <div>
                    {{ $penimbangan->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection