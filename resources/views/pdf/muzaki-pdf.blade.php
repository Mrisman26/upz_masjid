<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Zakat</title>
    <<style>
        body {
        font-family: Arial, sans-serif;
        margin: 20px;
        text-align: center;
        }

        h2 {
        margin-bottom: 15px;
        }

        .tanggal-laporan {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        }

        th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
        }

        th {
        background-color: #f2f2f2;
        font-weight: bold;
        }

        tfoot {
        font-weight: bold;
        background-color: #e6e6e6;
        }

        .no-data {
        font-size: 18px;
        font-weight: bold;
        color: red;
        margin-top: 20px;
        }

        /* Pemisahan halaman untuk PDF */
        .page-break {
        page-break-before: always; /* Pemisah halaman di setiap tanggal baru */
        }
        </style>

</head>

<body>

    @if($groupedZakat->isNotEmpty())
        @foreach($groupedZakat as $tanggal => $zakatList)
            @if(!$loop->first)
                <div class="page-break"></div> <!-- Pemisah halaman hanya jika bukan halaman pertama -->
            @endif

                <h2>Laporan Data Zakat</h2>

            <div class="tanggal-laporan">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>RT/RW</th>
                            <th>Jumlah Tanggungan</th>
                            <th>Jumlah Muzaki</th>
                            <th>Zakat Fitrah (Beras)</th>
                            <th>Zakat Fitrah (Uang)</th>
                            <th>Zakat Mal</th>
                            <th>Zakat Penghasilan</th>
                            <th>Infaq</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($zakatList as $key => $zakat)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $zakat->kepalaKeluarga->nama }}</td>
                            <td>{{ $zakat->kepalaKeluarga->rtRw->rt }} / {{ $zakat->kepalaKeluarga->rtRw->rw }}</td>
                            <td>{{ $zakat->kepalaKeluarga->jumlah_tanggungan }}</td>
                            <td>{{ $zakat->kepalaKeluarga->jumlah_muzaki }}</td>
                            <td>{{ $zakat->zakat_fitrah_beras ? number_format($zakat->zakat_fitrah_beras, 1) . ' Liter' : '-' }}
                            </td>
                            <td>{{ $zakat->zakat_fitrah_uang ? 'Rp ' . number_format($zakat->zakat_fitrah_uang, 0, ',', '.') : '-' }}
                            </td>
                            <td>{{ $zakat->zakat_mal ? 'Rp ' . number_format($zakat->zakat_mal, 0, ',', '.') : '-' }}</td>
                            <td>{{ $zakat->zakat_penghasilan ? 'Rp ' . number_format($zakat->zakat_penghasilan, 0, ',', '.') : '-' }}
                            </td>
                            <td>Rp {{ number_format($zakat->infaq, 0, ',', '.') }}</td>
                            <td>{{ $zakat->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align: left;">Total</th>
                            <th>{{ number_format($zakatList->sum('kepalaKeluarga.jumlah_tanggungan'), 0) }}</th>
                            <th>{{ number_format($zakatList->sum('kepalaKeluarga.jumlah_muzaki'), 0) }}</th>
                            <th>{{ number_format($zakatList->sum('zakat_fitrah_beras'), 1) }} Liter</th>
                            <th>Rp {{ number_format($zakatList->sum('zakat_fitrah_uang'), 0, ',', '.') }}</th>
                            <th>Rp {{ number_format($zakatList->sum('zakat_mal'), 0, ',', '.') }}</th>
                            <th>Rp {{ number_format($zakatList->sum('zakat_penghasilan'), 0, ',', '.') }}</th>
                            <th>Rp {{ number_format($zakatList->sum('infaq'), 0, ',', '.') }}</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                </table>

        @endforeach
    @else
        <p class="no-data">Tidak ada data zakat untuk tahun yang dipilih.</p>
    @endif



</body>

</html>
