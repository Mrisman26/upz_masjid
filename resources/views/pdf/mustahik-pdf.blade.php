<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Mustahik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        h2 {
            margin: 0;
        }
        .tanggal-laporan {
            font-size: 16px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .no-data {
            font-size: 18px;
            font-weight: bold;
            color: red;
            margin-top: 20px;
            text-align: center;
        }
        .page-break {
            page-break-before: always;
        }
        .fakir { background-color: #FFD700; }
        .miskin { background-color: #FFA07A; }
        .fisabilillah { background-color: #98FB98; }
        .lainnya { background-color: #ADD8E6; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Data Mustahik</h2>
        <div class="tanggal-laporan">Tanggal: {{ \Carbon\Carbon::now()->format('d M Y') }}</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>RT</th>
                <th>RW</th>
                <th>Kriteria</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mustahiks as $key => $mustahik)
            <tr class="{{ strtolower($mustahik->kriteria) }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $mustahik->name }}</td>
                <td>{{ $mustahik->rtRw->rt ?? '-' }}</td>
                <td>{{ $mustahik->rtRw->rw ?? '-' }}</td>
                <td>{{ $mustahik->kriteria }}</td>
                <td>{{ $mustahik->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="no-data">Tidak ada data mustahik untuk ditampilkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
