@extends('layout')

@section('content')

<style>
    /* 1. BACKGROUND FOTO */
    body {
        background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
        background-size: cover;
        box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.1); 
        min-height: 100vh;
    }

    /* 2. Kartu Tabel */
    .card-modern {
        background: rgba(255, 255, 255, 0.92);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        overflow: hidden;
        backdrop-filter: blur(8px);
    }

    /* Style Header Tabel */
    .table thead th {
        background-color: rgba(241, 245, 249, 0.8);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #475569;
        padding: 1.2rem 1rem;
        border-bottom: 2px solid #e2e8f0;
    }

    /* Style Avatar */
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 16px;
        margin-right: 15px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        border: 2px solid white;
    }
    
    /* Warna Gender */
    .text-gender-l { color: #1e40af; background-color: #dbeafe; border: 1px solid #bfdbfe; }
    .text-gender-p { color: #9d174d; background-color: #fce7f3; border: 1px solid #fbcfe8; }
    
    /* Tombol Ikon */
    .btn-icon {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
        border: 1px solid rgba(0,0,0,0.1);
        background-color: #fff;
        transition: all 0.2s ease;
    }
    .btn-icon:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    
    .btn-soft-info { background: #e0f2fe; color: #0369a1; }
    .btn-soft-warning { background: #fef3c7; color: #b45309; }
    .btn-soft-danger { background: #fee2e2; color: #b91c1c; }
    
    /* Judul Halaman */
    .page-title {
        color: #fff;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    .page-subtitle {
        color: rgba(255,255,255,0.9);
        text-shadow: 0 1px 5px rgba(0,0,0,0.5);
    }
</style>

<div class="container-fluid px-4 mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold page-title mb-0">Manajemen Data Balita</h2>
            <p class="fw-semibold small page-subtitle">Sistem Informasi Posyandu Terpadu</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-light shadow fw-bold text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Dashboard
            </a>
            <a href="{{ route('balita.create') }}" class="btn btn-success shadow fw-bold px-4">
                <i class="fas fa-plus me-2"></i> Tambah Data
            </a>
        </div>
    </div>

    {{-- ALERT SUKSES --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow mb-4 rounded-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fs-4 me-3"></i>
                <div class="fw-bold">{{ $message }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT ERROR (BARU: Untuk menampilkan pesan 'Data Kosong' saat cetak PDF) --}}
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow mb-4 rounded-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle fs-4 me-3"></i>
                <div class="fw-bold">{{ $message }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card card-modern">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead>
                        <tr>
                            <th class="ps-4">Nama Balita</th>
                            <th class="text-center">Nama Ibu</th> 
                            <th class="text-center">Gender</th>
                            <th class="text-center">Tanggal Lahir</th> 
                            <th class="text-center">Berat Lahir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($balitas as $balita)
                        <tr>
                            <td class="p-3 ps-4">
                                <div class="d-flex align-items-center">
                                    @php
                                        $initial = substr($balita->nama_balita, 0, 1);
                                        $bgClass = ($balita->jenis_kelamin == 'L') ? 'bg-primary' : 'bg-danger';
                                    @endphp
                                    <div class="avatar-circle {{ $bgClass }}">
                                        {{ strtoupper($initial) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark fs-6">{{ $balita->nama_balita }}</div>
                                        <div class="small text-muted">ID: #{{ $balita->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center fw-semibold text-secondary">{{ $balita->nama_ibu }}</td>

                            <td class="text-center">
                                @if($balita->jenis_kelamin == 'L')
                                    <span class="badge text-gender-l rounded-pill px-3 py-2">
                                        <i class="fas fa-mars me-1"></i> Laki-laki
                                    </span>
                                @else
                                    <span class="badge text-gender-p rounded-pill px-3 py-2">
                                        <i class="fas fa-venus me-1"></i> Perempuan
                                    </span>
                                @endif
                            </td>

                            <td class="text-center text-secondary">
                                <div class="d-inline-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2 opacity-50"></i> 
                                    {{ \Carbon\Carbon::parse($balita->tgl_lahir)->format('d M Y') }}
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="fw-bold text-dark fs-6">{{ $balita->berat_badan_lahir }}</span> <span class="text-muted small">Kg</span>
                            </td>

                            <td class="text-center">
                            <div class="bg-white bg-opacity-75 rounded-3 px-3 py-2 shadow-sm d-inline-flex gap-2">

                                <a href="{{ route('balita.show', $balita->id) }}" 
                                class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>

                                <a href="{{ route('balita.edit', $balita->id) }}" 
                                class="btn btn-sm btn-warning text-white">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('balita.destroy', $balita->id) }}" 
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus data {{ $balita->nama_balita }}?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="opacity-50">
                                    <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                                    <p class="mb-2 text-muted fw-bold">Belum ada data balita.</p>
                                    <a href="{{ route('balita.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="fas fa-plus me-1"></i> Tambah Data
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white border-0 py-3 rounded-bottom-4">
            <div class="d-flex justify-content-end">
                {{ $balitas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection