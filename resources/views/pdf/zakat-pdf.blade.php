<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Zakat Tahun {{ $tahun }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 5px; }
    </style>
</head>
<body>

    <h2>Rekapitulasi Zakat Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">TANGGAL</th>
                <th colspan="3">RW 08</th>
                <th colspan="3">RW 10</th>
                <th rowspan="2">RW 01</th>
                <th colspan="2">ZAKAT FITRAH</th>
                <th rowspan="2">ZAKAT MAL</th>
                <th rowspan="2">ZAKAT PENGHASILAN</th>
                <th rowspan="2">INFAQ</th>
                <th rowspan="2">JUMLAH</th>
            </tr>
            <tr>
                <th>RT 24</th>
                <th>RT 25</th>
                <th>RT 26</th>
                <th>RT 31</th>
                <th>RT 32</th>
                <th>RT 33</th>
                <th>BERAS</th>
                <th>UANG</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_rt_24 = 0;
                $total_rt_25 = 0;
                $total_rt_26 = 0;
                $total_rt_31 = 0;
                $total_rt_32 = 0;
                $total_rt_33 = 0;
                $total_rw_01 = 0;
                $total_beras = 0;
                $total_uang = 0;
                $total_mal = 0;
                $total_penghasilan = 0;
                $total_infaq = 0;
                $total_jumlah = 0;
            @endphp

            @forelse($rekapitulasi as $index => $rekap)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($rekap->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $rekap->rt_24 }}</td>
                    <td>{{ $rekap->rt_25 }}</td>
                    <td>{{ $rekap->rt_26 }}</td>
                    <td>{{ $rekap->rt_31 }}</td>
                    <td>{{ $rekap->rt_32 }}</td>
                    <td>{{ $rekap->rt_33 }}</td>
                    <td>{{ $rekap->rw_01 }}</td>
                    <td>{{ number_format($rekap->total_beras, 1) }} Liter</td>
                    <td>Rp {{ number_format($rekap->total_uang, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($rekap->total_mal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($rekap->total_penghasilan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($rekap->total_infaq, 0, ',', '.') }}</td>
                    <td><b>Rp {{ number_format($rekap->total_jumlah, 0, ',', '.') }}</b></td>
                </tr>
                @php
                    $total_rt_24 += $rekap->rt_24;
                    $total_rt_25 += $rekap->rt_25;
                    $total_rt_26 += $rekap->rt_26;
                    $total_rt_31 += $rekap->rt_31;
                    $total_rt_32 += $rekap->rt_32;
                    $total_rt_33 += $rekap->rt_33;
                    $total_rw_01 += $rekap->rw_01;
                    $total_beras += $rekap->total_beras;
                    $total_uang += $rekap->total_uang;
                    $total_mal += $rekap->total_mal;
                    $total_penghasilan += $rekap->total_penghasilan;
                    $total_infaq += $rekap->total_infaq;
                    $total_jumlah += $rekap->total_jumlah;
                @endphp
            @empty
                <tr>
                    <td colspan="15" style="background-color: red; color: white; font-weight: bold;">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">TOTAL</th>
                <th>{{ $total_rt_24 }}</th>
                <th>{{ $total_rt_25 }}</th>
                <th>{{ $total_rt_26 }}</th>
                <th>{{ $total_rt_31 }}</th>
                <th>{{ $total_rt_32 }}</th>
                <th>{{ $total_rt_33 }}</th>
                <th>{{ $total_rw_01 }}</th>
                <th>{{ number_format($total_beras, 1) }} Liter</th>
                <th>Rp {{ number_format($total_uang, 0, ',', '.') }}</th>
                <th>Rp {{ number_format($total_mal, 0, ',', '.') }}</th>
                <th>Rp {{ number_format($total_penghasilan, 0, ',', '.') }}</th>
                <th>Rp {{ number_format($total_infaq, 0, ',', '.') }}</th>
                <th><b>Rp {{ number_format($total_jumlah, 0, ',', '.') }}</b></th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
