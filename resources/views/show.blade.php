@extends('layout')

@section('content')

{{-- 1. LOGIKA PHP (Di paling atas) --}}
@php
    $dataGrafik = $balita->penimbangans->sortBy('tgl_timbang');
    $labels = $dataGrafik->pluck('tgl_timbang')->values();
    $dataBerat = $dataGrafik->pluck('berat_badan')->values();
@endphp

<style>
    /* 1. BACKGROUND FOTO */
    body {
        background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
        background-size: cover;
        box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.1); 
        min-height: 100vh;
    }
</style>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-primary text-white">Biodata Balita</div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr><th>Nama</th><td>: {{ $balita->nama_balita }}</td></tr>
                    <tr><th>Ibu</th><td>: {{ $balita->nama_ibu }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>: {{ $balita->jenis_kelamin }}</td></tr>
                    <tr><th>Lahir</th><td>: {{ $balita->tgl_lahir }}</td></tr>
                    <tr><th>Umur</th><td>: {{ \Carbon\Carbon::parse($balita->tgl_lahir)->age }} Tahun</td></tr>
                </table>
                <a href="{{ route('balita.index') }}" class="btn btn-secondary btn-sm w-100">Kembali</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">Input Penimbangan</div>
            <div class="card-body">
                <form action="{{ route('penimbangan.store', $balita->id) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label>Tanggal</label>
                        <input type="date" name="tgl_timbang" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label>Berat (Kg)</label>
                            <input type="number" step="0.1" name="berat_badan" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-6 mb-2">
                            <label>Tinggi (Cm)</label>
                            <input type="number" step="0.1" name="tinggi_badan" class="form-control" placeholder="0.0" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Lingkar Kepala (Cm)</label>
                        <input type="number" step="0.1" name="lingkar_kepala" class="form-control" placeholder="0.0">
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Cth: Sehat">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">Grafik Pertumbuhan</div>
            <div class="card-body">
                {{-- Data ditempel di atribut HTML agar VS Code tidak error --}}
                <canvas id="growthChart" 
                    data-label="{{ json_encode($labels) }}" 
                    data-value="{{ json_encode($dataBerat) }}"
                    style="max-height: 300px; width: 100%;">
                </canvas>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">Riwayat Penimbangan</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Berat</th>
                                <th>Tinggi</th>
                                <th>Status Gizi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($balita->penimbangans as $data)
                            <tr>
                                <td>{{ $data->tgl_timbang }}</td>
                                <td>{{ $data->berat_badan }} Kg</td>
                                <td>{{ $data->tinggi_badan }} cm</td>
                                <td>
                                    @if($data->status_gizi)
                                        @if($data->status_gizi == 'Gizi Baik')
                                            <span class="badge bg-success">{{ $data->status_gizi }}</span>
                                        @elseif($data->status_gizi == 'Gizi Buruk' || $data->status_gizi == 'Gizi Kurang')
                                            <span class="badge bg-danger">{{ $data->status_gizi }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ $data->status_gizi }}</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <form action="{{ route('penimbangan.destroy', $data->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIWAYAT IMUNISASI -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Riwayat Imunisasi</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead><tr><th>Tanggal</th><th>Jenis Imunisasi</th><th>Tempat</th><th>Keterangan</th></tr></thead>
                        <tbody>
                            @forelse ($balita->imunisasis as $imun)
                            <tr>
                                <td>{{ $imun->tanggal }}</td>
                                <td><span class="badge bg-info">{{ $imun->jenis_imunisasi }}</span></td>
                                <td>{{ $imun->tempat ?? '-' }}</td>
                                <td>{{ $imun->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted">Belum ada data imunisasi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIWAYAT VITAMIN -->
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">Riwayat Vitamin</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead><tr><th>Tanggal</th><th>Jenis Vitamin</th><th>Keterangan</th></tr></thead>
                        <tbody>
                            @forelse ($balita->vitamins as $vit)
                            <tr>
                                <td>{{ $vit->tanggal }}</td>
                                <td><span class="badge bg-warning text-dark">{{ $vit->jenis_vitamin }}</span></td>
                                <td>{{ $vit->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted">Belum ada data vitamin.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('growthChart');

    // Ambil data dari atribut HTML
    const chartLabels = JSON.parse(ctx.dataset.label);
    const chartData = JSON.parse(ctx.dataset.value);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels, 
            datasets: [{
                label: 'Berat Badan (Kg)',
                data: chartData,
                borderWidth: 2,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: false }
            }
        }
    });
</script>
@endsection