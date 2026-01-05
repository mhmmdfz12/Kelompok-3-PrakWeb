@extends('layout')

@section('title', 'Detail Ibu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-glass">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-female me-2"></i> Detail Data Ibu</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Ibu</th>
                        <td>: {{ $ibu->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>: {{ $ibu->nik }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $ibu->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>: {{ $ibu->no_hp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>: {{ \Carbon\Carbon::parse($ibu->tgl_lahir)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td>: {{ \Carbon\Carbon::parse($ibu->tgl_lahir)->age }} tahun</td>
                    </tr>
                </table>

                <h6 class="mt-4 mb-3">Daftar Balita:</h6>
                @if($ibu->balitas->count() > 0)
                    <ul>
                        @foreach($ibu->balitas as $balita)
                            <li>
                                <a href="{{ route('balita.show', $balita) }}">{{ $balita->nama_balita }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada balita terdaftar</p>
                @endif

                <a href="{{ route('ibu.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
