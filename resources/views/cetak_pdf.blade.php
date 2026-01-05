<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Balita</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            /* margin-bottom: 30px;//l.;  */
        }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; font-size: 14px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>SISTEM INFORMASI POSYANDU</h2>
        <p>Laporan Data Balita Terdaftar</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Nama Balita</th>
                <th>Nama Ibu</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Berat Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($balitas as $index => $balita)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $balita->nama_balita }}</td>
                <td>{{ $balita->nama_ibu }}</td>
                <td>{{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $balita->tgl_lahir }}</td>
                <td>{{ $balita->berat_badan_lahir }} Kg</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>