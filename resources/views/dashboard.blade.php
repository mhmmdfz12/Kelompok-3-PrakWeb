@extends('layout')

@section('title', 'Dashboard')

@section('extra_css')
<style>
    .stat-card {
        transition: all 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold page-title mb-0">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-white-50 mb-0">Ringkasan data posyandu hari ini.</p>
    </div>
    <span class="badge bg-white text-primary fs-6 shadow-sm px-3 py-2 rounded-pill">
        <i class="far fa-calendar-alt me-2"></i> {{ date('d M Y') }}
    </span>
</div>

<!-- KARTU STATISTIK -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card card-glass stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-bold text-uppercase small">Total Balita</p>
                    <h2 class="fw-bold text-primary mb-0">{{ $totalBalita }}</h2>
                </div>
                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.8;">
                    <i class="fas fa-baby"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card card-glass stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-bold text-uppercase small">Total Ibu</p>
                    <h2 class="fw-bold text-success mb-0">{{ $totalIbu }}</h2>
                </div>
                <div class="text-success" style="font-size: 2.5rem; opacity: 0.8;">
                    <i class="fas fa-female"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card card-glass stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-bold text-uppercase small">Kader Aktif</p>
                    <h2 class="fw-bold text-warning mb-0">{{ $totalKaderAktif }}</h2>
                </div>
                <div class="text-warning" style="font-size: 2.5rem; opacity: 0.8;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-glass stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-bold text-uppercase small">Jadwal Terdekat</p>
                    <h2 class="fw-bold text-info mb-0">{{ $jadwalTerdekat->count() }}</h2>
                </div>
                <div class="text-info" style="font-size: 2.5rem; opacity: 0.8;">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ROW 2: Jadwal dan Status Gizi -->
<div class="row g-4">
    <!-- JADWAL TERDEKAT -->
    <div class="col-md-6">
        <div class="card card-glass">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark">
                    <i class="fas fa-calendar me-2 text-primary"></i> Jadwal Posyandu Terdekat
                </h5>
            </div>
            <div class="card-body px-4 pb-4">
                @if($jadwalTerdekat->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($jadwalTerdekat as $jadwal)
                        <div class="list-group-item px-0 border-0 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</h6>
                                    <p class="mb-1 text-muted small">
                                        <i class="far fa-clock me-1"></i> {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </p>
                                    <p class="mb-0 text-muted small">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $jadwal->tempat }}
                                    </p>
                                </div>
                                <span class="badge bg-primary">{{ $jadwal->status }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center py-3">Belum ada jadwal terdekat</p>
                @endif
            </div>
        </div>
    </div>

    <!-- STATUS GIZI -->
    <div class="col-md-6">
        <div class="card card-glass">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark">
                    <i class="fas fa-chart-pie me-2 text-success"></i> Distribusi Status Gizi
                </h5>
            </div>
            <div class="card-body px-4 pb-4">
                @if($statusGizi->count() > 0)
                    @foreach($statusGizi as $sg)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="fw-bold">{{ $sg->status_gizi }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress" style="width: 100px; height: 8px;">
                                <div class="progress-bar 
                                    @if($sg->status_gizi == 'Gizi Baik') bg-success
                                    @elseif($sg->status_gizi == 'Gizi Buruk' || $sg->status_gizi == 'Gizi Kurang') bg-danger
                                    @else bg-warning
                                    @endif" 
                                    style="width: {{ ($sg->total / $totalBalita) * 100 }}%"></div>
                            </div>
                            <span class="badge bg-secondary">{{ $sg->total }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center py-3">Belum ada data status gizi</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- AKSES CEPAT -->
<div class="card card-glass mt-4">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold text-dark"><i class="fas fa-rocket me-2 text-primary"></i> Akses Cepat</h5>
    </div>
    <div class="card-body px-4 pb-4">
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('balita.create') }}" class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Tambah Balita
            </a>
            <a href="{{ route('ibu.create') }}" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Tambah Ibu
            </a>
            <a href="{{ route('kader.index') }}" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-users me-2"></i> Kelola Kader
            </a>
            <a href="{{ route('jadwal.create') }}" class="btn btn-info text-white fw-bold px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-calendar-plus me-2"></i> Buat Jadwal
            </a>
            <a href="{{ route('balita.cetak_pdf') }}" class="btn btn-outline-dark fw-bold px-4 py-2 rounded-pill">
                <i class="fas fa-print me-2"></i> Cetak Laporan
            </a>
        </div>
    </div>
</div>
@endsection